<?php

App::uses('appController', 'Controller');

/**
 * @property Company $Company
 * @property Contracts $Contracts
 * @property ContractsHours $ContractsHours
 */
class CompanyController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('Company', 'Contracts', 'ContractsHours');
    public $components = array('Paginator');
    public $paginate = array('limit' => 10);


    public function index() {
        $this->checkAuth(6);

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
        $this->checkAuth(7);

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

            $this->set($company);
        }
    }
    public function delete($id = null) {

        $this->request->allowMethod('post');

        $this->Company->id = $id;
        if (!$this->Company->exists()) {
            throw new NotFoundException(__('Bedrijf niet gevonden'));
        }
        if ($this->Company->save(array('fields' => array('Company.active' => 0)))) {
            $this->Contracts->updateAll(array('Contracts.active' => 0), array('Contracts.company_id' => $id));

            $contractIds = $this->Contracts->find('list', array(
                'conditions' => array(
                    'Contracts.company_id' => $id,
                    'Contracts.active' => 0
                ),
                'fields' => 'Contracts.contract_id'
            ));

            $conditions = array(
                array('Contracts.user_id' => $userId),
                'AND' => $contractIds
            );

            foreach ($contractIds as $value) {
                $this->ContractsHours->updateAll(array('ContractsHours.active' => 0), array('Contracts.contract_id' => $value));
            }


            $this->Flash->success(__('Bedrijf verwijderd'));
        } else {
            $this->Flash->error(__('Fout bij deleten. Het bedrijf is niet verwijderd. Probeer het nog eens.'));
        }
        return $this->redirect(array('action' => 'index'));

    }
}


