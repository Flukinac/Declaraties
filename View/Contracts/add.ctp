<div class="index">
    <?php echo $this->Form->create('Contracts'); ?>
    <legend><?php echo __('Voeg contract toe'); ?></legend>
    <fieldset>
        <?php
            echo $this->Form->input('name', array('label' => 'Naam'));
            echo $this->Form->input('user_id', array('options' => $values['user'], 'class' => 'selection', 'style' => 'width: 50%', 'label' => 'Gebruiker'));
            echo $this->Form->input('company_id', array('options' => $values['company'], 'class' => 'selection', 'style' => 'width: 50%', 'label' => 'Bedrijf'));
        ?>
    </fieldset>
    <?php echo $this->Form->end('Opslaan', array('class' => 'rad-button dark gradient')); ?>
</div>