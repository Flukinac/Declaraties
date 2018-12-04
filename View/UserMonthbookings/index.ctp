<div class="index">
    <h2><?php echo __('Boekingen'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>        <?php //@TODO pagination is nog niet werkzaam voor alle kolommen behalve de created en modified ?>
            <th><?php echo $this->Paginator->sort('year', 'Jaar'); ?></th>
            <th><?php echo $this->Paginator->sort('month', 'Maand'); ?></th>
            <th><?php echo $this->Paginator->sort('created', 'Aangemaakt op'); ?></th>
            <th><?php echo $this->Paginator->sort('modified', 'Bewerkt op'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($UserMonthbookings as $UserMonthbooking): ?>
            <?php if ($UserMonthbooking['UserMonthbookings']['modified'] == $UserMonthbooking['UserMonthbookings']['created']) {$UserMonthbooking['UserMonthbookings']['modified'] = ' ';}; ?>     <!--voorkomen van weergave van overeenkomende datum created en modified-->
            <tr>
                <td><?php echo h($UserMonthbooking['Monthbookings']['Years']['year']); ?></td>
                <td><?php echo h($UserMonthbooking['Monthbookings']['Months']['month']); ?></td>
                <td><?php echo h($UserMonthbooking['UserMonthbookings']['created']); ?></td>
                <td><?php echo h($UserMonthbooking['UserMonthbookings']['modified']); ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $UserMonthbooking['UserMonthbookings']['user_monthbooking_id']), array('class' => 'rad-button dark gradient')); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'addHours', $UserMonthbooking['UserMonthbookings']['user_monthbooking_id']), array('class' => 'rad-button dark gradient')); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Pagina {:page} van {:pages}, toont {:current} boeking(en) van het {:count} totaal, beginnend bij {:start}, eindigend bij {:end}')
        ));
        ?>	</p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('vorige'), array('class' => 'page'), null);
        echo $this->Paginator->numbers(array('separator' => '', 'class' => 'page'));
        echo $this->Paginator->next(__('volgende') . ' >', array('class' => 'page'), null);
        ?>
    </div>
</div>