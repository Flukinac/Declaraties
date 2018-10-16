<?php
App::uses('appController', 'Controller');

class UserController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('User', 'Roles', 'Contracts');
    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();

//        $model = 'Contracts';
//        $this->loadModel($model);
//        debug($this->$model->find('first'));
//        exit();
    }

    public function index() {
        $this->User->recursive = 1;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
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
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
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
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $params = array(
                'conditions' => array('user_id' => $id),
                'recursive' => 0,
                'fields' => array(
                    'User.user_id',
                    'User.username',
                    'User.password',
                    'Roles.role_id',
                    'Roles.description'
                )
            );
            $paramsRoles = array(
                'recursive' => 0,
                'fields' => array(
                    'role_id', 'description'
                )
            );
            $user = $this->User->find('first', $params);
            $roles = $this->Roles->find('list', $paramsRoles);
            $values = compact('user', 'roles');

            return $this->set($values);
            //unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
}