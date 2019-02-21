<?php
App::uses('appController', 'Controller');

/**
 * @Property Administratie $Administratie
 */

class AdministratieController extends AppController
{

    public $helpers = array('Html', 'Form', 'Paginator');
    public $uses = array('Administratie');
    public $components = array('Paginator');

    public function mailTemplate() {
        if ($this->request->is('post')) {
            $this->Administratie->id = 1;

            if (!$this->Administratie->save($this->request->data)) {
                $this->Flash->error(__('Probeer het nog eens.'));
            } else {
                $this->Flash->success(__('Mailtekst gewijzigd.'));
                $this->redirect('/');
            }
        }
        $tekst = $this->Administratie->find('first', array('conditions' => array('administratie_id' => 1), 'fields' => 'text'));
        $this->set('tekst', $tekst['Administratie']['text']);
    }
}//
