
<table>
    <tr>
        <th>Naam</th>
        <th>Aangemaakt op</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['User']['username']; ?></td>
            <td><?php echo $user['User']['created']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 8-10-2018
 * Time: 11:48
 */

<div class="index">
    <h2><?php echo __('Gebruikers'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('username'); ?></th>
            <th><?php echo $this->Paginator->sort('role_id'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo h($user['user']['id']); ?>&nbsp;</td>
                <td><?php echo h($user['user']['username']); ?>&nbsp;</td>
                <td><?php echo h($user['user']['role_id']); ?>&nbsp;</td>
<!--                <td> bijvoorbeeld contracten van user of boekingen van user
                    <?php //echo $this->Html->link($user['user']['id'], array('controller' => 'users', 'action' => 'view', $user['user']['id'])); ?>
                </td>-->
                <td><?php echo h($user['user']['created']); ?>&nbsp;</td>
                <td><?php echo h($user['user']['modified']); ?>&nbsp;</td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['user']['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['user']['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['user']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user['user']['id']))); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
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
<div class="actions">
    <h3><?php echo __('Navigatie'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Nieuwe gebruiker'), array('controller' => 'users', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Alle contracten'), array('controller' => 'Contract', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuw contract'), array('controller' => 'Contract', 'action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Alle boekingen'), array('controller' => 'products', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuwe boeking'), array('controller' => 'products', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Alle bedrijven'), array('controller' => 'products', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuw bedrijf'), array('controller' => 'products', 'action' => 'add')); ?> </li>
    </ul>
</div>
