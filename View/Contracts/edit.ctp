<div class="User form"><?php //debug($values); exit();?>
    <?php echo $this->Form->create('Contracts'); ?>
        <fieldset>
            <legend><?php echo __('Contract'); ?></legend>
                <?php
                    echo $this->Form->input('name', array('label' => 'Naam'));
                    echo $this->Form->input('user_id', array('options' => $user, 'class' => 'selection', 'style' => 'width: 50%', 'label' => 'Gebruiker'));
                    echo $this->Form->input('company_id', array('options' => $company, 'class' => 'selection', 'style' => 'width: 50%', 'label' => 'Bedrijf'));
                ?>
        </fieldset>
    <?php echo $this->Form->end('Opslaan', array('class' => 'rad-button dark gradient')); ?>
</div>