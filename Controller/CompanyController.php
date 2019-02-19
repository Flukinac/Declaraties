<?php

App::uses('appController', 'Controller');

class CompanyController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('Company');
    public $components = array('Paginator');
    public $paginate = array('limit' => 10);

    public function beforeFilter() {
//        if (AuthComponent::user('role_id') !== '1') {
//            $this->Flash->error(__('Je hebt geen autorisatie voor deze handeling.'));
//            $this->redirect('/');
//        }
    }

    public function index() {
        $this->Paginator->settings = $this->paginate;
        $data = $this->Paginator->paginate('Company');
        $this->set('companies', $data);
    }

    public function view($id = null) {
        $this->Company->id = $id;
        if (!$this->Company->exists()) {
            throw new NotFoundException(__('Bedrijf niet gevonden.'));
        }
        $params = array(
            'conditions' => array(
                'company_id' => $id
            )
        );
        $this->set('company', $this->Company->find('first', $params));
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

    public function edit($id) {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Company->id = $id;
            if ($this->Company->save($this->request->data)) {
                $this->Flash->success(__('Bedrijf gewijzigd.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('Bedrijf wijzigen mislukt.'));
                return $this->redirect(array('action' => 'update'));
            }
        } else {
            $params = array(
                'conditions' => array('company_id' => $id),
                'recursive' => 0
            );

            $company = $this->Company->find('first', $params);
            $this->request->data['Company'] = $company['Company'];

            return $this->set($company);
        }
    }
    public function delete($id = null) {

        $this->request->allowMethod('post');

//        $this->Company->id = $id;
//        if (!$this->Company->exists()) {
//            throw new NotFoundException(__('Bedrijf niet gevonden'));
//        }
//        if ($this->Company->delete()) {
//            $this->Flash->success(__('Bedrijf verwijderd'));
//            return $this->redirect(array('action' => 'index'));
//        }
//        $this->Flash->error(__('Fout bij deleten. Het bedrijf is niet verwijderd. Probeer het nog eens.'));

        $this->Flash->error(__('Nog te bepalen welke gegevens er verwijderd gaan worden.'));
        return $this->redirect(array('action' => 'index'));
    }
}


