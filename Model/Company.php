<?php

App::uses('Model', 'Model');

class Company extends AppModel {
    public $primaryKey = 'company_id';
    public $hasOne = array(
        'Contract' => array(
            'className' => 'Contract',
            'conditions' => '',
            'foreignKey' => 'contract_id',
            'order' => '',
            'fields' => '',
            'dependent' => false
        )
    );
}