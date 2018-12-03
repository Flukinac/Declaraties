<div class="index">
    <h2><?php echo __('Alle rollen'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr><?php //debug($roles); exit(); ?>
                <th><?php echo $this->Paginator->sort('description', 'Rol naam'); ?></th>
                <th><?php echo $this->Paginator->sort('created', 'Aangemaakt op'); ?></th>
                <th><?php echo $this->Paginator->sort('modified', 'Gewijzigd op'); ?></th>
                <th class="actions"><?php echo __('Acties'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role): ?>
                <tr>
                    <?php if ($role['Roles']['modified'] == $role['Roles']['created']) {$role['Roles']['modified'] = ' ';}; ?>     <!--voorkomen van weergave van overeenkomende datum created en modified-->
                    <td><?php echo h($role['Roles']['description']); ?></td>
                    <td><?php echo h($role['Roles']['created']); ?></td>
                    <td><?php echo h($role['Roles']['modified']); ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Aanpassen'), array('action' => 'edit', $role['Roles']['role_id']), array('class' => 'rad-button dark gradient')); ?>
                        <?php echo $this->Form->postLink(__('Verwijderen'), array('action' => 'delete', $role['Roles']['role_id']), array('class' => 'rad-button dark gradient'), array('confirm' => __('Are you sure you want to delete # %s?', $role['Roles']['role_id']))); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Pagina {:page} van {:pages}, toont {:current} rollen van het {:count} totaal, beginnend bij {:start}, eindigend bij {:end}')
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