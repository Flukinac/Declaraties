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
        <?php echo $this->Form->end('Opslaan', array('class' => 'rad-button dark gradient')); ?>
    </div>
</div>
