<div class="index">
    <?php echo $this->Form->create(array('class' => 'form-inline', 'url' => 'search/')); ?>
    <legend><?php echo __('Zoekopdracht'); ?></legend>
    <fieldset>
        <table>
            <tr>
                <div class="form-group mb-2">
                    <label for="month_id" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('status', array('options' => $values['status'], 'label' => '', 'class' => 'form-control form-control-sm')); ?>
                    </div>
                </div>
            </tr>
            <tr>
                <div class="form-group mb-2">
                    <label for="month_id" class="col-sm-2 col-form-label">Actief</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('active', array('options' => $values['active'], 'label' => '', 'selected' => 1, 'class' => 'form-control form-control-sm')); ?>
                    </div>
                </div>
            </tr>
            <tr>
                <div class="form-group mb-2">
                    <label for="month_id" class="col-sm-2 col-form-label">Jaar</label>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('year_id', array('options' => $values['years'], 'label' => '', 'class' => 'form-control form-control-sm')); ?>
                    </div>
                </div>
            </tr>
            <tr>
                <div class="form-group mb-2">
                    <label for="month_id" class="col-sm-2 col-form-label">Periode</label>
                    <div class="col-sm-10">
                        <table>
                            <tr>
                                <td>
                                    Vanaf:
                                </td>
                                <td>
                                    <?php echo $this->Form->input('month_id_from', array('options' => $values['months'], 'label' => '', 'selected' => date('m', time()), 'class' => 'form-control form-control-sm')); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Tot:
                                </td>
                                <td>
                                    <?php echo $this->Form->input('month_id_to', array('options' => $values['months'], 'label' => '','selected' => date('m', time()), 'class' => 'form-control form-control-sm')); ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </tr>
            <tr>
                <?php echo $this->Form->end('Zoek', array('class' => 'rad-button dark gradient')); ?>
            </tr>
        </table>
    </fieldset>
</div>