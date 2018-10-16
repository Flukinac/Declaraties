<div class="User view">
    <h2><?php echo __('Gebruiker'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd><?php echo h($user['User']['user_id']); ?></dd>
        <dt><?php echo __('Naam'); ?></dt>
        <dd><?php echo h($user['User']['username']); ?></dd>
        <dt><?php echo __('Rol'); ?></dt>
        <dd><?php echo h($user['User']['role_id']); ?></dd>
        <dt><?php echo __('Aangemaakt op'); ?></dt>
        <dd><?php echo h($user['User']['created']); ?></dd>
        <dt><?php echo __('Gewijzigd op'); ?></dt>
        <dd><?php echo h($user['User']['modified']); ?></dd>
    </dl>
</div>
<div class="related">
    <h3><?php echo __('Gerelateerde Contracten'); ?></h3>
    <?php if (!empty($user['Contracts'])):
        foreach ($user['Contracts'] as $contract) : ?>
        <br><br>
        <dl>
            <dt><?php echo __('Id'); ?></dt>
            <dd><?php echo $contract['contract_id']; ?></dd>
            <dt><?php echo __('Naam'); ?></dt>
            <dd><?php echo $contract['name']; ?></dd>
            <dt><?php echo __('Start datum'); ?></dt>
            <dd><?php echo $contract['start_date']; ?></dd>
            <dt><?php echo __('Eind datum'); ?></dt>
            <dd><?php echo $contract['end_date']; ?></dd>
            <dt><?php echo __('Aangemaakt op'); ?></dt>
            <dd><?php echo $contract['created']; ?></dd>
            <dt><?php echo __('Gewijzigd op'); ?></dt>
            <dd><?php echo $contract['modified']; ?></dd>
        </dl>
    <?php endforeach;
        endif;
    ?>
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
