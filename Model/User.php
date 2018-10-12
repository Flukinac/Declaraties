<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');


class User extends AppModel {
    public $primaryKey = 'user_id';
    public $belongsTo = array(
        'Roles' => array(
            'className' => 'Roles',
            'conditions' => '',
            'foreignKey' => 'role_id',
            'order' => '',
            'fields' => 'description',
            'dependent' => false
        )
    );
    public $hasMany = array(
        'User_monthbookings' => array(
            'className' => 'User_monthbookings',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'dependent' => false,
        ),
        'Contracts' => array(
            'className' => 'Contracts',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'dependent' => false
        )
    );

    public function findAllUsers($limit = 5) {
        $params = array(
            'limit' => $limit
            );
        return $this->find('all', $params);
    }
//
//    public function saveUser($data = null, $params = array()) {
//        $this->create();
//        if ($this->request->allowMethod('Post', 'Put')) {
//            if ($params['user']['user']['id'] == null) {
//                if($this->save($data)) {
//                    $this->Flash->succes(__('Nieuwe user opgeslagen'));
//                    return $this->redirect(array('action' => 'user'));
//                } else {
//                    $this->Flash->error(__('Fout bij opslaan'));
//                }
//            }
//        }
//    }
//
//    public function updateUser($data, $params = array()) {
//        $this->create();
//
//        if($this->request->allowMethod('Post', 'Put')) {
//            if ($this->save($data, $params)) {
//                $this->Flash->succes(__('User geupdate'));
//                return $this->redirect(array('action' => 'user'));
//            } else {
//                $this->Flash->error(__('Fout bij updaten'));
//            }
//        }
//    }

//    public function deleteUser($params = array()) {
//
//    }
}