<div class="index">
    <?php echo $this->Form->create('Company'); ?>
    <legend><?php echo __('Voeg bedrijf toe'); ?></legend>
    <fieldset>
        <?php
            echo $this->Form->input('name', array('label' => 'Bedrijfsnaam'));
            echo $this->Form->input('postalcode', array('label' => 'Postcode'));
            echo $this->Form->input('street', array('label' => 'Straat'));
            echo $this->Form->input('city', array('label' => 'Plaats'));
            echo $this->Form->input('housenumber', array('label' => 'Huisnummer'));
            echo $this->Form->input('housenumber_suffix', array('label' => 'Huisnummer toevoeging'));
        ?>
    </fieldset>
    <?php echo $this->Form->end('Opslaan'); ?>
</div>