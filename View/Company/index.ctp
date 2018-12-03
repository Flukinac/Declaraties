<div class="index">
    <h2><?php echo __('Bedrijven'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Naam'); ?></th>
            <th><?php echo $this->Paginator->sort('Postcode'); ?></th>
            <th><?php echo $this->Paginator->sort('Aangemaakt op'); ?></th>
            <th><?php echo $this->Paginator->sort('Gewijzigd op'); ?></th>
            <th><?php echo $this->Paginator->sort('Huisnummer'); ?></th>
            <th><?php echo $this->Paginator->sort('Toevoeging'); ?></th>
            <th><?php echo $this->Paginator->sort('Straat'); ?></th>
            <th><?php echo $this->Paginator->sort('Stad'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($companies as $company): ?>
            <tr>
                <?php if ($company['Company']['modified'] == $company['Company']['created']) {$company['Company']['modified'] = ' ';}; ?>     <!--voorkomen van weergave van overeenkomende datum created en modified-->
                <td><?php echo h($company['Company']['company_id']); ?></td>
                <td><?php echo h($company['Company']['name']); ?></td>
                <td><?php echo h($company['Company']['postalcode']); ?></td>
                <td><?php echo h($company['Company']['created']); ?></td>
                <td><?php echo h($company['Company']['modified']); ?></td>
                <td><?php echo h($company['Company']['housenumber']); ?></td>
                <td><?php echo h($company['Company']['housenumber_suffix']); ?></td>
                <td><?php echo h($company['Company']['street']); ?></td>
                <td><?php echo h($company['Company']['city']); ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $company['Company']['company_id']), array('class' => 'rad-button dark gradient')); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $company['Company']['company_id']), array('class' => 'rad-button dark gradient')); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $company['Company']['company_id']), array('class' => 'rad-button dark gradient'), array('confirm' => __('Are you sure you want to delete # %s?', $company['Company']['company_id']))); ?>
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
