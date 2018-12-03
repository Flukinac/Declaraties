<div class="users form">
    <?php echo $this->Flash->render('auth'); ?>
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo __('Voer een gebruikersnaam en wachtwoord in'); ?>
        </legend>
        <?php echo $this->Form->input('username', array('label' => 'gebruikersnaam'));
        echo $this->Form->input('password', array('label' => 'wachtwoord'));
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Login')); ?>
</div>