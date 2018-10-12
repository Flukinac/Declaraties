<div class="index">
    <h2><?php echo __('Gebruikers'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('username', 'Naam'); ?></th>
                <th><?php echo $this->Paginator->sort('role_id', 'Account type'); ?></th>
                <th><?php echo $this->Paginator->sort('contract_id', 'Contract'); ?></th>
                <th><?php echo $this->Paginator->sort('created', 'Aangemaakt op'); ?></th>
                <th><?php echo $this->Paginator->sort('modified', 'Gewijzigd op'); ?></th>
                <th class="actions"><?php echo __('Acties'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                    <td><?php echo h($user['Roles']['description']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($user['Contracts'][0]['name'], array('controller' => 'Contract', 'action' => 'view', $user['User']['user_id'])); ?>
                    </td>
                    <td><?php echo h($user['User']['created']); ?>&nbsp;</td>
                    <td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Tonen'), array('action' => 'view', $user['User']['user_id'])); ?>
                        <?php echo $this->Html->link(__('Aanpassen'), array('action' => 'edit', $user['User']['user_id'])); ?>
                        <?php echo $this->Form->postLink(__('Verwijderen'), array('action' => 'delete', $user['User']['user_id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['User']['user_id']))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Pagina {:page} van {:pages}, toont {:current} registraties van het {:count} totaal, beginnend bij {:start}, eindigend bij {:end}')
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
<div class="actions">
    <h3><?php echo __('Navigatie'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Nieuwe gebruiker'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuwe boeking'), array('controller' => 'products', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuw contract'), array('controller' => 'Contract', 'action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Nieuw bedrijf'), array('controller' => 'products', 'action' => 'add')); ?> </li>
        <li><hr></li>
        <li><?php echo $this->Html->link(__('Alle boekingen'), array('controller' => 'products', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Alle contracten'), array('controller' => 'Contract', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Alle bedrijven'), array('controller' => 'products', 'action' => 'index')); ?> </li>

    </ul>
</div>
