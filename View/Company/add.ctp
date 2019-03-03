<div class="index">
    <?php echo $this->Form->create('Company'); ?>
    <legend><?php echo __('Voeg bedrijf toe'); ?></legend>
    <fieldset>
        <?php
            echo $this->Form->input('name', array('label' => 'Bedrijfsnaam'));
        ?>
    </fieldset>
    <?php echo $this->Form->end('Opslaan', array('class' => 'rad-button dark gradient')); ?>
</div>