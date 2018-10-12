<?php
App::uses('appController', 'Controller');

class UserController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('User');
    public $components = array('Paginator');

    public function index() {
        $this->set('users', $this->Paginator->paginate());
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('Nieuwe gebruiker aangemaakt.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('De gebruiker kon niet worden aangemaakt. Probeer het nog eens.'));
            }
        }
    }

    public function view($id) {
        $params(array(
            'conditions' => array('users.user_id' => $id),
            'limit' => 1
        ));

        return $this->set('user', $this->User->find('first', $params));
    }

    public function edit() {
        //
    }

    public function delete() {
        //
    }
}
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 8-10-2018
 * Time: 11:44
 */