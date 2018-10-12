<?php

App::uses('appController', 'Controller');

class CompanyController extends AppController {
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('companies', $this->Company->find('all'));
    }

    public function add() {
        if ($this->request->is('Post')) {
            $this->Company->create();
            if ($this->Company->save($this->request->data)) {
                $this->Flash->success(__('Nieuw bedrijf aangemaakt'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your company.'));
        }
    }

    public function update($id) {
        if ($id !== null) {
            $this->set('company' ,$this->Company->find('first', array('conditions' => array('Company.company_id' => $id))));
        } else {
            $this->Flash->error(__('Bedrijf niet gevonden!'));
        }
    }

    public function edit($id) {
        if ($id !== null) {
            $this->Company->company_id = $id;
            $this->Company->set(array());
            if ($this->Company->save($this->request->data)) {
                $this->Flash->success(__('Bedrijf gewijzigd.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Bedrijf wijzigen mislukt.'));
                return $this->redirect(array('action' => 'update'));
            }
        } else {
            $this->Flash->error(__('Bedrijf niet gevonden!.'));
        }
    }
}


