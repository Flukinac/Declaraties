<div class="index">
    <h2><?php echo __('Bedrijven'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Naam'); ?></th>
            <th><?php echo $this->Paginator->sort('Aangemaakt op'); ?></th>
            <th><?php echo $this->Paginator->sort('Gewijzigd op'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($companies as $company): ?>
            <tr>
                <?php if ($company['Company']['modified'] == $company['Company']['created']) {$company['Company']['modified'] = ' ';}; ?>     <!--voorkomen van weergave van overeenkomende datum created en modified-->
                <td><?php echo h($company['Company']['name']); ?></td>
                <td><?php echo h($company['Company']['created']); ?></td>
                <td><?php echo h($company['Company']['modified']); ?></td>

                <td class="actions">
                    <?php echo $this->Html->link(__('Bewerken'), array('action' => 'edit', $company['Company']['company_id']), array('class' => 'rad-button dark gradient')); ?>
                    <?php echo $this->Form->postLink('Uitschrijven', array('action' => 'delete', $company['Company']['company_id']), array('confirm' => 'Bevestig verwijderen','class' => 'rad-button dark gradient')); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Pagina {:page} van {:pages}, toont {:current} bedrijven van het {:count} totaal, beginnend bij {:start}, eindigend bij {:end}')
        ));
        ?>	</p>
    <div class="pagination">
        <?php
        echo $this->Paginator->prev('< ' . __('vorige'), array('class' => 'page'), null);
        echo $this->Paginator->numbers(array('separator' => '', 'class' => 'page'));
        echo $this->Paginator->next(__('volgende') . ' >', array('class' => 'page'), null);
        ?>
    </div>
</div>
