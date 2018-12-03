<?php
App::uses('AppController', 'Controller');
App::uses('ConnectionManager', 'Model');

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
class UserMonthbookingsLegacyController extends AppController
{

    public $helpers = array('Html', 'Form');
    public $uses = array('UserMonthbookings', 'Monthbookings', 'ContractHours', 'InternHours', 'InternHoursTypes', 'User', 'Contracts', 'Months', 'Years', 'Company');
    public $components = array('Paginator', 'Auth');
    public $monthbooking_id;

    public $user_id = null;

    public function beforeFilter()
    {
        parent::beforeFilter();

        if ($this->Auth->user('user_id') !== null) {
            $this->user_id = $this->Auth->user('user_id');
        }
    }


    public function index()
    {
        $this->UserMonthbookings->Behaviors->load('Containable');
        $this->paginate = array(
            'conditions' => array(
                'UserMonthbookings.active' => true
            ),
            'fields' => array(
                'UserMonthbookings.*'
            ),
            'contain' => array(
                'Monthbookings' => array(
                    'Years' => array(
                        'year'
                    ),
                    'Months' => array(
                        'month'
                    )
                ),
                'InternHours' => array(
                    'hours'
                ),
                'ContractHours' => array(
                    'hours'
                ),
                'User' => array(
                    'username'
                )
            )
        );
        $userMonthbookings = $this->Paginator->paginate('UserMonthbookings');

        foreach ($userMonthbookings as $key => $userMonthbooking) {                         //loop door de boekingen heen en verzamel van elke booking de uren en dagen van elke geboekte dag van zowel contract als interne uren
            $userMonthbookings[$key]['UserMonthbookings']['contractHoursTotal'] = 0;        //reserveer de plaatsen voor de som van uren en dagen
            $userMonthbookings[$key]['UserMonthbookings']['internHoursTotal'] = 0;
            $userMonthbookings[$key]['UserMonthbookings']['contractDays'] = 0;
            $userMonthbookings[$key]['UserMonthbookings']['internDays'] = 0;

            if (isset($userMonthbooking['ContractHours'])) {                                //maak totaal aantal uren en dagen voor de contract boekingen en sla deze op
                foreach ($userMonthbooking['ContractHours'] as $booking) {
                    $userMonthbookings[$key]['UserMonthbookings']['contractHoursTotal'] += $booking['hours'];
                    $userMonthbookings[$key]['UserMonthbookings']['contractDays']++;
                }
            }
            if (isset($userMonthbooking['InternHours'])) {                                  //maak totaal aantal uren en dagen voor de interne boekingen en sla deze op
                foreach ($userMonthbooking['InternHours'] as $booking) {
                    $userMonthbookings[$key]['UserMonthbookings']['internHoursTotal'] += $booking['hours'];
                    $userMonthbookings[$key]['UserMonthbookings']['internDays']++;
                }
            }
            unset($userMonthbookings[$key]['ContractHours']);       //deze data is gebruikt en niet meer nodig voor de index view
            unset($userMonthbookings[$key]['InternHours']);         //deze data is gebruikt en niet meer nodig voor de index view
        }
        $role = $this->User->find('first', array('conditions' => array('user_id' => $this->user_id), 'fields' => 'role_id', 'recursive' => -1));
        $this->set(array('UserMonthbookings' => $userMonthbookings, 'role_id' => $role['User']['role_id']));
    }

    public function view($id = null)
    {
        $this->editView($id);
    }


    public function add_userMonthBooking()
    {

        //todo: add user_monthbookings

    }


