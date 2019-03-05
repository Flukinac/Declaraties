<?php
App::uses('appController', 'Controller');
App::uses('CakeEmail', 'Network/Email');


/**
 * @property Contracts $Contracts
 * @Property UserMonthbookings $UserMonthbookings
 * @Property InternHours $InternHours
 * @Property Administratie $Administratie
 * @Property Company $Company
 * @property Roles $Roles
 * @property User $User
 * @property ContractHours $ContractHours
 */

class UserController extends AppController {
    public $helpers = array('Html', 'Form', 'Paginator');
    public $uses = array('User', 'Roles', 'Company', 'Administratie', 'Contracts', 'InternHoursTypes', 'InternHours', 'CakeEmail', 'Network/Email');
    public $components = array('Paginator');
    public $paginate = array(
        'limit' => 5,
        'recursive' => 1,
        'order' => array(
            'User.username' => 'asc'
        ),
        'conditions' => array(
            'User.status' => 1
        )
    );

    public function beforeFilter() {
        //modeltesting area
//        $this->loadModel('Administratie');
//        debug($this->Administratie->find('all'));
//        exit();
    }

    public function index() {
        $this->checkAuth(3);

        $this->Paginator->settings = $this->paginate;

        $cat_data = $this->Paginator->paginate('User');

        $this->set('users', $cat_data);
    }

    public function view($id = null) {

        $this->User->id = $id;
        if (!$this->User->exists()) {
            CakeLog::write('debug', Router::url(null, true) . '  gebruiker: ' . AuthComponent::user('username') . ', id: ' . AuthComponent::user('user_id') . ', rol: ' . AuthComponent::user('role_id'));
            throw new NotFoundException(__('Gebruiker niet gevonden.'));
        }
        $this->User->contain(array(
            'Roles' => array(
                'description'
            ),
            'Contracts',
            'UserMonthbookings'
        ));

        $params = array(
            'conditions' => array(
                'user_id' => $id
            )
        );

        $user = $this->User->find('first', $params);

        $this->set('user', $user);
    }

    public function add() {
        $this->checkAuth(4);

        if ($this->request->is('post')) {

            $data = $this->request->data;

            $data['User']['password'] = '123456'; //$this->randomPassStr(8); tijdelijk, totdat de mailing het op de host doet

            if (!$this->User->save($data)) {
                $this->Flash->error(__('Fout bij opslaan. De gebruiker is niet opgslagen. Probeer het nog eens.'));
            } else {
                $userId = $this->User->getLastInsertID();

                if ($this->storeContracts($userId, $data)) {
//                    if ($this->newUserMail($data)) {                      //tijdelijk, totdat de mailing het op de host doet
                    $this->Flash->success(__('Gebruiker opgeslagen.'));
                    return $this->redirect(array('action' => 'index'));
//                    } else {
//                        $this->Flash->error(__('Fout bij opslaan. De gebruiker is niet opgslagen. Probeer het nog eens.'));
//                    }
                } else {
                    $this->Flash->error(__('Fout bij opslaan. De gebruiker is niet opgslagen. Probeer het nog eens.'));
                }
            }
        }

        $roles = $this->Roles->find('list', array(
            'fields' => array(
                'role_id', 'description'
            )
        ));

        $companies = $this->Company->find('list', array(
            'recursive' => -1,
            'fields' => 'name'
        ));

        $companiesExtra = $companies;
        $companiesExtra[0] = 'geen';

        $this->set(array('role' => $roles, 'companies' => $companies, 'companiesExtra' => $companiesExtra));
    }

    public function edit($id = null) {

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->User->id = $id;
            if ($this->User->exists()) {

                if (!$this->User->save($this->request->data)) {
                    $this->Flash->error(__('Fout bij opslaan. De gebruiker is niet opgslagen. Probeer het nog eens.'));
                } else {
                    if ($this->storeContracts($id, $this->request->data)) {
                        $this->Flash->success(__('Gebruiker opgeslagen.'));
                        return $this->redirect(array('controller' => 'User', 'action' => 'index'));
                    }
                    $this->Flash->error(__('Fout bij opslaan. De gebruiker is niet opgslagen. Probeer het nog eens.'));
                }
            }
        }

        $params = array(
            'conditions' => array(
                'user_id' => $id
            ),
            'recursive' => -1
        );
        $paramsRoles = array(
            'recursive' => 0,
            'fields' => array(
                'role_id', 'description'
            )
        );

