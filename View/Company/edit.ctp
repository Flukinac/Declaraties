<div class="User form">
    <?php echo $this->Form->create('Company'); ?>
    <fieldset>
        <legend><?php echo __('Bedrijf '); ?></legend>
        <?php echo $this->Form->input('name', array('label' => 'Naam')); ?>
    </fieldset>
    <?php echo $this->Form->end(array('label' => 'Opslaan', array('class' => 'rad-button dark gradient'))); ?>
</div>


