<div class="User form">
    <div class="wrapper">
        <?php echo $this->Form->create('User');?>
                <fieldset>
                    <legend><?php echo __('Gebruiker'); ?></legend>
                    <div>
                        <?php echo $this->Form->input('username', array('label' => 'Gebruikersnaam', 'class' => 'formText')); ?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('UserInfo.Cities.cityname', array('label' => 'Stad', 'class' => 'formText')); ?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('UserInfo.Birthplaces.birthplace', array('label' => 'Geboorteplaats', 'class' => 'formText')); ?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('UserInfo.Countries.country', array('label' => 'Land', 'class' => 'formText')); ?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('User.role_id', array('label' => 'Rol', 'options' => $values['Roles'], 'class' => 'formText')); ?>
                    </div>
                </fieldset>
        <?php echo $this->Form->end(array('label' => 'Opslaan', array('class' => 'rad-button dark gradient'))); ?>
    </div>
</div>

