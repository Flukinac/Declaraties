<div class="index">
    <?php if (count($result) > 0):?>
    <h2><?php echo __('Boekingen');?></h2>
    <?php echo $this->Form->create('UserMonthbookings', array('url' => 'approve/')); ?>
        <table cellpadding="0" cellspacing="0">
        <thead>
        <tr><?php //@TODO pagination is nog niet werkzaam voor alle kolommen behalve de created en modified ?>
            <th><?php echo $this->Paginator->sort('username', 'Gebruiker'); ?></th>
            <th><?php echo $this->Paginator->sort('year', 'Jaar'); ?></th>
            <th><?php echo $this->Paginator->sort('month', 'Maand'); ?></th>
            <th><?php echo $this->Paginator->sort('created', 'Aangemaakt op'); ?></th>
            <th><?php echo $this->Paginator->sort('modified', 'Bewerkt op'); ?></th>
            <th><?php echo $this->Paginator->sort('hours', 'Uren'); ?></th>
            <th><?php echo $this->Paginator->sort('status', 'Status'); ?></th>
            <th><?php echo $this->Paginator->sort('active', 'Actief'); ?></th>
            <th><?php echo $this->Paginator->sort('check', 'Goedkeuren'); ?></th>
            <th class="actions"><?php echo __('Acties'); ?></th>
            <th class="actions"><?php echo __('Mailing'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        <?php foreach ($result as $row): ?>
            <?php if ($row['UserMonthbookings']['modified'] == $row['UserMonthbookings']['created']) {$row['UserMonthbookings']['modified'] = ' ';}; ?>     <!--voorkomen van weergave van overeenkomende datum created en modified-->
            <tr>
                <td><?php echo h($row['User']['username']); ?></td>
                <td><?php echo h($row['Monthbookings']['Years']['year']); ?></td>
                <td><?php echo h($row['Monthbookings']['Months']['month']); ?></td>
                <td><?php echo h($row['UserMonthbookings']['created']); ?></td>
                <td><?php echo h($row['UserMonthbookings']['modified']); ?></td>
                <td><?php echo h($totalHours[$row['UserMonthbookings']['user_monthbooking_id']]); ?></td>
                <?php $status = 'open';
                    $checked = '';
                if ($row['UserMonthbookings']['status'] == 1) {
                    $status = 'gekeurd';
                    $checked = 'true';
                };?>
                <td><?php echo h($status); ?></td>
                <?php $active = 'actief';
                if ($row['UserMonthbookings']['active'] == 0) {
                    $active = 'non actief';
                };?>
                <td><?php echo h($active); ?></td>
                <td><div style="align-content: center;"><?php echo $this->Form->checkbox($row['UserMonthbookings']['user_monthbooking_id'], array('checked' => $checked, 'label' => '', 'style' => 'width: 30px; height: 20px;'), 'checked'); ?></div></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Inkijken'), array('action' => 'view', $row['UserMonthbookings']['user_monthbooking_id']), array('class' => 'rad-button dark gradient')); ?>
                    <?php echo $this->Html->link(__('Aanpassen'), array('action' => 'addHours', $row['UserMonthbookings']['user_monthbooking_id']), array('class' => 'rad-button dark gradient'));?>
                </td>
                <td class="actions">
                <?php if ($row['UserMonthbookings']['active'] == 1 && $row['UserMonthbookings']['status'] == 0) : ?>
                        <button type="button" id=<?php echo 'sendNotifcationMail' . $i++;?> style="width: 140px; height: 30px;" value=<?php echo $row['UserMonthbookings']['user_id']; ?> class="rad-button dark gradient">Stuur mail</button>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
        <?php echo $this->Form->end('Opslaan'); ?>
        <p>
        <?php
//        echo $this->Paginator->counter(array(
//            'format' => __('Pagina {:page} van {:pages}, toont {:current} boeking(en) van het {:count} totaal, beginnend bij {:start}, eindigend bij {:end}')
//        ));
        ?>	</p>
    <div class="paging">
        <?php
//        echo $this->Paginator->prev('< ' . __('vorige'), array('class' => 'page'), null);
//        echo $this->Paginator->numbers(array('separator' => '', 'class' => 'page'));
//        echo $this->Paginator->next(__('volgende') . ' >', array('class' => 'page'), null);
        ?>
    </div>
    <?php else: ?>
        <h2><?php echo __('Geen boekingen gevonden'); ?></h2>
    <?php endif; ?>
</div>