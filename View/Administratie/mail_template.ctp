<div class="index">
    <div class="wrapper">
        <?php echo $this->Form->create('Administratie'); ?>
        <legend><?php echo __('Voer nieuwe tekst in voor de notificatie mail.'); ?></legend><br><br>
        <fieldset>
            <h5>Beste (naam),</h5>
            <?php echo $this->Form->input('text', array('label' => ' ', 'type' => 'textarea', 'required', 'value' => $tekst, 'class' => 'formText')); ?>
        </fieldset>
        <h5>Mvg, HR</h5><br>
        <h5>Qien</h5><br><br>
        <?php echo $this->Form->end(array('label' => 'Opslaan', array('class' => 'rad-button dark gradient'))); ?>
    </div>
</div>

