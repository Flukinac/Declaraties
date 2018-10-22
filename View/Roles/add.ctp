<div class="index">
    <?php echo $this->Form->create('Roles'); ?>
    <legend><?php echo __('Voeg rol toe'); ?></legend>
    <fieldset>
        <?php echo $this->Form->input('description', array('label' => 'Omschrijving')); ?>
    </fieldset>
    <?php echo $this->Form->end('Opslaan'); ?>
</div>

