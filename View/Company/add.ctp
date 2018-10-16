<?php
    echo $this->Form->create('Company');
    echo $this->Form->input('name');
    echo $this->Form->input('postalcode');
    echo $this->Form->input('housenumber');
    echo $this->Form->input('housenumber_suffix');
    echo $this->Form->end('Save Company');
?>