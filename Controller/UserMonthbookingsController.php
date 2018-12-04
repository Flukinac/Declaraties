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
class UserMonthbookingsController extends AppController
{
    public $uses = array('UserMonthbookings', 'Monthbookings', 'ContractHours', 'InternHours', 'InternHoursTypes', 'User', 'Contracts', 'Months', 'Years', 'Company');
    public $helpers = array('Html', 'Form');
    public $components = array('Paginator');

    public function beforeFilter()
    {

    }

    public function index()
    {

        $this->UserMonthbookings->contain(array('Monthbookings' => array('Years', 'Months')));
        $this->paginate = array(
            'conditions' => array(
                'UserMonthbookings.user_id' => $this->Auth->user('user_id')
            )
        );

        $userMonthbookings = $this->Paginator->paginate('UserMonthbookings');

        $this->set(array('UserMonthbookings' => $userMonthbookings));
    }


    public function addMonthBooking()
    {
        //if there is request data AKA submit form
        if ($this->request->is('post')) {

            //set recursive to -1 because we only need the monthbooking table data
            $this->Monthbookings->recursive = -1;

            //select query to check if monthbooking exists
            $checkIfAlreadyExists = $this->Monthbookings->find('first', array(
                'conditions' => array(
                    'month_id' => $this->request->data['Monthbookings']['month_id'],
                    'year_id' => $this->request->data['Monthbookings']['year_id']
                )
            ));

            //check if monthbooking already exists if not lets create it
            if (!$checkIfAlreadyExists) {

                if ($this->Monthbookings->save($this->request->data)) {

                    //todo create user monthbooking
                    $result = $this->addUserMonthBooking($this->Monthbookings->getLastInsertID());
                }

            } else {

                //Now that we know the default monthbooking already exists lets check if the user monthbooking is there
                $result = $this->addUserMonthBooking($checkIfAlreadyExists['Monthbookings']['monthbooking_id']);

            }


            if ($result) {
                //todo redirect to the hours of this monthbooking
                $this->redirect(array('controller' => 'UserMonthbookings', 'action' => 'addHours', $result));
                die;
            } else {
                //todo return error alert to try it again
            }

        }


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

        $this->render('create');

    }


    public function addUserMonthBooking($monthbookingId)
    {


        //only user month booking is needed for the check
        $this->UserMonthbookings->recursive = -1;

        //select query to check if user monthbooking exists
        $checkIfAlreadyExists = $this->UserMonthbookings->find('first', array(
            'conditions' => array(
                'monthbooking_id' => $monthbookingId,
                'user_id' => $this->Auth->user('user_id')
            )
        ));


        if (!$checkIfAlreadyExists) {

            //set data to save if there is no user monthbooking yet..
            $data = array(
                'monthbooking_id' => $monthbookingId,
                'user_id' => $this->Auth->user('user_id')
            );

            //save the user monthbooking
            if ($this->UserMonthbookings->save($data)) {
                return $this->UserMonthbookings->getLastInsertID();
            } else {
                return false;
            }
        }

        return $checkIfAlreadyExists['UserMonthbookings']['user_monthbooking_id'];

    }

