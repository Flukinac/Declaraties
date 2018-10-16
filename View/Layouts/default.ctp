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
	<?php echo $this->Html->charset(); ?>
	<title>
        Uren declaratie
		<?php //echo $cakeDescription ?>
		<?php //echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $title; ?></h1>
            <div>
                <?php if ($this->request->here !== '/cakeUren/user/login') {
                            echo $this->Html->link('Logout', array('controller' => 'User', 'action' => 'logout'));
                        }
                ?>
            </div>
		</div>
		<div id="content">

			<?php echo $this->Flash->render(); ?>

			<?php echo $this->fetch('content'); ?>
            <?php if ($this->request->here !== '/cakeUren/User/login') : ?>
            <div class="actions">
                <h3><?php echo __('Actions'); ?></h3>
                <ul>
                    <li><?php if ($this->request->here !== '/cakeUren/User/add') {
                                echo $this->Html->link(__('Nieuwe gebruiker'), array('controller' => 'User', 'action' => 'add'));
                            } ?>
                    </li>
                    <li><?php echo $this->Html->link(__('Nieuwe boeking'), array('controller' => 'products', 'action' => 'add')); ?></li>
                    <li><?php echo $this->Html->link(__('Nieuw contract'), array('controller' => 'contract', 'action' => 'add')); ?></li>
                    <li><?php echo $this->Html->link(__('Nieuw bedrijf'), array('controller' => 'products', 'action' => 'add')); ?></li>
                    <li><hr></li>
                    <li><?php if ($this->request->here !== '/cakeUren/User') {
                                echo $this->Html->link(__('Alle gebruikers'), array('controller' => 'User', 'action' => 'index'));
                            } ?>
                    </li>
                    <li><?php echo $this->Html->link(__('Alle boekingen'), array('controller' => 'products', 'action' => 'index')); ?></li>
                    <li><?php echo $this->Html->link(__('Alle contracten'), array('controller' => 'contract', 'action' => 'index')); ?></li>
                    <li><?php echo $this->Html->link(__('Alle bedrijven'), array('controller' => 'products', 'action' => 'index')); ?></li>
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
