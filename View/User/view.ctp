<div class="users view">
    <h2><?php echo __('Gebruiker'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd><?php echo h($user['user']['user_id']); ?></dd>
        <dt><?php echo __('Naam'); ?></dt>
        <dd><?php echo h($user['user']['username']); ?></dd>
        <dt><?php echo __('Rol'); ?></dt>
        <dd><?php echo h($user['user']['role_id']); ?></dd>
        <dt><?php echo __('Aangemaakt op'); ?></dt>
        <dd><?php echo h($user['user']['created']); ?></dd>
        <dt><?php echo __('Gewijzigd op'); ?></dt>
        <dd><?php echo h($user['user']['modified']); ?></dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Alle gebruikers'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuwe gebruiker'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Alle contracten'), array('controller' => 'Contract', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuw contract'), array('controller' => 'Contract', 'action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('Alle boekingen'), array('controller' => 'products', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuwe boeking'), array('controller' => 'products', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('Alle bedrijven'), array('controller' => 'products', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('Nieuw bedrijf'), array('controller' => 'products', 'action' => 'add')); ?> </li>
    </ul>
</div>
<div class="related">
    <h3><?php echo __('Gerelateerde Contracten'); ?></h3>
    <?php if (!empty($user['Contracts'])): ?>
        <dl>
            <dt><?php echo __('Id'); ?></dt>
            <dd><?php echo $user['Contracts']['contract_id']; ?></dd>
            <dt><?php echo __('Naam'); ?></dt>
            <dd><?php echo $user['Contracts']['name']; ?></dd>
            <dt><?php echo __('Start datum'); ?></dt>
            <dd><?php echo $user['Contracts']['start_date']; ?></dd>
            <dt><?php echo __('Eind datum'); ?></dt>
            <dd><?php echo $user['Contracts']['end_date']; ?></dd>
            <dt><?php echo __('Aangemaakt op'); ?></dt>
            <dd><?php echo $user['Contracts']['created']; ?></dd>
            <dt><?php echo __('Gewijzigd op'); ?></dt>
            <dd><?php echo $user['Contracts']['modified']; ?></dd>
        </dl>
    <?php endif; ?>
    <div class="actions">
        <ul>
            <li><?php //echo $this->Html->link(__('Edit User Address'), array('controller' => 'user_addresses', 'action' => 'edit', $user['UserAddress']['id'])); ?></li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php echo __('Gerelateerde boekingen'); ?></h3>
    <?php if (!empty($user['User_monthbookings'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Id'); ?></th>
                <th><?php echo __('Aangemaakt op'); ?></th>
                <th><?php echo __('Gewijzigd op'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($user['User_monthbookings'] as $user_booking): ?>
                <tr>
                    <td><?php echo $user_booking['id']; ?></td>
                    <td><?php echo $user_booking['created']; ?></td>
                    <td><?php echo $user_booking['modified']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'UserMonthbookings', 'action' => 'view', $user_booking['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('controller' => 'UserMonthbookings', 'action' => 'edit', $user_booking['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'UserMonthbookings', 'action' => 'delete', $user_booking['id']), array('confirm' => __('Are you sure you want to delete # %s?', $user_booking['id']))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
