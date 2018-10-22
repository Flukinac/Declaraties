<div class="User form">
    <?php echo $this->Form->create('Roles'); ?>
    <fieldset>
        <legend><?php echo __('Rol'); ?></legend>
        <?php echo $this->Form->input('description', array('label' => 'Omschrijving')); ?>
    </fieldset>
    <?php echo $this->Form->end(__('Opslaan')); ?>
</div>

