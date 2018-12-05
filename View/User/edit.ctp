<div class="User form">
    <div class="wrapper">
        <?php echo $this->Form->create('User'); ?>
                <fieldset>
                    <legend><?php echo __('Gebruiker'); ?></legend>
                    <div>
                        <?php echo $this->Form->input('username', array('label' => 'Gebruikersnaam', 'placeholder' => 'Uw naam hier.', 'class' => 'formText')); ?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('password', array('label' => 'Wachtwoord', 'value' => '', 'placeholder' => 'Uw wachtwoord hier.', 'class' => 'formText')); ?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('passwordCheck', array('label' => 'Herhaal wachtwoord', 'value' => '', 'type' => 'password', 'placeholder' => 'Herhaal wachtwoord hier.', 'class' => 'formText')); ?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('city', array('label' => 'Stad', 'value' => '', 'placeholder' => 'Uw wachtwoord hier.', 'class' => 'formText')); ?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('birthplace', array('label' => 'Geboorteplaats', 'value' => '', 'type' => 'password', 'placeholder' => 'Herhaal wachtwoord hier.', 'class' => 'formText')); ?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('countries', array('label' => 'Land')); ?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('role_id', array('label' => 'Rol')); ?>
                    </div>
                </fieldset>
        <?php echo $this->Form->end(array('class' => 'submit', 'label' => 'Opslaan')); ?>
    </div>
</div>

