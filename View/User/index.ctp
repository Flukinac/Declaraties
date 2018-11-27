<div class="index">
    <h2><?php echo __('Alle gebruikers'); ?></h2>
    <table cellpadding="0" cellspacing="0" class="table">
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
                    <td><?php echo h($user['User']['username']); ?></td>
                    <td><?php echo h($user['Roles']['description']); ?></td>
                    <td>
                        <?php foreach ($user['Contracts'] as $contract) {
                            echo $this->Html->link($contract['name'], array('controller' => 'Contract', 'action' => 'view', $contract['contract_id']));
                            echo '<br>';
                        } ?>
                    </td>
                    <td><?php echo h($user['User']['created']); ?></td>
                    <td><?php echo h($user['User']['modified']); ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Tonen'), array('action' => 'view', $user['User']['user_id'])); ?>
                        <?php echo $this->Html->link(__('Aanpassen'), array('action' => 'edit', $user['User']['user_id'])); ?>
                        <?php echo $this->Form->postLink(__('Verwijderen'), array('action' => 'delete', $user['User']['user_id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['username']))); ?>
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
            echo $this->Paginator->prev('< ' . __('volgende'), array(), null, array('class' => 'prev disabled'));
            echo $this->Paginator->numbers(array('separator' => ''));
            echo $this->Paginator->next(__('volgende') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>