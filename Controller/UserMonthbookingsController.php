<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

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
    public $uses = array('UserMonthbookings', 'Monthbookings', 'ContractHours', 'InternHours', 'InternHoursTypes', 'User', 'Contracts', 'Months', 'Years', 'Company', 'CakePdf', 'CakePdf.Pdf', 'CakeEmail', 'Network/Email');
    public $helpers = array('Html', 'Form');
    public $components = array('Paginator', 'Math');

//    public function beforeFilter()
//    {
//        if (AuthComponent::user('role_id') !== '1') {
//            $this->Flash->error(__('Je hebt geen autorisatie voor deze handeling.'));
//            $this->redirect('/');
//        }
//    }


    public function index()
    {
//        s
        $this->UserMonthbookings->contain(array('Monthbookings' => array('Years', 'Months')));
        $this->paginate = array(
            'conditions' => array(
                'UserMonthbookings.user_id' => $this->Auth->user('user_id')
            )
        );

        $userMonthbookings = $this->Paginator->paginate('UserMonthbookings');

        $this->set(array('UserMonthbookings' => $userMonthbookings));
    }

    public function edit($userMonthbookingId)
    {
        $allData = $this->addHours($userMonthbookingId);
        $this->set(array(
                'daysColor' => $allData[0],
                'year' => $allData[1],
                'month' => $allData[2],
                'contracts' => $allData[3],
                'bookingInfo' => $allData[4],
                'bookingTypes' => $allData[5],
                'userMonthbookingId' => $userMonthbookingId)
        );
        return $this->render('add');
    }

    public function addMonthBooking()
    {
        //if there is request data AKA submit form
        if ($this->request->is('post')) {

            $first = true;
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
                    $userMonthbookingId = $this->addUserMonthBooking($this->Monthbookings->getLastInsertID());
                }

            } else {

                //Now that we know the default monthbooking already exists lets check if the user monthbooking is there
                $userMonthbookingId = $this->addUserMonthBooking($checkIfAlreadyExists['Monthbookings']['monthbooking_id']);

            }

            if ($userMonthbookingId) {
                //todo redirect to the hours of this monthbooking

                $allData = $this->addHours($userMonthbookingId, $first);
                $this->set(array(
                        'daysColor' => $allData[0],
                        'year' => $allData[1],
                        'month' => $allData[2],
                        'contracts' => $allData[3],
                        'bookingInfo' => $allData[4],
                        'bookingTypes' => $allData[5],
                        'userMonthbookingId' => $userMonthbookingId)
                );
                return $this->render('add');

            } else {
                //todo return error alert to try it again
            }

        }

        $this->set('values', $this->getMonthsYears());

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

    public function view_pdf($userMonthbookingId = null)
    {
        if (!$userMonthbookingId) {
            $this->Flash->error('Sorry, there was no PDF selected.');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'), null, true);
        }
        $this->layout = 'pdf'; //this will use the pdf.ctp layout

        $allData = $this->addHours($userMonthbookingId);
        $this->set(array(
            'daysColor' => $allData[0],
            'year' => $allData[1],
            'month' => $allData[2],
            'contracts' => $allData[3],
            'bookingInfo' => $allData[4],
            'bookingTypes' => $allData[5],
            'userMonthbookingId' => $userMonthbookingId,
            'hours' => $this->request->data
        ));

        $this->render();    //TODO zorgen dat dit formulier ook werkt voor meerdere contracten en het totaal opteld voor de interne uren. NB de data zal in deze functie anders ingedeeld moeten worden

    }

    public function settings()
    {
        SessionComponent::delete('searchInfo');             //reset vooropgeslagen zoekdata die vanuit een eerdere zoekopdracht is opgeslagen in de sessie
        $status = array(0 => 'openstaand', 1 => 'goedgekeurd', 2 => 'beide');
        $active = array(0 => 'non actief', 1 => 'actief', 2 => 'beide');
        $result = $this->getMonthsYears();

        $this->set('values', array('status' => $status, 'active' => $active, 'months' => $result['months'], 'years' => $result['years']));

        $this->render('settings');
    }

    public function search()
    {
        SessionComponent::delete('searchInfo');             //reset vooropgeslagen zoekdata die vanuit een eerdere zoekopdracht is opgeslagen in de sessie
        $this->control();
    }

    public function approve()
    {
        $this->request->allowMethod('post');
        foreach ($this->request->data['UserMonthbookings'] as $key => $value) {
            $this->UserMonthbookings->id = $key;
            if (!$this->UserMonthbookings->exists()) {
                throw new NotFoundException(__('Boeking ' . $key . 'niet gevonden'));
            }
            if (!$this->UserMonthbookings->save(array('UserMonthbookings' => array('status' => $value)))) {
                $this->Flash->error(__('Fout bij goedkeuring van boeking ' . $key . ', probeer het nog eens.'));
            }
        }
        $this->control();
    }

    public function attentionMail()
    {
        $this->autoRender = false;
        $response["success"] = false;
        $response["message"] = "Server error";

        if ($this->request->is('post')) {

            //vind user gegevens
            $user = $this->User->find('first', array(
                'recursive' => -1,
                'conditions' => array(
                    'User.user_id' => $this->request->data["id"]
                ),
                'fields' => array(
                    'username',
                    'email'
                )
            ));

            //vind tekst voor email
            $tekst = $this->Administration->find('first', array(
                'conditions' => array(
                    'Administrations.administration_id' => 0
                ),
                'fields' => 'text'
            ));

            $Email = new CakeEmail('smtp');             //stuur email naar user
            $Email->viewVars(array('name' => $user['User']['username'], 'tekst' => $tekst));
            $Email->template('urenRegistreren')
                ->emailFormat('html')
                ->from(array('Uren@localhost.com' => 'UrenApp'))
                ->to($user['User']['email'])
                ->subject('Uren registreren')
                ->send();
            $response["success"] = true;
            $response["message"] = "Saved successfully";
        }

        echo json_encode($response);
    }

    private function addHours($userMonthbookingId, $first = false)
    {
        //$this->autoRender = false;
        $this->UserMonthbookings->contain(array('Monthbookings' => array('Years', 'Months')));

        //check if user doesnt change any ids in frontend
        $securityCheck = $this->UserMonthbookings->find('first', array(         //@todo wat als cora boeking van een ander checkt?
            'conditions' => array(
                'UserMonthbookings.user_monthbooking_id' => $userMonthbookingId,
                'UserMonthbookings.user_id' => $this->Auth->user('user_id')
            )
        ));

        if ($securityCheck) {

            if ($this->request->is('post') && !$first) {                        //@TODO deze if wordt afgeschermd voor de addmonthbooking functie omdat deze een post request doet maar nog niet voor de savehoursfunctie. deze check moet echter anders verlopen

                if ($this->saveHours($this->request->data['UserMonthbooking'], $userMonthbookingId)) {
                    //todo return to overzicht maandstaat


                    $this->redirect(array('controller' => 'UserMonthbookings', 'action' => 'index'));
                    die;
                } else {

                    // todo show error
                }

            }

            $bookingInfo = $securityCheck['UserMonthbookings'];

            $this->InternHours->recursive = -1;
            $this->ContractHours->recursive = -1;
            $internHours = $this->InternHours->find('all', array('conditions' => array('user_monthbooking_id' => $userMonthbookingId)));
            $contractHours = $this->ContractHours->find('all', array('conditions' => array('user_monthbooking_id' => $userMonthbookingId)));

            foreach ($internHours as $key => $value) {
                $newKey = 'intern_' . $value['InternHours']['day'] . '_' . $value['InternHours']['intern_hour_type_id'];

                $hoursInternConverted = $this->Math->convertTimeNotationToValues($value['InternHours']['hours'], false);

                $this->request->data['UserMonthbooking'][$newKey] = $hoursInternConverted;
                if ($value['InternHours']['description']) {
                    $this->request->data['UserMonthbooking']['comment_' . $key] = $value['InternHours']['description'];
                }
            }

            foreach ($contractHours as $key => $value) {
                $newKey = 'contract_' . $value['ContractHours']['day'] . '_' . $value['ContractHours']['contract_id'];

                $hoursContractConverted = $this->Math->convertTimeNotationToValues($value['ContractHours']['hours'], false);

                $this->request->data['UserMonthbooking'][$newKey] = $hoursContractConverted;

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

            foreach ($days as $key => $day) {   //dagen worden hier ook omgezet naar bruikbare kleuren voor de tabelvakjes
                $color[$key] = 'yellow';
                if ($day == 'weekend') {
                    $color[$key] = 'lightblue';
                } elseif ($day == '') {
                    $color[$key] = 'white';
                }
            }

            //hier wordt meegestuurd: dagen in int, maanden in int, contracten: begindatum, einddatum, id en bedrijfsnaam, bookingtypes id, userMonthbookingId, booking algemene info.
            return array($color, $year, $chosenMonth, $contracts, $bookingInfo, $bookingTypes, $userMonthbookingId);

            //TEST

        } else {
            $this->Flash->error(__('Verkeerde response ontvangen.'));
            $this->redirect('/');
        }

    }

    private function control()
    {
        if (SessionComponent::check('searchInfo')) {
            $data = SessionComponent::read('searchInfo');
        } else {
            $data = $this->request->data;
            SessionComponent::write('searchInfo', $data);    //sla de zoekdata op om later op te halen via approve()
        }

        $status = $data['UserMonthbookings']['status'];
        $active = $data['UserMonthbookings']['active'];
        $month_id_from = $data['UserMonthbookings']['month_id_from'];
        $month_id_to = $data['UserMonthbookings']['month_id_to'];
        $year_id = $data['UserMonthbookings']['year_id'];
        //opstellen van condities om filtering mogelijk te maken in de control settings en view
        if ($status < 2) {
            $conditions['UserMonthbookings.status'] = $status;
        }
        if ($active < 2) {
            $conditions['UserMonthbookings.active'] = $active;
        }

        $conditions['Monthbookings.year_id'] = $year_id;

        $conditions['and'] = array(
            array(
                'Monthbookings.month_id >= ' => $month_id_from,
                'Monthbookings.month_id <= ' => $month_id_to
            )
        );

        //meenemen van boekingen met uren en periode in maanden en jaren en gebruikersnaam
        $this->UserMonthbookings->contain(array(
            'User.username',
            'Monthbookings' => array(
                'Years' => array('year'),
                'Months' => array('month')
            ),
            'ContractHours' => array(
                'hours'
            ),
            'InternHours' => array(
                'hours'
            )
        ));

        $result = $this->UserMonthbookings->find('all', array('conditions' => $conditions));

        if (count($result) > 0) {
            for ($i = 0; $i < count($result); $i++) {
                $totalInternHours = 0;
                $totalContractHours = 0;
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
                $totalToConvert = $totalInternHours + $totalContractHours;
                $totalHours[$result[$i]['UserMonthbookings']['user_monthbooking_id']] = $this->Math->convertTimeNotationToValues($totalToConvert, false);
            }
        }
        if (empty($totalHours)) {
            $totalHours = 0;
        }

        $this->set(compact('result', 'totalHours'));

        $this->render('control');   //TODO pagination
    }

    private function getMonthsYears()
    {
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

        return compact('years', 'months');
    }


    private function saveHours($dataOrg, $userMonthbookingId)
    {


        $this->ContractHours->recursive = -1;
        $this->InternHours->recursive = -1;


        //opening transaction
        $dataSource = ConnectionManager::getDataSource('default');
        $dataSource->begin();
        $totalHours = 0;

        $result = true;


        foreach ($dataOrg as $key => $value) {


            $comment = null;
            // $originalKey = $key;
            $key = explode('_', $key);

            If ($key[0] === 'comment') {
                break;
            }

            $typeContract = $key[0];
            $day = $key[1];
            $contractOrInternId = $key[2];

            if ($typeContract === 'intern' && $contractOrInternId === '3') {                    //voeg comment toe aan overige interne uren
                $comment = (isset($dataOrg['comment_' . $day]) ? $dataOrg['comment_' . $day] : null);
            }

            $hours = ($typeContract == 'contract' ? $this->ContractHours->find('first', array('conditions' => array('contract_id' => $contractOrInternId, 'day' => $day, 'user_monthbooking_id' => $userMonthbookingId))) : $this->InternHours->find('first', array('conditions' => array('day' => $day, 'user_monthbooking_id' => $userMonthbookingId, 'intern_hour_type_id' => $contractOrInternId))));


            if (!$hours) {

                if ($typeContract == 'contract' && !empty($value)) {
                    $totalHours += $value;

                    $this->ContractHours->create();

                    $value = $this->Math->convertTimeNotationToValues($value, true);

                    $data = array(
                        'contract_id' => $contractOrInternId,
                        'user_monthbooking_id' => $userMonthbookingId,
                        'day' => $day,
                        'hours' => $value
                    );

                    if (!$this->ContractHours->save($data))
                        $result = false;

                } elseif ($typeContract == 'intern' && !empty($value)) {
                    $totalHours += $value;

                    $this->InternHours->create();

                    $value = $this->Math->convertTimeNotationToValues($value, true);

                    $data = array(
                        'intern_hour_type_id' => $contractOrInternId,
                        'user_monthbooking_id' => $userMonthbookingId,
                        'day' => $day,
                        'hours' => $value,
                        'description' => $comment
                    );

                    if (!$this->InternHours->save($data))
                        $result = false;

                }


            } else {

                if ($typeContract == 'contract' && !empty($value)) {
                    $totalHours += $value;

                    $value = $this->Math->convertTimeNotationToValues($value, true);

                    $data = array(
                        'contract_id' => $contractOrInternId,
                        'user_monthbooking_id' => $userMonthbookingId,
                        'day' => $day,
                        'hours' => $value
                    );

                    $this->ContractHours->id = $hours['ContractHours']['contract_hour_id'];

                    if (!$this->ContractHours->save($data))
                        $result = false;


                } elseif ($typeContract == 'intern' && !empty($value)) {
                    $totalHours += $value;

                    $value = $this->Math->convertTimeNotationToValues($value, true);

                    $data = array(
                        'intern_hour_type_id' => $contractOrInternId,
                        'user_monthbooking_id' => $userMonthbookingId,
                        'day' => $day,
                        'hours' => $value,
                        'description' => $comment
                    );

                    $this->InternHours->id = $hours['InternHours']['intern_hour_id'];
                    if (!$this->InternHours->save($data))
                        $result = false;
                } else {


                    $result = ($typeContract == 'contract' ? $this->ContractHours->delete($hours['ContractHours']['contract_hour_id']) : $this->InternHours->delete($hours['InternHours']['intern_hour_id']));

                }


            }


            if ($result === false) {
                break;
            }


        }
        //  @TODO totaal aantal dagen aanpassen aan huidige maand, geen standaard 160 uur
        //use the total amount of days and hours to be able to warn the user for insufficient declared hours.
//        if ($totalHours < 160) {
//            $hourDiff = 160 - $totalHours;
//            echo $this->Flash->error(__('Het totaal aantal ingediende uren haalt de standaard maandtax van 160 uur niet. Er komen ' . $hourDiff . ' uren tekort.'));
//        } elseif ($totalHours > 160) {
//            $hourDiff = $totalHours - 160;
//            echo $this->Flash->error(__('Het totaal aantal ingediende uren is hoger dan de standaard maandtax van 160 uur. Er zijn ' . $hourDiff . ' uren extra geboekt.'));
//        }
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
