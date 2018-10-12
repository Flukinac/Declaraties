<?php
    echo $this->Form->create('Company', array('method' => 'PUT', 'action' => 'edit/'.$company['Company']['company_id']));
    echo $this->Form->input('name', array('value' => $company['Company']['name']));
    echo $this->Form->input('postalcode', array('value' => $company['Company']['postalcode']));
    echo $this->Form->input('housenumber', array('value' => $company['Company']['housenumber']));
    echo $this->Form->input('housenumber_suffix', array('value' => $company['Company']['housenumber_suffix']));
    echo $this->Form->end('Save Company');
?>