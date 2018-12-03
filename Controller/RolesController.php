<?php
App::uses('appController', 'Controller');

/**
 * @property Roles $Roles
 * @property User $User
 */

class RolesController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('Roles', 'User');
    public $components = array('Paginator');

    public function index() {
        $this->Roles->recursive = -1;
        $this->set('roles', $this->Paginator->paginate('Roles'));
    }

    public function view($id = null) {
        // ophalen van alle items per rol die verschillende functies vervullen.
    }

    public function add() {
        if ($this->request->is('post')) {

            //TODO:
            $this->Roles->create();
            if ($this->Roles->save($this->request->data)) {
                $this->Flash->success(__('Rol opgeslagen.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('Fout bij opslaan. De rol is niet opgslagen. Probeer het nog eens.')
            );
        }
    }

    public function edit($id = null) {
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

    public function delete($id = null) {

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
}