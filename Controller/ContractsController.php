<?php

App::uses('appController', 'Controller');

/**
 * @property Contracts $Contracts
 * @property User $User
 */

class ContractsController extends AppController {
    public $uses = array('User', 'Contracts', 'Company');
    public $components = array('Paginator');
    public $paginate = array('limit' => 10);


    public function index() {
        $this->Paginator->settings = $this->paginate;
        $data = $this->Paginator->paginate('Contracts');
        $this->set('contracts', $data);
    }

    public function view($id = null) {
        if ($id) {
            $params = array(
                'conditions' => array('contract_id' => $id),
                'fields' => array(
                    'Contracts.*',
                    'User.username',
                    'Company.name'
                ),
                'recursive' => 1
            );

            $contract = $this->Contracts->find('first', $params);

            $this->set('contract', $contract);


        } else {
            echo $this->Flash->error(__('Contract niet gevonden.'));
        }
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Contracts->create();
            if ($this->Contracts->save($this->request->data)) {
                $this->Flash->success(__('Contract opgeslagen.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('Fout bij opslaan. Het contract is niet opgslagen. Probeer het nog eens.')
            );
        }

        $paramsUser = array(
            'fields' => array('User.user_id','User.username'),
            'conditions' => array('User.username !=' => ''),
            'recursive' => 0
        );
        $paramsCompany = array(
            'conditions' => array('company.name !=' => ''),
            'recursive' => 0
        );

        $user = $this->User->find('list', $paramsUser);
        $company = $this->Company->find('list', $paramsCompany);
        $values = compact('user', 'company');

        $this->set('values', $values);
    }

    public function edit($id = null) {

        if ($this->request->is('post') || $this->request->is('put')) {
            $saveParams = array(
                'validation' => true,
            );
            $this->Contracts->id = $id;
            if ($this->Contracts->save($this->request->data, $saveParams)) {
                $this->Flash->success(__('Contract opgeslagen.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('Fout bij opslaan. Het contract is niet opgslagen. Probeer het nog eens.')
            );
        } else {
            $params = array(
                'conditions' => array('contract_id' => $id),
                'recursive' => -1
            );
            $paramsUser = array(
                'fields' => array('User.username'),
                'conditions' => array('User.username !=' => ''),
                'recursive' => 0
            );
            $paramsCompany = array(
                'conditions' => array('company.name !=' => ''),
                'recursive' => 0
            );


            $contract = $this->Contracts->find('first', $params);

            $this->request->data = $contract;

            $user = $this->User->find('list', $paramsUser);
            $company = $this->Company->find('list', $paramsCompany);

            $this->set(array('user' => $user, 'company' => $company));
        }
    }
}
