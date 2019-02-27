<div class="User view">
    <h2><?php echo __('Gebruiker');?></h2>
    <dl>
        <dt><?php echo __('Naam'); ?></dt>
        <dd><?php echo h($user['User']['username']); ?></dd>
        <dt><?php echo __('Rol'); ?></dt>
        <dd><?php echo h($user['Roles']['description']); ?></dd>
        <dt><?php echo __('Aangemaakt op'); ?></dt>
        <dd><?php echo h($user['User']['created']); ?></dd>
        <dt><?php echo __('Gewijzigd op'); ?></dt>
        <dd><?php echo h($user['User']['modified']); ?></dd>
        <dt><?php echo __('Woonplaats'); ?></dt>
        <dd><?php if (!empty($user['UserInfo']['Cities']['cityname'])) {
                echo h($user['UserInfo']['Cities']['cityname']);
            } else {
                echo h( 'Niet ingevoerd');
            } ?></dd>
        <dt><?php echo __('Geboorteplaats'); ?></dt>
        <dd><?php if (!empty($user['UserInfo']['Birthplaces']['birthplace'])) {
                echo h($user['UserInfo']['Birthplaces']['birthplace']);
            } else {
            echo h( 'Niet ingevoerd');
            } ?></dd>
        <dt><?php echo __('Nationaliteit'); ?></dt>
        <dd><?php if (!empty($user['UserInfo']['Countries']['country'])) {
            echo h($user['UserInfo']['Countries']['country']);
            } else {
                echo h( 'Niet ingevoerd');
            } ?></dd>
    </dl>
</div>
<div class="User view">
    <h3><?php echo __('Gerelateerde Contracten'); ?></h3>
    <?php if (!empty($user['Contracts'])):?>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th><?php echo __('Naam'); ?></th>
                    <th><?php echo __('Start datum'); ?></th>
                    <th><?php echo __('Eind datum'); ?></th>
                    <th><?php echo __('Aangemaakt op'); ?></th>
                    <th><?php echo __('Gewijzigd op'); ?></th>
                    <th class="actions"><?php echo __('Acties'); ?></th>
                </tr>
            </thead>
            <?php foreach ($user['Contracts'] as $contract): ?>
                <tbody>
                    <tr>
                        <td><?php echo $contract['name']; ?></td>
                        <td><?php echo $contract['start_date']; ?></td>
                        <td><?php echo $contract['end_date']; ?></td>
                        <td><?php echo $contract['created']; ?></td>
                        <td><?php echo $contract['modified']; ?></td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('controller' => 'Contracts', 'action' => 'view', $contract['contract_id']), array('class' => 'rad-button dark gradient')); ?>
                            <?php echo $this->Html->link(__('Edit'), array('controller' => 'Contracts', 'action' => 'edit', $contract['contract_id']), array('class' => 'rad-button dark gradient')); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'Contracts', 'action' => 'delete', $contract['contract_id']), array('confirm' => __('Are you sure you want to delete # %s?', $contract['contract_id']), 'class' => 'rad-button dark gradient')); ?>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
        <br><br>
    <?php endif; ?>
</div>
<div class="User view">
    <h3><?php echo __('Gerelateerde boekingen'); ?></h3>
    <?php if (!empty($user['UserMonthbookings'])): ?>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th><?php echo __('Aangemaakt op'); ?></th>
                    <th><?php echo __('Gewijzigd op'); ?></th>
                    <th class="actions"><?php echo __('Acties'); ?></th>
                </tr>
            </thead>
            <?php foreach ($user['UserMonthbookings'] as $user_booking): ?>
                <tbody>
                    <tr>
                        <td><?php echo $user_booking['created']; ?></td>
                        <td><?php echo ($user_booking['created'] == $user_booking['modified'] ? '' : $user_booking['modified']); ?></td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('controller' => 'UserMonthbookings', 'action' => 'view', $user_booking['user_monthbooking_id']), array('class' => 'rad-button dark gradient')); ?>
                            <?php echo $this->Html->link(__('Edit'), array('controller' => 'UserMonthbookings', 'action' => 'addHours', $user_booking['user_monthbooking_id']), array('class' => 'rad-button dark gradient')); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'UserMonthbookings', 'action' => 'delete', $user_booking['user_monthbooking_id']), array('confirm' => __('Are you sure you want to delete # %s?', $user_booking['user_monthbooking_id']), 'class' => 'rad-button dark gradient')); ?>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
