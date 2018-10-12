<div class="users form">
    <?php echo $this->Form->create('User'); ?>
            <fieldset>
                    <legend><?php echo __('Edit User'); ?></legend>
            <?php
                    echo $this->Form->input('id');
                    echo $this->Form->input('email');
                    echo $this->Form->input('password');
                    echo $this->Form->input('firstname');
                    echo $this->Form->input('lastname');
            ?>
            </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
        <li><?php echo $this->Html->link(__('Alle gebruikers'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuwe gebruiker'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Alle contracten'), array('controller' => 'Contract', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuw contract'), array('controller' => 'Contract', 'action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Alle boekingen'), array('controller' => 'products', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuwe boeking'), array('controller' => 'products', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Alle bedrijven'), array('controller' => 'products', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuw bedrijf'), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
