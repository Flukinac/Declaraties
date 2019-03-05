<div class="User form">
    <div class="wrapper">
        <?php echo $this->Form->create('User');?>
                <fieldset>
                    <legend><?php echo __('Gebruiker'); ?></legend>
                    <div>
                        <?php echo $this->Form->input('username', array('label' => 'Gebruikersnaam', 'value' => $userdata['User']['username'], 'class' => 'formText')); ?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('email', array('label' => 'email', 'value' => $userdata['User']['email'], 'class' => 'formText')); ?>
                    </div>
                    <div>
                        <?php echo $this->Form->input('role_id', array('label' => 'Rol', 'options' => $values['Roles'], 'selected' => $userdata['User']['role_id'], 'class' => 'formText')); ?>
                    </div>
                    <div class="card">
                        <div class="card-header" style="background-color: cyan">
                            <h3 style="text-align: center">Selecteer de opdrachten</h3>
                            <h5>Let op: Bij het veranderen van een opdracht zullen de uren niet verdwijnen, en niet meer inzichtelijk zijn in het status scherm onder beheer.</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            echo $this->Form->input('company_id1', array('options' => $companies, 'class' => 'selection', 'style' => 'width: 50%', 'label' => 'Opdracht 1'));
                            echo $this->Form->input('company_id2', array('options' => $companiesExtra, 'selected' => '0', 'class' => 'selection', 'style' => 'width: 50%', 'label' => 'Opdracht 2'));
                            echo $this->Form->input('company_id3', array('options' => $companiesExtra, 'selected' => '0', 'class' => 'selection', 'style' => 'width: 50%', 'label' => 'Opdracht 3'));
                            ?>
                        </div>
                    </div>
                </fieldset>
        <?php echo $this->Form->end(array('label' => 'Opslaan', array('class' => 'rad-button dark gradient'))); ?>
    </div>
</div>
