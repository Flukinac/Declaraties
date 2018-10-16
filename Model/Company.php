<?php

App::uses('Model', 'Model');

class Company extends AppModel {
    public $primaryKey = 'company_id';
    public $hasMany = array(
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