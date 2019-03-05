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
    </dl>
</div>
<div class="User view">
    <h3><?php echo __('Gerelateerde Opdrachten'); ?></h3>
    <?php if (!empty($user['Contracts'])):?>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th><?php echo __('Opdracht'); ?></th>
                    <th><?php echo __('Aangemaakt op'); ?></th>
                    <th><?php echo __('Gewijzigd op'); ?></th>
                </tr>
            </thead>
            <?php foreach ($user['Contracts'] as $contract): ?>
                <tbody>
                    <tr>
                        <td><?php echo $contract['name']; ?></td>
                        <td><?php echo $contract['created']; ?></td>
                        <td><?php echo $contract['modified']; ?></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
        <br><br>
    <?php endif; ?>
</div>

