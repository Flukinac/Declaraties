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

class Contracts extends AppModel {
    public $primaryKey = 'contract_id';

    public $belongsTo = array(
        'Company' => array(
            'className' => 'Company',
            'conditions' => '',
            'foreignKey' => 'company_id',
            'order' => '',
            'fields' => '',
            'dependent' => false
        ),
        'User' => array(
            'className' => 'User',
            'conditions' => '',
            'foreignKey' => 'user_id',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'dependent' => false
        )
    );
    public $hasMany = array(
        'ContractHours' => array(
            'classname' => 'ContractHours',
            'foreignkey' => 'contract_id',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'dependent' => false
        )
    );
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Een contractnaam is vereist'
            )
        ),
        'company_id' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Een bedrijf is vereist'
            )
        ),
        'user_id' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Een gebruiker is vereist'
            )
        )
    );
}