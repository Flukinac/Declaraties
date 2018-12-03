<div class="index">
    <?php echo $this->Form->create('Monthbookings', array('class' => 'form-inline')); ?>
    <legend><?php echo __('Kies boeking periode'); ?></legend>
    <fieldset>
        <table>
            <tr>
                <div class="form-group mb-2">
                    <label for="month_id" class="col-sm-2 col-form-label">Maand</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('month_id', array('options' => $values['months'], 'label' => '', 'class' => 'form-control form-control-sm')); ?>
                    </div>
                </div>
            </tr>
                <tr>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="year_id" class="col-sm-2 col-form-label">Jaar</label>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('year_id', array('options' => $values['years'], 'label' => '', 'class' => 'form-control form-control-sm')); ?>
                        </div>
                    </div>
                </tr>
            <tr>
                <?php echo $this->Form->end('Nieuwe boeking', array('class' => 'rad-button dark gradient')); ?>
            </tr>
        </table>
    </fieldset>
</div>