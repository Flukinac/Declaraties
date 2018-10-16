<div class="User form">
    <?php echo $this->Form->create('User'); ?>
            <fieldset>
                <legend><?php echo __('Edit User'); ?></legend>
                <?php
                    echo $this->Form->input('username', array('value' => $user['User']['username']));
                    echo $this->Form->input('password', array('value' => $user['User']['password']));
                    echo $this->Form->input('role_id', array('options' => $roles, 'selected' => $user['Roles']['role_id']));
                ?>
            </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>

