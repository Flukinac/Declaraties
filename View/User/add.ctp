<?php
    echo $this->Form->create('User', array('method' => 'POST', 'action' => 'edit/'));
    echo $this->Form->input('username', array('placeholder' => 'naam'));
    echo $this->Form->input('postalcode', array('placeholder' => 'postcode'));
    echo $this->Form->input('role_id', array('placeholder' => 'rol'));
    echo $this->Form->end('Save Company');
?>

<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Alle gebruikers'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Alle contracten'), array('controller' => 'Contract', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuw contract'), array('controller' => 'Contract', 'action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Alle boekingen'), array('controller' => 'products', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuwe boeking'), array('controller' => 'products', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Alle bedrijven'), array('controller' => 'products', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuw bedrijf'), array('controller' => 'products', 'action' => 'add')); ?> </li>
    </ul>
</div>
