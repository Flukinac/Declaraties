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

class Administratie extends AppModel
{
    public $primaryKey = 'administratie_id';

    public $validate = array(
        'text' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Dit veld mag niet leeg zijn.'
            ),
            'lengthBetween' => array(
                'rule' => array('lengthBetween', 10, 5000),
                'message' => 'De tekst moet tussen de 10 en 5000 karakters lang zijn.'
            )
        )
    );
}