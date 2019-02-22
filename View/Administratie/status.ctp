<div class="index">
    <?php if (count($result) > 0):?>
        <h2><?php echo __('Boekingen');?></h2>
        <?php echo $this->Form->create('Administratie'); ?>
        <table cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('username', 'Gebruiker'); ?></th>
                <th><?php echo $this->Paginator->sort('year', 'Jaar'); ?></th>
                <th><?php echo $this->Paginator->sort('month', 'Maand'); ?></th>
                <th><?php echo $this->Paginator->sort('hours', 'Uren'); ?></th>
                <th><?php echo $this->Paginator->sort('intern', 'Uren buiten opdracht'); ?></th>
                <th><?php echo $this->Paginator->sort('check', 'Goedkeuren'); ?></th>
                <th><?php echo $this->Paginator->sort('approver', 'Laatst gekeurd door'); ?></th>
                <th class="actions"><?php echo __('Acties'); ?></th>
                <th class="actions"><?php echo __('Mailing'); ?></th>
                <th class="actions"><?php echo __('Opmerkingen'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 0; ?>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?php echo h($row['User']['username']); ?></td>
                    <td><?php echo h($row['Monthbookings']['Years']['year']); ?></td>
                    <td><?php echo h($row['Monthbookings']['Months']['month']); ?></td>
                    <td><?php echo h($totalHours[$row['UserMonthbookings']['user_monthbooking_id']]); ?></td>
                    <td><?php echo h($interHoursCheck[$row['UserMonthbookings']['user_monthbooking_id']]); ?></td>
                    <?php $status = 'open';
                    $checked = '';
                    if ($row['UserMonthbookings']['status'] == 1) {
                        $status = 'gekeurd';
                        $checked = 'true';
                    };?>
                    <td><div style="align-content: center;"><?php echo $this->Form->checkbox('status_' . $row['UserMonthbookings']['user_monthbooking_id'], array('checked' => $checked, 'label' => '', 'style' => 'width: 30px; height: 20px;'), 'checked'); ?></div></td>
                    <td><?php echo h($approver[$row['UserMonthbookings']['user_monthbooking_id']]); ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Inkijken'), array('action' => 'view', $row['UserMonthbookings']['user_monthbooking_id']), array('class' => 'rad-button dark gradient')); ?>
                    </td>
                    <td class="actions">
                        <?php if ($row['UserMonthbookings']['active'] == 1 && $row['UserMonthbookings']['status'] == 0) : ?>
                            <button type="button" id=<?php echo 'sendNotifcationMail' . $i++;?> style="width: 140px; height: 30px;" value=<?php echo $row['UserMonthbookings']['user_id']; ?> class="rad-button dark gradient">Stuur mail</button>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo $this->Form->input('comment_' . $row['UserMonthbookings']['user_monthbooking_id'], array('label' => '', 'value' => $row['UserMonthbookings']['comment'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->Form->end('Opslaan'); ?>
    <?php else: ?>
        <h2><?php echo __('Geen boekingen gevonden'); ?></h2>
    <?php endif; ?>
</div>