    public function add()
    {
        //todo: opslaan uren
        if ($this->request->is('post')) {

            if (isset($this->request->data['Monthbooking'])) {
                $this->postBooking($this->request->data['Monthbooking']);
            } else {


                if ($this->request->data) {                      //ophalen van ids van ingevoerde maand en jaar
                    $data = $this->request->data;
                    $yearId = $data['Monthbookings']['year_id'];
                    $month = $data['Monthbookings']['month_id'];

                    if (!$this->checkIfRecordExists('Monthbookings', $data['Monthbookings'])) {
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
                        'user_id' => $this->user_id
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
                                'user_id' => $this->user_id
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
                        'Contracts.user_id' => $this->user_id
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


            $this->UserMonthbookings->id = $id;
            $checkParams = array(                                   //check of de user en de monthbooking combi nog steeds klopt, bescherming tegen inspector gesjoemel
                'UserMonthbookings.user_monthbooking_id' => $id,
                'UserMonthbookings.user_id' => $this->user_id
            );

            if ($this->UserMonthbookings->hasAny($checkParams)) {   //check of de user en de monthbooking combi nog steeds klopt, bescherming tegen inspector gesjoemel
                $error = false;
                foreach ($this->request->data['Monthbooking'] as $key => $data) {
                    $booking = explode('_', $key);
                    if ($booking[0] == 'contract') {
                        $saveParamsContracts = array(     //ordenen van gegevens uit de request->data zodat deze als condities gebruikt kunnen worden bij het opslaan
                            'ContractHours' => array(
                                'hours' => $data,
                                'contract_id' => $booking[1],
                                'day' => $booking[2]
                            )
                        );
                        if (isset($saveParamsContracts)) {
                            $this->ContractHours->create();
                            if (isset($booking[3])) {
                                $this->ContractHours->id = $booking[3];
                            }
                            $this->ContractHours->save($saveParamsContracts);
                        }

                    } elseif ($booking[0] == 'intern') {    //ordenen van gegevens uit de request->data zodat deze als condities gebruikt kunnen worden bij het opslaan
                        $intern[] = array(
                            'fields' => array(
                                'InternHours.hours' => $data
                            )
                        );
                        $saveParamsIntern = array(
                            'InternHours' => array(
                                'hours' => $data,
                                'intern_hour_type_id' => $booking[1],
                                'day' => $booking[2]
                            )
                        );

                        if (isset($saveParamsIntern)) {
                            $this->InternHours->create();
                            if (isset($booking[3])) {
                                $this->InternHours->id = $booking[3];
                            }
                            $this->InternHours->save($saveParamsIntern);
                        }

                    } else {
                        $error = true;
                        $faults[] = $data;
                    }


                }

                if ($error && isset($faults)) {
                    $this->Flash->error(__('Fout bij opslaan. De volgende wijzigingen zijn niet opgeslagen:' . debug($faults)));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->success(__('Wijzigingen opgeslagen.'));
//                    return $this->redirect(array('action' => 'index'));
//                    $this->Flash->error(__('Fout bij opslaan. De wijzigingen zijn niet (volledig) opgeslagen. Probeer het nog eens.'));
//                    return $this->redirect(array('action' => 'index'));
                }

            } else {
                $this->Flash->error(__('Fout bij opslaan. De boeking van deze gebruiker is niet herkent. Probeer het nog eens.'));
                return $this->redirect(array('action' => 'index'));
            }

        } else {
            $this->editView($id);
        }
    }

    public function delete($id = null)
    {
        $this->request->allowMethod('post');

        $checkParams = array(
            'User.role_id' => 1,
            'User.user_id' => $this->user_id
        );
        if ($this->User->hasAny($checkParams)) {
            $this->UserMonthbookings->id = $id;
            if (!$this->UserMonthbookings->exists()) {
                throw new NotFoundException(__('boeking niet gevonden'));
            }
            if ($this->UserMonthbookings->save(array('active' => false))) {
                $this->Flash->success(__('boeking verwijderd'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Fout bij deleten. De boeking is niet verwijderd. Probeer het nog eens.'));
            return $this->redirect(array('action' => 'index'));
        } else {
            $this->Flash->error(__('U bent niet bevoegd deze bewerking uit te voeren'));
            return $this->redirect(array('action' => 'index'));
        }
    }

    public function create()
    {                                                                               //ophalen contracten adhv user_id om te bepalen hoeveel rijen gemaakt
        //gaan worden voor de werkuren boeking, meegeven maanden en jaren
        $params = array(                                                            //die toegestaan worden door contracten
            'conditions' => array('contracts.user_id' => $this->user_id),
            'recursive' => -1,
            'order' => array('Contracts.start_date' => 'desc')
        );
        $contracts = $this->Contracts->find('all', $params);
        foreach ($contracts as $contract) {                      //@TODO nakijken wat er hier van weg kan

        }
        //$this->set(array('months' => $months, 'years' => $years));
    }

    public function postBooking($data)
    {
        $newData = array();
        $recordExist = false;
        $description = "text";      //@TODO toevoegen van omschrijving invoerveld bij elke boeking
        $userMonthbookingId = array_pop($data);

        if ($this->checkIfRecordExists('UserMonthbookings', array('conditions' => array('UserMonthbookings.user_id' => $this->user_id)))) {

            foreach ($data as $key => $value) {
                if ($value !== '') {
                    $key = explode('_', $key);
                    if ($key[0] == 'contract') {
                        if (!$this->checkIfRecordExists('ContractHours', array('day' => $key[1], 'contract_id' => $key[2], 'user_monthbooking_id' => $userMonthbookingId))) {
                            $newData['ContractHours'][] = ['description' => $description, 'hours' => $value, 'day' => $key[1], 'contract_id' => $key[2], 'user_monthbooking_id' => $userMonthbookingId];
                        } else {
                            $recordExist = true;
                        }
                    } elseif ($key[0] == 'intern') {
                        if (!$this->checkIfRecordExists('InternHours', array('day' => $key[1], 'intern_hour_type_id' => $key[2], 'user_monthbooking_id' => $userMonthbookingId))) {
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
            } else {
                $this->Flash->success(__('Uren opgeslagen.'));
                return $this->redirect(array('controller' => 'User', 'action' => 'index'));
            }
        } else {
            $this->Flash->error(__('Fout bij invoer. verkeerd ID terug gekregen.'));
            return $this->redirect(array('action' => 'add'));
        }
    }

    public function checkDayType($month, $year)     //month in '04', year in '2019'
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
        return $days;   //returned assocarray met alle dagen van ingevoerde maand met 'feestdagnaam', 'weekend', '' als key value afhankelijk van de dag
    }

    public function checkIfRecordExists($model, $params)
    {
        return $this->$model->hasAny($params);              //returned boolean
    }

    public function editView($id)
    {
        $this->UserMonthbookings->id = $id;
        $this->UserMonthbookings->Behaviors->load('Containable');

        if (!$this->UserMonthbookings->exists()) {
            throw new NotFoundException(__('Boeking niet gevonden.'));
        }
        $tableData = array();

        $params = array(
            'conditions' => array(
                'user_monthbooking_id' => $id
            ),
            'contain' => array(
                'User' => array(
                    'username'
                ),
                'Monthbookings' => array(
                    'Years',
                    'Months'
                ),
                'InternHours' => array(
                    'intern_hour_id',
                    'hours',
                    'day',
                    'intern_hour_type_id'
                ),
                'ContractHours' => array(
                    'contract_hour_id',
                    'hours',
                    'day',
                    'contract_id'
                )
            )
        );


        $types = $this->InternHoursTypes->find('list', array('fields' => 'description'));
        $contractNames = $this->Contracts->find('list');
        $bookings = $this->UserMonthbookings->find('all', $params);

        $username = $bookings[0]['User']['username'];
        $userMonthbooking = $bookings[0]['UserMonthbookings'];
        $days = $this->checkDayType($bookings[0]['Monthbookings']['Months']['month_id'], $bookings[0]['Monthbookings']['Years']['year']);

        $date = $bookings[0]['Monthbookings']['Months']['month'] . ' ' . $bookings[0]['Monthbookings']['Years']['year'];
        foreach ($bookings[0]['ContractHours'] as $booking) {
            $tableData[$contractNames[$booking['contract_id']]] = $booking['contract_id'] . '_contract';
            $hoursData[] = $booking;
        }
        foreach ($bookings[0]['InternHours'] as $booking) {
            $tableData[$types[$booking['intern_hour_type_id']]] = $booking['intern_hour_type_id'] . '_intern';
            $hoursData[] = $booking;
        }

        $store = null;
        $data[0] = array_unique($tableData);
        for ($i = 1; $i < count($days); $i++) {
            $a = 0;
            foreach ($data[0] as $column) {
                foreach ($hoursData as $hourData) {
                    if (isset($hourData['contract_id'])) {
                        $store = $hourData['contract_id'] . '_contract';
                    } elseif (isset($hourData['intern_hour_type_id'])) {
                        $store = $hourData['intern_hour_type_id'] . '_intern';
                    } else {
                        $data[$i][$a] = '';
                        break;
                    }
                    if ($i == $hourData['day'] && $store == $column) {
                        $data[$i][$a] = $hourData;
                        break;
                    } else {
                        $data[$i][$a] = '';
                    }
                }
                $a++;
            }
        }
        $this->set(compact('userMonthbooking', 'data', 'date', 'username', 'days'));
    }

}