<?php
App::uses('AppController', 'Controller');

/**
 * @property UserMonthbookings $UserMonthbookings
 * @property Monthbookings $Monthbookings
 * @property ContractHours $ContractHours
 * @property InternHoursTypes $InternHoursTypes
 * @property InternHours $InternHours
 * @property Contracts $Contracts
 * @property Months $Months
 * @property Years $Years
 * @property User $User
 */

class UserMonthbookingsController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('UserMonthbookings', 'Monthbookings', 'ContractHours', 'InternHours', 'InternHoursTypes', 'User', 'Contracts', 'Months', 'Years', 'Company');
    public $components = array('Paginator');
    public $monthbooking_id;

    public function index()
    { debug("BULLSHIT!!!");
//        $this->Roles->recursive = -1;
//        $this->set('roles', $this->Paginator->paginate('Roles'));
    }

    public function view($id = null)
    {
        // ophalen van alle items per rol die verschillende functies vervullen.
    }

    public function add()
    {
        (int) $user_id = AuthComponent::user('user_id');
        if ($this->request->is('post')) {
            if (isset($this->request->data['Monthbooking'])) {
                $this->postBooking($this->request->data['Monthbooking']);
            } else {

                if($this->request->data) {                      //ophalen van ids van ingevoerde maand en jaar
                    $data = $this->request->data;
                    $yearId = $data['Monthbookings']['year_id'];
                    $month = $data['Monthbookings']['month_id'];

                    if ($this->Monthbookings->hasAny($data['Monthbookings']) == 0) {
                        $this->Monthbookings->create();                                             //als er geen monthbookingrecord gevonden is voer dan dit
                        $this->Monthbookings->save($data);                                          //stuk uit om een nieuwe rij aan te maken.
                        $monthbookingId = $this->Monthbookings->getLastInsertID();

                    } else {
                        $dataMonthbooking = $this->Monthbookings->find('first', array(          //als er wel een record gevonden wordt haal dan het id daarvan op.
                            'conditions' => array(
                                'year_id' => $yearId,
                                'month_id' => $month
                            ),
                            'recursive' => -1
                        ));
                        $monthbookingId = $dataMonthbooking['Monthbookings']['monthbooking_id'];
                    }
                    $dataUserMonthbooking = array(
                        'monthbooking_id' => $monthbookingId,                                       //maak de data compleet om controle uit te voeren op de UserMonthbookingstabel
                        'user_id' => $user_id
                    );

                    if ($this->UserMonthbookings->hasAny($dataUserMonthbooking) == 0) {
                        $this->UserMonthbookings->create();                                         //opslaan van UserMonthbooking
                        $this->UserMonthbookings->save($dataUserMonthbooking);
                        $userMonthbookingId = $this->UserMonthbookings->getLastInsertID();
                    } else {
                        $this->Flash->set('boeking bestaat al');
                        $userMonthbookingId = $this->UserMonthbookings->find('first', array(
                                                    'conditions' => array(
                                                        'monthbooking_id' => $monthbookingId,
                                                        'user_id' => $user_id
                                                    ),
                                                    'fields' => 'user_monthbooking_id',
                                                    'recursive' => -1
                                                ));
                    }
                    $userMonthbookingId = array_pop($userMonthbookingId['UserMonthbookings']);
                }

                $monthMax = date('t', $month);
                $year = $this->Years->find('list', array(                                     //ophalen van ingevoerd jaar en maand
                            'conditions' => array(
                                'year_id' => $yearId),
                            'fields' => 'year',
                            'recursive' => -1
                        ));
                $year = array_pop($year);

                $params = array(                                                                    //ophalen van contracten van de gebruiker waarbij adhv jaar en maand gecontroleerd
                    'fields' => array(                                                              //wordt welke contracten opgehaald moeten worden
                        'Contracts.start_date',
                        'Contracts.end_date',
                        'Contracts.contract_id',
                        'Company.name'
                    ),
                    'conditions' => array(
                        'Contracts.user_id' => $user_id
                    ),
                    'having' => array(
                        'Contracts.end_date >' => $year . '-' . $month . '-01',
                        'Contracts.start_date <' => $year . '-' . $month . '-' . $monthMax
                    ),
                    'recursive' => 0
                );

                $contracts = $this->Contracts->find('all', $params);                                        //relevante contracten van de gebruiker
                $days = $this->checkDayType($month, $year);                                                       //array met dagen in de maand waarbij de feest en weekenddagen worden meegenomen
                $bookingTypes = $this->InternHoursTypes->find('all', array('recursive' => -1));    //ophalen van interne uren types
                $chosenMonth = $this->Months->find('list', array(
                    'conditions' => array(
                        'month_id' => $month),
                    'fields' => 'month',
                    'recursive' => -1
                    )
                );

                //hier wordt meegestuurd: dagen in getalvorm, maanden in getalvorm, contracten: begindatum, einddatum, id en bedrijfsnaam, bookingtypes id, userMonthbookingId.
                $this->set(array('days' => $days, 'month' => array_pop($chosenMonth), 'contracts' => $contracts, 'bookingTypes' => $bookingTypes, 'userMonthbookingId' => $userMonthbookingId));
            }
        } else {
            $paramsYears = array(
                'fields' => array('Years.year'),
                'recursive' => 0
            );
            $paramsMonths = array(
                'fields' => array('Months.month'),
                'recursive' => 0
            );

            $years = $this->Years->find('list', $paramsYears);
            $months = $this->Months->find('list', $paramsMonths);
            $values = compact('years', 'months');

            $this->set('values', $values);
            $this->render("create");
        }
    }

    public function edit($id = null)
    {
        if ($this->request->is('post') || $this->request->is('put')) {
            $saveParams = array(
                'validation' => true,
            );
            $this->Roles->id = $id;
            if ($this->Roles->save($this->request->data, $saveParams)) {
                $this->Flash->success(__('Rol opgeslagen.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('Fout bij opslaan. De rol is niet opgslagen. Probeer het nog eens.')
            );
        } else {
            $params = array(
                'conditions' => array('role_id' => $id),
            );

            $role = $this->Roles->find('first', $params);
            $this->request->data['Roles'] = $role['Roles'];
        }
    }

    public function delete($id = null)
    {

        $this->request->allowMethod('post');

        $this->Roles->id = $id;
        if (!$this->Roles->exists()) {
            throw new NotFoundException(__('Rol niet gevonden'));
        }
        if ($this->Roles->delete()) {
            $this->Flash->success(__('Rol verwijderd'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Fout bij deleten. De rol is niet verwijderd. Probeer het nog eens.'));
        return $this->redirect(array('action' => 'index'));
    }
    public function create()
    {   //ophalen contracten adhv user_id om te bepalen hoeveel rijen gemaakt gaan worden voor de werkuren boeking, meegeven maanden en jaren die toegestaan worden door contracten
        $user_id = $this->Auth->user('user_id');
        $params = array(
            'conditions' => array('contracts.user_id' => $user_id),
            'recursive' => -1,
            'order' =>array('Contracts.start_date' => 'desc')
        );
        $contracts = $this->Contracts->find('all', $params);
        foreach($contracts as $contract) {

        }
        //$this->set(array('months' => $months, 'years' => $years));
    }

    public function postBooking($data)
    {
        $newData = array();
        $recordExist = false;
        (int) $user_id = AuthComponent::user('user_id');
        $description = "text";      //tijdelijk
        $userMonthbookingId = array_pop($data);

        if ($this->UserMonthbookings->hasAny($userMonthbookingId, array('conditons' => array('user_id' => $user_id))) == 1) {

            foreach ($data as $key => $value) {
                if ($value !== '') {
                    $key = explode('_', $key);                      //@TODO check inbouwen zodat er geen dubbele uren kunnen worden opgeslagen
                    if ($key[0] == 'contract') {
                        $checkIfRecordExists = $this->ContractHours->hasAny(array('day' => $key[1], 'contract_id' => $key[2], 'user_monthbooking_id' => $userMonthbookingId));
                        if ($checkIfRecordExists == false) {
                            $newData['ContractHours'][] = ['description' => $description, 'hours' => $value, 'day' => $key[1], 'contract_id' => $key[2], 'user_monthbooking_id' => $userMonthbookingId];
                        } else {
                            $recordExist = true;
                        }
                    } elseif ($key[0] == 'intern') {
                        $checkIfRecordExists = $this->InternHours->hasAny(array('day' => $key[1], 'intern_hour_type_id' => $key[2], 'user_monthbooking_id' => $userMonthbookingId));
                        if ($checkIfRecordExists == false) {
                            $newData['InternHours'][] = ['description' => $description, 'hours' => $value, 'day' => $key[1], 'intern_hour_type_id' => $key[2], 'user_monthbooking_id' => $userMonthbookingId];
                        } else {
                            $recordExist = true;
                        }
                    } else {
                        $this->Flash->error(__('Fout bij invoer. verkeerd type boeking terug gekregen.'));
                        return $this->redirect(array('action' => 'add'));
                    }
                }
            }
            if (isset($newData['ContractHours'])) {
                $this->ContractHours->create();
                $this->ContractHours->saveAll($newData['ContractHours']);
            }
            if (isset($newData['InternHours'])) {
                $this->InternHours->create();
                $this->InternHours->saveAll($newData['InternHours']);
            }

            if ($recordExist == true) {
                $this->Flash->success(__('Uren opgeslagen. N.B. Bepaalde uren zijn niet opgeslagen omdat deze reeds bestaan'));
                return $this->redirect(array('controller' => 'User', 'action' => 'index'));
            }
        }
        $this->Flash->error(__('Fout bij invoer. verkeerd ID terug gekregen.'));
        return $this->redirect(array('action' => 'add'));
    }

    public function checkDayType($month, $year)
    {
        $days = array();

        $date = $year . '-' . $month;
        $current = strtotime($date);

        $easterStamp = easter_date($year);
        $easter = date('d-m', $easterStamp);

        $pinksterenStamp = $easterStamp + 4233600;
        $pinksteren = date('d-m', $pinksterenStamp);

        $hemelvaartStamp = $pinksterenStamp - 864000;
        $hemelvaart = (date('d-m', $hemelvaartStamp));

        $pinksterMaandagStamp = $pinksterenStamp + 86400;
        $pinksterMaandag = (date('d-m', $pinksterMaandagStamp));

        $goedeVrijdag = date('d-m', $easterStamp - 172800);
        $easterMonday = date('d-m', $easterStamp + 86400);

        $specialDay = ['1-1', $goedeVrijdag, $easter, $easterMonday, '27-4', '5-5', $hemelvaart, $pinksteren, $pinksterMaandag, '25-12', '26-12'];
        $specialDayType = ['1 januari', 'Goede vrijdag', 'pasen', 'paasmaandag', 'koningsdag', 'bevrijdingsdag', 'hemelvaart', 'pinksteren', 'pinkstermaandag', '1e kerstdag', '2e kerstdag'];


        for ($i = 0; $i < date('t', $current);) {
            $findSpecialDay = array_search(++$i . '-' . $month, $specialDay); //returned de key zodat er een naam aan de feestdag wordt gegeven als de dag een feestdag is
            $weekend = date('w', strtotime($year . '-' . $month . '-' . $i));   //geeft nummer van dag in de week (0-6)
            if ($findSpecialDay !== false) {      //check of feestdag is gevonden
                $days[$i] = $specialDayType[$findSpecialDay];
            } elseif ($weekend == 0 || $weekend == 6) {
                $days[$i] = 'weekend';           //check of dag weekend is
            } else {
                $days[$i] = '';
            }
        }
        return $days;
    }

}
