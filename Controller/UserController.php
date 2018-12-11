<?php
App::uses('appController', 'Controller');

/**
 * @property Contracts $Contracts
 * @Property UserMonthbookings $UserMonthbookings
 * @Property InternHours $InternHours
 * @property Roles $Roles
 * @property User $User
 * @property UserInfo $UserInfo
 * @property Birthplaces $Birthplaces
 * @property Cities $Cities
 * @property Countries $Countries
 * @property ContractHours $ContractHours
 */

class UserController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('User', 'UserInfo', 'Roles', 'Contracts', 'InternHoursTypes', 'InternHours', 'Cities', 'Countries', 'Birthplaces');
    public $components = array('Paginator');

    public function beforeFilter() {
        if (AuthComponent::user('role_id') !== 1) {
            $this->Flash->error(__('Je hebt geen autorisatie voor deze handeling.'));
            $this->redirect('/');
        }

        //modeltesting area
//        $this->loadModel('ContractHours');
//        debug($this->ContractHours->find('all'));
//        exit();
    }

    public function index() {
       $this->User->recursive = 1;

        //$this->User->contain(array('Contracts' => array('fields' => 'contract_id'), 'Roles'));
        // $this->User->find('all', array('fields' => array('')))
        //($this->paginate());
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Gebruiker niet gevonden.'));
        }
        $this->User->contain(array(
            'UserInfo' => array(
                'Cities',
                'Birthplaces',
                'Countries'
            ),
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
        $this->set('user', $this->User->find('first', $params));
    }

    public function add() {
        if ($this->request->is('post')) {

            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Gebruiker opgeslagen.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('Fout bij opslaan. De gebruiker is niet opgslagen. Probeer het nog eens.')
            );
        }

        $roles = $this->Roles->find('list', array(
            'fields' => array(
                'role_id', 'description'
            )
        ));

        $this->set('role', $roles);
    }

    public function edit($id = null) {

        if ($this->request->is('post') || $this->request->is('put')) {
            $saveParams = array(
                'validation' => true,
            );

            $this->User->id = $id;
            if ($this->User->exists()) {

                $dataSource = ConnectionManager::getDataSource('default');
                $dataSource->begin();
                $result = true;

                //doing an create if not exitst on cities, countries and birthplace
                $city_id = $this->Cities->find('first', array(
                    'conditions' => array(
                        'cityname' => $this->request->data['UserInfo']['Cities']['cityname']
                    ),
                    'recursive' => -1
                ));

                if(empty($city_id)) {
                    if ($this->Cities->save($this->request->data['UserInfo']['Cities'], $saveParams)) {
                        $city_id = $this->Cities->getLastInsertID();
                    } else {
                        $result = false;
                    }
                } else {
                    $city_id = $city_id['Cities']['city_id'];
                }

                $birthplace_id = $this->Birthplaces->find('first', array(
                    'conditions' => array(
                        'birthplace' => $this->request->data['UserInfo']['Birthplaces']['birthplace']
                    ),
                    'recursive' => -1
                ));
                if(empty($birthplace_id)) {
                    if ($this->Birthplaces->save($this->request->data['UserInfo']['Birthplaces'], $saveParams)) {
                        $birthplace_id = $this->Birthplaces->getLastInsertID();
                    } else {
                        $result = false;
                    }
                } else {
                    $birthplace_id = $birthplace_id['Birthplaces']['birthplace_id'];
                }

                $country_id = $this->Countries->find('first', array(
                    'conditions' => array(
                        'country' => $this->request->data['UserInfo']['Countries']['country']
                    ),
                    'recursive' => -1
                ));
                if(empty($country_id)) {
                    if ($this->Countries->save($this->request->data['UserInfo']['Countries'], $saveParams)) {
                        $country_id = $this->Countries->getLastInsertID();
                    } else {
                        $result = false;
                    }
                } else {
                    $country_id = $country_id['Countries']['country_id'];
                }

                if (isset($city_id) && isset($birthplace_id) && isset($country_id)) {
                    $info['UserInfo'] = array('user_info_id' => $id, 'city_id' => $city_id, 'birthplace_id' => $birthplace_id, 'country_id' => $country_id);
                }

                $this->UserInfo->id = $id;

                if (!$this->UserInfo->save($info)) {
                    $result = false;
                };

                if (!$this->User->save($this->request->data['User'])) {
                    $result = false;
                }

                if ($result) {
                    $dataSource->commit();
                    $this->Flash->success(__('Gebruiker opgeslagen.'));
                    return $this->redirect(array('controller' => 'User', 'action' => 'index'));
                } else {

                    $dataSource->rollback();
                    $this->Flash->error(__('Fout bij opslaan. De gebruiker is niet opgslagen. Probeer het nog eens.'));
                    return false;
                }
            }
        }

        $this->User->contain(array(
            'UserInfo' => array(
                'Cities',
                'Birthplaces',
                'Countries'
            )
        ));

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

        $userInfo = $this->User->find('first', $params);

        $this->request->data['UserInfo'] = $userInfo['UserInfo'];
        $this->request->data['User'] = $userInfo['User'];
        $this->request->data['Roles'] = $this->Roles->find('list', $paramsRoles);


        return $this->set('values', $this->request->data);
    }

    public function delete($id = null) {

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Gebruiker niet gevonden'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('Gebruiker verwijderd'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Fout bij deleten. De gebruiker is niet verwijderd. Probeer het nog eens.'));
        return $this->redirect(array('action' => 'index'));
    }


}