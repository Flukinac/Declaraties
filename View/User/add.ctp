<div class="index">
    <div class="wrapper">
        <?php echo $this->Form->create('User'); ?><br><br>
        <legend><?php echo __('Voeg gebruiker toe'); ?></legend>
        <fieldset>
            <?php
            echo $this->Form->input('username', array('label' => 'naam', 'placeholder' => 'naam', 'class' => 'formText'));
            echo $this->Form->input('email', array('label' => 'email adres', 'placeholder' => 'email adres', 'class' => 'formText'));
            echo $this->Form->input('role_id', array('label' => 'Rol', 'options' => $role, 'class' => 'formText'));
            ?>
        </fieldset>
        <?php echo $this->Form->end('Opslaan', array('class' => 'rad-button dark gradient')); ?>
    </div>
</div>

