<div class="index">
    <?php echo $this->Form->create('Monthbookings'); ?>
    <legend><?php echo __('Kies boeking periode'); ?></legend>
    <fieldset><?php //debug($values['user_id']);exit();?>
        <table>
            <tr>
                <td>
                    <?php echo $this->Form->input('month_id', array('options' => $values['months'])); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('year_id', array('options' => $values['years'])); ?>
                </td>
                <td>
                    <?php echo $this->Form->end('Nieuwe boeking'); ?>
                </td>
            </tr>
        </table>
    </fieldset>
</div>