    public function addHours($userMonthbookingId)
    {

        $this->UserMonthbookings->contain(array('Monthbookings' => array('Years', 'Months')));

        //check if user doesnt change any ids in frontend
        $securityCheck = $this->UserMonthbookings->find('first', array(
            'conditions' => array(
                'UserMonthbookings.user_monthbooking_id' => $userMonthbookingId,
                'UserMonthbookings.user_id' => $this->Auth->user('user_id')
            )
        ));


        if ($securityCheck) {

            if ($this->request->is('post')) {

                if ($this->saveHours($this->request->data['UserMonthbooking'], $userMonthbookingId)) {

                    //todo return to overzicht maandstaat


                    $this->redirect(array('controller' => 'UserMonthbookings', 'action' => 'index'));
                    die;
                } else {

                    // todo show error
                }

            }

            $this->InternHours->recursive = -1;
            $this->ContractHours->recursive = -1;
            $internHours = $this->InternHours->find('all', array('conditions' => array('user_monthbooking_id' => $userMonthbookingId)));
            $contractHours = $this->ContractHours->find('all', array('conditions' => array('user_monthbooking_id' => $userMonthbookingId)));

            foreach ($internHours as $key => $value) {

                $newKey = 'intern_' . $value['InternHours']['day'] . '_' . $value['InternHours']['intern_hour_type_id'];
                $this->request->data['UserMonthbooking'][$newKey] = $value['InternHours']['hours'];

            }

            foreach ($contractHours as $key => $value) {

                $newKey = 'contract_' . $value['ContractHours']['day'] . '_' . $value['ContractHours']['contract_id'];
                $this->request->data['UserMonthbooking'][$newKey] = $value['ContractHours']['hours'];

            }

            //todo show uren van deze user en maand
            $month = $securityCheck['Monthbookings']['month_id'];
            $year = $securityCheck['Monthbookings']['Years']['year'];
            $monthMax = date('t', $month);

            $params = array(                                                                    //ophalen van contracten van de gebruiker waarbij adhv jaar en maand gecontroleerd
                'fields' => array(                                                              //wordt welke contracten opgehaald moeten worden
                    'Contracts.start_date',
                    'Contracts.end_date',
                    'Contracts.contract_id',
                    'Company.name'
                ),
                'conditions' => array(
                    'Contracts.user_id' => $this->Auth->user('user_id')
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
            $chosenMonth = $securityCheck['Monthbookings']['Months']['month'];

            //hier wordt meegestuurd: dagen in getalvorm, maanden in getalvorm, contracten: begindatum, einddatum, id en bedrijfsnaam, bookingtypes id, userMonthbookingId.
            $this->set(array(
                    'days' => $days,
                    'year' => $year,
                    'month' => $chosenMonth,
                    'contracts' => $contracts,
                    'bookingTypes' => $bookingTypes,
                    'userMonthbookingId' => $userMonthbookingId)
            );


            //TEST

            $this->render('add');


        } else {

            //todo redirect naar logout / index van monthbookings

        }

    }


    private function saveHours($data, $userMonthbookingId)
    {


        $this->ContractHours->recursive = -1;
        $this->InternHours->recursive = -1;


        //opening transaction
        $dataSource = ConnectionManager::getDataSource('default');
        $dataSource->begin();
        $countTotalHours = array();

        $result = true;


        foreach ($data as $key => $value) {


            // $originalKey = $key;
            $key = explode('_', $key);

            $typeContract = $key[0];
            $day = $key[1];
            $contractId = $key[2];

            $hours = ($typeContract == 'contract' ? $this->ContractHours->find('first', array('conditions' => array('contract_id' => $contractId, 'day' => $day, 'user_monthbooking_id' => $userMonthbookingId))) : $this->InternHours->find('first', array('conditions' => array('day' => $day, 'user_monthbooking_id' => $userMonthbookingId, 'intern_hour_type_id' => $contractId))));


            if (!$hours) {

                if ($typeContract == 'contract' && !empty($value)) {
                    $countTotalHours[] = $value;

                    $this->ContractHours->create();

                    $data = array(
                        'contract_id' => $contractId,
                        'user_monthbooking_id' => $userMonthbookingId,
                        'day' => $day,
                        'hours' => $value
                    );

                    if (!$this->ContractHours->save($data))
                        $result = false;

                } elseif ($typeContract == 'intern' && !empty($value)) {
                    $countTotalHours[] = $value;

                    $this->InternHours->create();

                    $data = array(
                        'intern_hour_type_id' => $contractId,
                        'user_monthbooking_id' => $userMonthbookingId,
                        'day' => $day,
                        'hours' => $value
                    );

                    if (!$this->InternHours->save($data))
                        $result = false;

                }


            } else {

                if ($typeContract == 'contract' && !empty($value)) {
                    $countTotalHours[] = $value;

                    $data = array(
                        'contract_id' => $contractId,
                        'user_monthbooking_id' => $userMonthbookingId,
                        'day' => $day,
                        'hours' => $value
                    );

                    $this->ContractHours->id = $hours['ContractHours']['contract_hour_id'];

                    if (!$this->ContractHours->save($data))
                        $result = false;


                } elseif ($typeContract == 'intern' && !empty($value)) {
                    $countTotalHours[] = $value;

                    $data = array(
                        'intern_hour_type_id' => $contractId,
                        'user_monthbooking_id' => $userMonthbookingId,
                        'day' => $day,
                        'hours' => $value
                    );

                    $this->InternHours->id = $hours['InternHours']['intern_hour_id'];
                    if (!$this->InternHours->save($data))
                        $result = false;
                } else {


                    $result = ($typeContract == 'contract' ? $this->ContractHours->delete($hours['ContractHours']['contract_hour_id']) : $this->InternHours->delete($hours['InternHours']['intern_hour_id']));

                }


            }


            if ($result === false)
                break;


        }

        //use the total amount of days and hours to be able to warn the user for insufficient declared hours.
        $totalHours = array_sum($countTotalHours);
        $totalDays = count($countTotalHours);

        if ($totalHours / $totalDays < 8) {
            $hourDiff = $totalDays * 8;
            $hourDiff = $hourDiff - $totalHours;
            echo $this->Flash->error(__('Het totaal aantal ingediende uren haalt de maandtax niet. Er komen ' . $hourDiff . ' uren tekort.'));
        }
        if ($result) {
            $dataSource->commit();
            return true;
        } else {

            $dataSource->rollback();
            return false;
        }


    }


    private function checkDayType($month, $year)     //month in '04', year in '2019'
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

        $bevrijdingsdagen = ['2020', '2025', '2030', '2035', '2040', '2045', '2050'];
        $specialDay = ['1-1', $goedeVrijdag, $easter, $easterMonday, '27-4', '5-5', $hemelvaart, $pinksteren, $pinksterMaandag, '25-12', '26-12'];  //TODO bevrijdingsdag mag 1 keer in de vijf jaar voorkomen
        $specialDayType = ['1 januari', 'Goede vrijdag', 'pasen', 'paasmaandag', 'koningsdag', 'bevrijdingsdag', 'hemelvaart', 'pinksteren', 'pinkstermaandag', '1e kerstdag', '2e kerstdag'];

        if (array_search($year, $bevrijdingsdagen) === false) {  //bevrijdingsdag is 1 keer in de 5 jaar een vrij dag in de meeste CAO's
            $specialDay[5] = false;                              //deze functie haalt de dag eruit wanneer dit niet het geval is.
        }

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
}
