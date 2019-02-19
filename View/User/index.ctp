<div class="index">
    <h2><?php echo __('Alle gebruikers'); ?></h2>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th><?php echo $this->Paginator->sort('username', 'Naam'); ?></th>
                <th><?php echo $this->Paginator->sort('role_id', 'Account type'); ?></th>
                <th><?php echo $this->Paginator->sort('contract_id', 'Contracten'); ?></th>
                <th><?php echo $this->Paginator->sort('created', 'Aangemaakt op'); ?></th>
                <th><?php echo $this->Paginator->sort('modified', 'Gewijzigd op'); ?></th>
                <th class="actions"><?php echo __('Acties'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <?php if ($user['User']['modified'] == $user['User']['created']) {$user['User']['modified'] = ' ';}; ?>     <!--voorkomen van weergave van overeenkomende datum created en modified-->
                    <td><?php echo h($user['User']['username']); ?></td>
                    <td><?php echo h($user['Roles']['description']); ?></td>
                    <td>
                        <?php foreach ($user['Contracts'] as $contract) {
                            echo $this->Html->link($contract['name'], array('controller' => 'Contracts', 'action' => 'view', $contract['contract_id']));
                            echo '<br>';
                        } ?>
                    </td>
                    <td><?php echo h($user['User']['created']); ?></td>
                    <td><?php echo h($user['User']['modified']); ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Tonen'), array('action' => 'view', $user['User']['user_id']), array('class' => 'rad-button dark gradient')); ?>
                        <?php echo $this->Html->link(__('Aanpassen'), array('action' => 'edit', $user['User']['user_id']), array('class' => 'rad-button dark gradient')); ?>
                        <?php echo $this->Form->postLink('Uitschrijven', array('action' => 'delete', $user['User']['user_id']), array('confirm' => 'Bevestig verwijderen','class' => 'rad-button dark gradient')); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Pagina {:page} van {:pages}, toont {:current} registratie(s) van het {:count} totaal, beginnend bij {:start}, eindigend bij {:end}')
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