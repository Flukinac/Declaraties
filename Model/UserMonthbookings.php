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


class UserMonthbookings extends AppModel {
    public $primaryKey = 'user_monthbooking_id';
    public $hasOne = array(
        'User' => array(
            'className' => 'User',
            'conditions' => '',
            'foreignKey' => 'user_id',
            'order' => '',
            'fields' => '',
            'dependent' => false
        ),
        'Monthbookings' => array(
            'className' => 'Monthbookings',
            'conditions' => '',
            'foreignKey' => 'monthbooking_id',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'dependent' => false,
        )
    );
}