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
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $primaryKey = 'user_id';
    public $belongsTo = array(
        'Roles' => array(
            'className' => 'Roles',
            'conditions' => '',
            'foreignKey' => 'role_id',
            'order' => '',
            'dependent' => false
        )
    );

    public $hasMany = array(
        'UserMonthbookings' => array(
            'className' => 'UserMonthbookings',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'dependent' => false
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

    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Een naam is vereist'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Een wachtwoord is vereist'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'user', 'company')),
                'message' => 'Voer een geldige waarde in',
                'allowEmpty' => false
            )
        )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}