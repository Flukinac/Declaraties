<div class="User form"><?php //debug($values); exit();?>
    <?php echo $this->Form->create('Contracts'); ?>
        <fieldset>
            <legend><?php echo __('Contract'); ?></legend>
                <?php
                    echo $this->Form->input('name', array('label' => 'Naam'));
                    echo $this->Form->input('user_id', array('options' => $user, 'class' => 'selection', 'style' => 'width: 50%', 'label' => 'Gebruiker'));
                    echo $this->Form->input('company_id', array('options' => $company, 'class' => 'selection', 'style' => 'width: 50%', 'label' => 'Bedrijf'));
                    echo $this->Form->input('start_date', array('placeholder' => 'Start datum',  'label' => 'Startdatum', 'type' => 'date'));
                    echo $this->Form->input('end_date', array('placeholder' => 'Eind datum',  'label' => 'Einddatum', 'type' => 'date'));
                ?>
        </fieldset>
    <?php echo $this->Form->end('Opslaan', array('class' => 'rad-button dark gradient')); ?>
</div>