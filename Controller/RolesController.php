<?php
App::uses('appController', 'Controller');

/**
 * @property Roles $Roles
 * @property Abilities $Abilities
 * @property AbilitiesRoles $AbilitiesRoles
 * @property User $User
 */

class RolesController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('Roles', 'User', 'Abilities', 'AbilitiesRoles');
    public $components = array('Paginator');


    public function index() {
        $this->checkAuth(5);

        $this->Roles->recursive = -1;
        $this->set('roles', $this->Paginator->paginate('Roles'));
    }

    public function view($id = null) {
        // ophalen van alle items per rol die verschillende functies vervullen.
    }

    public function add() {
        $this->checkAuth(5);

        if ($this->request->is('post')) {

            $this->Roles->create();
            $this->AbilitiesRoles->create();
            $data = $this->request->data['AbilitiesRoles'];
            $this->Roles->set('description', $data['roleName']);

            if ($this->Roles->save()) {
                $insertId  = $this->Roles->getLastInsertID();
                array_shift($data);
                if (count($data) >= 1) {
                    foreach ($data as $ability) {
                        if ($ability !== '0') {
                            $store[] = array('role_id' => $insertId, 'ability_id' => $ability);
                        }
                    }
                    $this->AbilitiesRoles->saveMany($store);
                }
                $this->Flash->success(__('Rol opgeslagen.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Fout bij opslaan. De rol is niet opgslagen. Probeer het nog eens.'));
        } else {
            $abilities = $this->Abilities->find('all');
            $this->set('abilities', $abilities);
        }
    }

    public function edit($id = null) {
        $this->checkAuth(5);

        if ($this->request->is('post') || $this->request->is('put')) {

            $this->Roles->id = $id;

            //opening transaction
            $dataSource = ConnectionManager::getDataSource('default');
            $dataSource->begin();
            $result = true;

            $data = $this->request->data['AbilitiesRoles'];
            if (!$this->Roles->save(array('description' => $data['roleName']))) {
                $result = false;
            }

            if (!$this->AbilitiesRoles->deleteAll(array('role_id' => $id))) {
                $result = false;
            }

            array_shift($data);
            if (count($data) >= 1) {
                foreach ($data as $ability) {
                    if ($ability !== '0') {
                        $store[] = array('role_id' => $id, 'ability_id' => $ability);
                    }
                }
                if (isset($store)) {
                    if (!$this->AbilitiesRoles->saveMany($store)) {
                        $result = false;
                    }
                }
            }

            if ($result) {
                $dataSource->commit();
                $this->Flash->success(__('Rol opgeslagen.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $dataSource->rollback();
                $this->Flash->error(__('Fout bij opslaan. De rol is niet opgslagen. Probeer het nog eens.'));
                return $this->redirect(array('action' => 'index'));
            }

        } else {

            $abilities = $this->Abilities->find('all');

            $roleDescription = $this->Roles->find('list', array(
                'conditions' => array(
                    'role_id' => $id),
                'fields' => 'description'
            ));

            $description = array_pop($roleDescription);

            $role = $this->AbilitiesRoles->find('all', array(
                'conditions' => array(
                    'role_id' => $id)
            ));

            foreach ($role as $abilityId) {
                $abilityIds[] = $abilityId['AbilitiesRoles']['ability_id'];
            }

            $this->set(compact('description','abilityIds', 'abilities'));
        }
    }

    public function delete($id = null) {

        $this->request->allowMethod('post');

        $this->Roles->id = $id;
        if (!$this->Roles->exists()) {
            throw new NotFoundException(__('Rol niet gevonden'));
        }
        $users = $this->Roles->find('first', array(
            'conditions' => array(
                'Roles.role_id' => $id
            )
        ));

        if ($users['User'][0] !== null)  {
            $this->Flash->error(__('Rol kan nog niet verwijderd worden. Er zijn nog gebruikers die deze rol bezitten. Geef deze gebruikers eerst een andere rol.'));
            return $this->redirect(array('action' => 'index'));
        }
        if ($this->Roles->delete()) {
            $this->Flash->success(__('Rol verwijderd'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('Fout bij deleten. De rol is niet verwijderd. Probeer het nog eens.'));
        return $this->redirect(array('action' => 'index'));
    }
}