<?php
App::uses('appController', 'Controller');

/**
 * @property Contracts $Contracts
 * @Property UserMonthbookings $UserMonthbookings
 * @Property InternHours $InternHours
 * @property User $User
 * @property ContractHours $ContractHours
 */

class UserController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('User', 'Roles', 'Contracts', 'InternHoursTypes', 'InternHours');
    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();

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
            if ($this->User->save($this->request->data, $saveParams)) {
                $this->Flash->success(__('Gebruiker opgeslagen.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('Fout bij opslaan. De gebruiker is niet opgslagen. Probeer het nog eens.')
            );
        } else {
            $params = array(
                'conditions' => array('user_id' => $id),
                'recursive' => 0,
                'fields' => array(
                    'User.user_id',
                    'User.username',
                    'User.password',
                    'User.role_id',
                )
            );
            $paramsRoles = array(
                'recursive' => 0,
                'fields' => array(
                    'role_id', 'description'
                )
            );
            $user = $this->User->find('first', $params);


            $this->request->data['User'] = $user['User'];

            $roles = $this->Roles->find('list', $paramsRoles);
            $values = compact('user', 'roles');

            return $this->set($values);
        }
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