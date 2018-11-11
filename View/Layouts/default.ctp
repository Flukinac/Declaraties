<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
$title = __d('cake_dev', 'Uren declaratie');

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->script('jQuery 3.3.1'); ?>
        <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js') ?>
        <?php echo $this->Html->charset(); ?>

        <title>
            Uren declaratie
            <?php //echo $cakeDescription ?>
            <?php //echo $this->fetch('title'); ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('cake.generic');
        echo $this->Html->css('cake.custom');
        echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css');

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.selection').select2({
                    width: 'resolve'
                });
            });
        </script>
    </head>
<body>
<div id="container">
    <div id="header">
        <h1><?php echo $title; ?></h1>
        <div>
            <?php if (AuthComponent::user('user_id')) {
                echo $this->Html->link('Logout', array('controller' => 'User', 'action' => 'logout'));
            }
            ?>
        </div>
    </div>
    <div id="content">

        <?php echo $this->Flash->render(); ?>

        <?php echo $this->fetch('content'); ?>

        <?php if (AuthComponent::user('user_id')) : ?>
            <div class="actions">
                <h3><?php echo __('Menu'); ?></h3>
                <ul>
                    <li><?php if ($this->request->here !== '/cakeUren/User/add') {
                            echo $this->Html->link(__('Nieuwe gebruiker'), array('controller' => 'User', 'action' => 'add'));
                        } ?>
                    </li>
                    <li><?php echo $this->Html->link(__('Nieuwe boeking'), array('controller' => 'UserMonthbookings', 'action' => 'add')); ?></li>

                    <li><?php if ($this->request->here !== '/cakeUren/Roles/add') {
                        echo $this->Html->link(__('Nieuwe rol'), array('controller' => 'Roles', 'action' => 'add'));
                        } ?>
                    </li>

                    <li><?php echo $this->Html->link(__('Nieuw contract'), array('controller' => 'Contracts', 'action' => 'add')); ?></li>
                    <li><?php if ($this->request->here !== '/cakeUren/Company/add') {
                            echo $this->Html->link(__('Nieuw bedrijf'), array('controller' => 'Company', 'action' => 'add'));
                        } ?>
                    </li>
                    <li>
                        <hr>
                    </li>
                    <li><?php if ($this->request->here !== '/cakeUren/User') {
                            echo $this->Html->link(__('Alle gebruikers'), array('controller' => 'User', 'action' => 'index'));
                        } ?>
                    </li>
                    <li><?php if ($this->request->here !== '/cakeUren/Roles') {
                            echo $this->Html->link(__('Alle rollen'), array('controller' => 'Roles', 'action' => 'index'));
                        } ?>
                    </li>
                    <li><?php echo $this->Html->link(__('Alle boekingen'), array('controller' => 'Monthbookings', 'action' => 'index')); ?></li>
                    <li><?php if ($this->request->here !== '/cakeUren/contracts') {
                        echo $this->Html->link(__('Alle contracten'), array('controller' => 'Contracts', 'action' => 'index'));
                        } ?>
                    </li>
                    <li><?php echo $this->Html->link(__('Alle bedrijven'), array('controller' => 'Company', 'action' => 'index')); ?></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <div id="footer">
        <?php //echo $this->Html->link(
        //					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
        //					'https://cakephp.org/',
        //					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
        //				);
        ?>
        <p>
            <?php //echo $cakeVersion; ?>
        </p>
    </div>
</div>
<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