        $companies = $this->Company->find('list', array(
            'recursive' => -1,
            'fields' => 'name'
        ));

        $companiesExtra = $companies;
        $companiesExtra[0] = 'geen';

        $userdata = $this->User->find('first', $params);
        $this->request->data['Roles'] = $this->Roles->find('list', $paramsRoles);

        $this->set(array('values' => $this->request->data, 'userdata' => $userdata, 'companiesExtra' => $companiesExtra, 'companies' => $companies));
    }

    public function password($id = null) {
        if ($this->request->is('post') || $this->request->is('put')) {

            if (AuthComponent::user('user_id') == $id) {
                $this->User->id = $id;

                if ($this->User->save($this->request->data)) {
                    $this->Flash->success(__('Wachtwoord gewijzigd.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('Opslaan mislukt. Probeer het nog eens.'));
                }
            } else {
                $this->Flash->error(__('Gebruiker niet gevonden.'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function delete($id = null) {

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Gebruiker niet gevonden'));
        }
        $save = array(
            'User' => array(
                'status' => 0
            )
        );
        if ($this->User->save($save)) {
            $this->Flash->success(__('Gebruiker verwijderd'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Nog te bepalen welke gegevens er verwijderd gaan worden.'));
        return $this->redirect(array('action' => 'index'));
    }

    private function storeContracts($userId = null, $data = null) {

        $this->User->create();
        $this->Contracts->create();

        $result = true;

        foreach ($data['User'] as $key => $value) {
            if (($key == 'company_id1' || $key == 'company_id2' || $key == 'company_id3') && $value !== '0') {      //check of de key van een opdracht dropdown menu komt en of dit dropdownmenu niet leeg is gelaten

                $contractIds[] = array('Contracts.company_id !=' => $value);

                if ($userId > 0) {

                    $contractExists = $this->Contracts->find('first', array(   //kijk voor elke company_id of er een contract bestaat voor deze user
                        'conditions' => array(
                            'user_id' => $userId,
                            'company_id' => $value
                        ),
                        'recursive' => -1
                    ));

                    if (!$contractExists) {         //als er geen contract bestaat. maak deze aan

                        $assignment = $this->Company->find('first', array(
                            'conditions' => array(
                                'company_id' => $value
                            ),
                            'fields' => 'Company.name',
                            'recursive' => -1
                        ));

                        $contract[] = array(
                            'name' => $assignment['Company']['name'],
                            'company_id' => $value,
                            'user_id' => $userId
                        );

                    } else {                        //als er een contract bestaat meer niet actief is. maak deze actief

                        $existingContractParams['Contracts.contract_id'][] = $contractExists['Contracts']['contract_id'];

                    }
                }
            }
        }

        $dataSource = ConnectionManager::getDataSource('default');
        $dataSource->begin();

        if (isset($contract)) {
            if (!$this->Contracts->saveMany($contract)) {
                $result = false;
            }
        }

        if (isset($existingContractParams)) {
            if (!$this->Contracts->updateAll(array('Contracts.active' => 1), $existingContractParams)) {
                $result = false;
            }
        }

        $conditions = array(
            array('Contracts.user_id' => $userId),
            'AND' => $contractIds
        );

        if (!$this->Contracts->updateAll(array('Contracts.active' => 0), $conditions)) {
            $result = false;
        }

        if ($result) {
            $dataSource->commit();
            return true;
        } else {
            $dataSource->rollback();
            return false;
        }
    }

    private function newUserMail($user) {

        //vind tekst voor email
        $tekst = $this->Administratie->find('first', array(
            'conditions' => array(
                'Administratie.administratie_id' => 2
            ),
            'fields' => 'text'
        ));

        $Email = new CakeEmail('smtp');             //stuur email naar user
        $Email->viewVars(array('name' => $user['User']['username'], 'tekst' => $tekst, 'password' => $user['User']['password']));
        $Email->template('nieuweGebruiker')
            ->emailFormat('html')
            ->from(array('Uren@localhost.com' => 'UrenApp'))
            ->to($user['User']['email'])
            ->subject('Aanmelding')
            ->send();

        return true;
    }

    private function randomPassStr(
        $length,
        $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ) {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new Exception('$keyspace must be at least two characters long');
        }
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }
}