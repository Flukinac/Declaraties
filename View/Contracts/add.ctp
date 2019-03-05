<div class="index">
    <?php echo $this->Form->create('Contracts'); ?>
    <legend><?php echo __('Voeg contract toe'); ?></legend>
    <fieldset>
        <?php
            echo $this->Form->input('name', array('label' => 'Naam'));
            echo $this->Form->input('user_id', array('options' => $values['user'], 'class' => 'selection', 'style' => 'width: 50%', 'label' => 'Gebruiker'));
            echo $this->Form->input('company_id', array('options' => $values['company'], 'class' => 'selection', 'style' => 'width: 50%', 'label' => 'Bedrijf'));
            echo $this->Form->input('start_date', array('placeholder' => 'Start datum',  'label' => 'Startdatum', 'type' => 'date'));
            echo $this->Form->input('end_date', array('placeholder' => 'Eind datum',  'label' => 'Einddatum', 'type' => 'date'));
        ?>
    </fieldset>
    <?php echo $this->Form->end('Opslaan', array('class' => 'rad-button dark gradient')); ?>
</div>