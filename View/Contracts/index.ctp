<?php $this->Html->script('select', array('inline' => false)); ?>

<div class="index">

    <h2><?php echo __('Contracten'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('Contractnaam'); ?></th>
                <th><?php echo $this->Paginator->sort('Bedrijfsnaam'); ?></th>
                <th><?php echo $this->Paginator->sort('Aangemaakt op'); ?></th>
                <th><?php echo $this->Paginator->sort('Gewijzigd op'); ?></th>
                <th><?php echo $this->Paginator->sort('Gebruikersnaam'); ?></th>
                <th><?php echo $this->Paginator->sort('Start datum'); ?></th>
                <th><?php echo $this->Paginator->sort('Eind datum'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($contracts as $contract): ?>
            <tr>
                <td><?php echo h($contract['Contracts']['name']); ?></td>
                <td><?php echo h($contract['Company']['name']); ?></td>
                <td><?php echo h($contract['Contracts']['created']); ?></td>
                <td><?php echo h($contract['Contracts']['modified']); ?></td>
                <td><?php echo h($contract['User']['username']); ?></td>
                <td><?php echo h($contract['Contracts']['start_date']); ?></td>
                <td><?php echo h($contract['Contracts']['end_date']); ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $contract['Contracts']['contract_id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $contract['Contracts']['contract_id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $contract['Contracts']['contract_id']), array('confirm' => __('Are you sure you want to delete # %s?', $contract['Contracts']['contract_id']))); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Pagina {:page} van {:pages}, toont {:current} contract(en) van het {:count} totaal, beginnend bij {:start}, eindigend bij {:end}')
        ));
        ?>	</p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
