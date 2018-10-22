<div class="index">
    <?php echo $this->Form->create('User'); ?>
    <legend><?php echo __('Voeg gebruiker toe'); ?></legend>
    <fieldset>
        <?php
            echo $this->Form->input('username', array('placeholder' => 'naam'));
            echo $this->Form->input('password', array('placeholder' => 'wachtwoord'));
            echo $this->Form->input('role_id', array('options' => $role));
        ?>
    </fieldset>
    <?php echo $this->Form->end('Opslaan'); ?>
</div>

