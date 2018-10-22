<div class="User form">
    <?php echo $this->Form->create('Company'); ?>
    <fieldset>
        <legend><?php echo __('Bedrijf '); ?></legend>
        <?php
        echo $this->Form->input('name', array('label' => 'Naam'));
        echo $this->Form->input('postalcode', array('label' => 'Postcode'));
        echo $this->Form->input('housenumber', array('label' => 'Huisnummer'));
        echo $this->Form->input('housenumber_suffix', array('label' => 'Huisnummer toevoeging'));
        echo $this->Form->input('street', array('label' => 'Straat'));
        echo $this->Form->input('city', array('label' => 'Stad'));
        echo $this->Form->end('Save Company');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>


