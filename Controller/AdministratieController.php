<?php
App::uses('appController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * @Property Administratie $Administratie
 * @property UserMonthbookings $UserMonthbookings
 */
class AdministratieController extends AppController
{
    public $helpers = array('Html', 'Form', 'Paginator');
    public $uses = array('Administratie', 'UserMonthbookings');
    public $components = array('Paginator', 'Math');


    public function mailReminder() {
        $this->checkAuth(9);
        $this->mailTemplate(1);             //@todo deze functie is tijdelijk. er moet een onderscheid komen in de twee mailtekst knoppen in de navbar
    }

    public function mailTekstWelkom() {
        $this->checkAuth(10);
        $this->mailTemplate(2);             //@todo deze functie is tijdelijk. er moet een onderscheid komen in de twee mailtekst knoppen in de navbar
    }

    public function status()
    {
        $this->checkAuth(11);

        if ($this->request->is('post')) {

            $data = $this->request->data;
            $store['UserMonthbookings'] = array();
            $check = true;

            if (count($data['Administratie']) > 0) {
                foreach ($data['Administratie'] as $key => $value) {
                    $plop = explode('_', $key);

                    $this->UserMonthbookings->id = $plop[1];

                    if ($plop[0] == 'comment') {                            //De aangevoerde data heeft gegevens als een comment of checkbox. hier worden ze voorbereid voor het opslaan
                        $store['UserMonthbookings']['comment'] = $value;
                    } elseif ($plop[0] == 'status') {
                        $store['UserMonthbookings']['status'] = $value;
                        if ($this->checkAndApprover(array($plop[1], $value))) {                           //vul een approver in als er voor de keuring een andere waarde dan de huidige wordt opgeslagen
                            $store['UserMonthbookings']['approver'] = AuthComponent::user('user_id');
                        }
                    }

                    if (!$this->UserMonthbookings->save($store)) {
                        $check = false;
                    }
                    unset($store['UserMonthbookings']);
                }
                if ($check) {
                    $this->Flash->success(__('status wijzigingen opgeslagen.'));
                } else {
                    $this->Flash->error(__('Er is iets fout gegaan probeer het nog eens.'));
                }
            } else {
                $this->Flash->error(__('Er is geen gegevens doorgegeven. probeer het nog eens.'));
            }
        }
        $params = array('conditions' => array(
            'UserMonthbookings.status' => 0,
            'UserMonthbookings.active' => 1),
            'recursive' => 2
        );

        $result = $this->UserMonthbookings->find('all', $params);

        if (count($result) > 0) {
            for ($i = 0; $i < count($result); $i++) {
                $totalInternHours = 0;
                $totalContractHours = 0;
                $row = $result[$i]['UserMonthbookings']['user_monthbooking_id'];

                if (count($result[$i]['ContractHours']) > 0) {
                    foreach ($result[$i]['ContractHours'] as $hours) {
                        $totalContractHours += $hours['hours'];
                    }
                }
                if (count($result[$i]['InternHours']) > 0) {

                    foreach ($result[$i]['InternHours'] as $hours) {
                        $totalInternHours += $hours['hours'];
                    }
                }

                $totalHoursToConvert = $totalInternHours + $totalContractHours;
                $totalHours[$row] = $this->Math->convertTimeNotationToValues($totalHoursToConvert, false);

                $interHoursCheck[$row] = ($totalInternHours > 0 ? $totalInternHours : '0');
                $name = $this->User->find('list', array(
                    'conditions' => array('user_id' => $result[$i]['UserMonthbookings']['approver']),   //haal de laatste gebruiker op met een user_id die een goedkeuring in de betreffende boeking heeft gedaan.
                    'fields' => 'username'
                ));
                $approver[$row] = (isset($name[$result[$i]['UserMonthbookings']['approver']]) ? $name[$result[$i]['UserMonthbookings']['approver']] : '');
            }

        }
        if (empty($totalHours)) {
            $totalHours = 0;
        }

        $this->set(compact('result', 'totalHours', 'interHoursCheck', 'approver'));
    }

    private function checkAndApprover($values)
    {
        $status = $this->UserMonthbookings->find('first', array(
                'conditions' => array(
                    'user_monthbooking_id' => $values[0]
                ),
                'fields' => 'status',
                'recursive' => -1
            )
        );

        if ($status['UserMonthbookings']['status'] == $values[1]) {
            return false;
        }
        return true;
    }

    private function mailTemplate($type) {
        if ($this->request->is('post')) {
            $this->Administratie->id = 1;

            if (!$this->Administratie->save($this->request->data)) {
                $this->Flash->error(__('Probeer het nog eens.'));
            } else {
                $this->Flash->success(__('Mailtekst gewijzigd.'));
                $this->redirect('/');
            }
        }

        $tekst = $this->Administratie->find('first', array('conditions' => array('administratie_id' => $type), 'fields' => 'text'));
        $this->set('tekst', $tekst['Administratie']['text']);
        $this->render('mail_template');
    }
}
