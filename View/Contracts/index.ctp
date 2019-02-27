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
                <?php if ($contract['Contracts']['modified'] == $contract['Contracts']['created']) {$contract['Contracts']['modified'] = ' ';}; ?>     <!--voorkomen van weergave van overeenkomende datum created en modified-->
                <td><?php echo h($contract['Contracts']['name']); ?></td>
                <td><?php echo h($contract['Company']['name']); ?></td>
                <td><?php echo h($contract['Contracts']['created']); ?></td>
                <td><?php echo h($contract['Contracts']['modified']); ?></td>
                <td><?php echo h($contract['User']['username']); ?></td>
                <td><?php echo h($contract['Contracts']['start_date']); ?></td>
                <td><?php echo h($contract['Contracts']['end_date']); ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('Openen'), array('action' => 'edit', $contract['Contracts']['contract_id']), array('class' => 'rad-button dark gradient')); ?>
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
        echo $this->Paginator->prev('< ' . __('vorige'), array('class' => 'page'), null);
        echo $this->Paginator->numbers(array('separator' => '', 'class' => 'page'));
        echo $this->Paginator->next(__('volgende') . ' >', array('class' => 'page'), null);
        ?>
    </div>
</div>
