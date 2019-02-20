<div class="User form">
    <div class="wrapper">
        <?php echo $this->Form->create('User');?>
        <fieldset>
            <legend><?php echo __('Vul een nieuw wachtwoord van minimaal 5 karakters in.'); ?></legend>
            <div>
                <?php echo $this->Form->input('password', array('label' => 'Nieuw wachtwoord', 'class' => 'formText', 'type' => 'password')); ?>
            </div>
            <div>
                <?php echo $this->Form->input('passwordCheck', array('label' => 'Herhaal wachtwoord', 'class' => 'formText', 'type' => 'password')); ?>
            </div>
        </fieldset>
        <?php echo $this->Form->end(array('label' => 'Opslaan', array('class' => 'rad-button dark gradient'))); ?>
    </div>
</div>
