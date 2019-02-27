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


class ContractHours extends AppModel {
    public $primaryKey = 'contract_hour_id';
    public $belongsTo = array(
        'Contracts' => array(
            'className' => 'Contracts',
            'foreignKey' => 'contract_id',
            'dependent' => false
        ),
        'UserMonthbookings' => array(
            'className' => 'UserMonthbookings',
            'foreignKey' => 'user_monthbooking_id',
            'dependent' => false
        )
    );
    public $validate = array(       //@todo messages actief maken
        'hours' => array(
            'comparison' => array(
                'rule' => array('comparison', '>=', 0),
                'message' => 'Invoer moet tussen 0-16 liggen'
            ),
            'comparison2' => array(
                'rule' => array('comparison', '<=', 16),
                'message' => 'Invoer moet tussen 0-16 liggen'
            ),
//            'numeric' => array(
//                'rule' => 'numeric',                          //@todo activeren als het mogelijk is om ook : in te voeren
//                'message' => 'Invoer moet uit cijfers bestaan'
//            ),
        )
    );
}