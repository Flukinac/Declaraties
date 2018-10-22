<div class="User form">
    <?php echo $this->Form->create('User'); ?>
            <fieldset>
                <legend><?php echo __('Gebruiker'); ?></legend>
                <?php
                    echo $this->Form->input('username', array('label' => 'Naam'));
                    //echo $this->Form->input('password'); @TODO veranderen wachtwoord en verificatie dmv 2 velden
                    //echo $this->Form->input('password');
                    echo $this->Form->input('role_id', array('label' => 'Rol'));
                ?>
            </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>

