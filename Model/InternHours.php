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


class InternHours extends AppModel {
    public $primaryKey = 'intern_hour_id';
    public $belongsTo = array(
        'InternHoursTypes' => array(
            'className' => 'InternHoursTypes',
            'foreignKey' => 'intern_hour_type_id',
            'dependent' => false
        ),
        'InternHours' => array(
            'className' => 'InternHours',
            'foreignKey' => 'user_monthbooking_id',
            'dependent' => false
        )
    );

    public $validate = array(
        'hours' => array(
            'Rulename1' => array(
                'rule' => array('comparison', '>=', 0),
                'required' => true,
                'message' => 'Invoer moet tussen 0-16 liggen'
            ),
            'Rulename2' => array(
                'rule' => array('comparison', '<=', 16),
                'required' => true,
                'message' => 'Invoer moet tussen 0-16 liggen'
            ),
            'Rulename3' => array(
                'rule' => 'numeric',
                'required' => true,
                'message' => 'Invoer moet uit cijfers bestaan'
            ),
        )
    );
}