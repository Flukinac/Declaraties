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
        echo $this->Html->script('jQuery 3.3.1');
        echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js');
        echo $this->Html->script('script');         //activeer eigen javascript

        echo $this->Html->charset();

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.selection').select2({
                    width: 'resolve'
                });
            });
        </script>
    </head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/cakeUren">Uren declaratie</a>

    <?php if (AuthComponent::user()): ?>
    <div class="collapse navbar-collapse container" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/cakeUren">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if (AuthComponent::user('role_id') == '1'): ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Gebruikers
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php echo $this->Html->link(__('Alle gebruikers'), array('controller' => 'User', 'action' => 'index'), array('class' => 'dropdown-item')); ?>
                    <div class="dropdown-divider"></div>
                    <?php echo $this->Html->link(__('Nieuwe gebruiker'), array('controller' => 'User', 'action' => 'add'), array('class' => 'dropdown-item')); ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Rollen
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php echo $this->Html->link(__('Alle rollen'), array('controller' => 'Roles', 'action' => 'index'), array('class' => 'dropdown-item')); ?>
                    <div class="dropdown-divider"></div>
                    <?php echo $this->Html->link(__('Nieuwe rol'), array('controller' => 'Roles', 'action' => 'add'), array('class' => 'dropdown-item')); ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Contracten
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php echo $this->Html->link(__('Alle contracten'), array('controller' => 'Contracts', 'action' => 'index'), array('class' => 'dropdown-item')); ?>
                    <div class="dropdown-divider"></div>
                    <?php echo $this->Html->link(__('Nieuw contract'), array('controller' => 'Contracts', 'action' => 'add'), array('class' => 'dropdown-item')); ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Bedrijven
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php echo $this->Html->link(__('Alle bedrijven'), array('controller' => 'Company', 'action' => 'index'), array('class' => 'dropdown-item')); ?>
                    <div class="dropdown-divider"></div>
                    <?php echo $this->Html->link(__('Nieuw bedrijf'), array('controller' => 'Company', 'action' => 'add'), array('class' => 'dropdown-item')); ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Boekingen
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php echo $this->Html->link(__('Alle boekingen'), array('controller' => 'UserMonthbookings', 'action' => 'index'), array('class' => 'dropdown-item')); ?>
                    <div class="dropdown-divider"></div>
                    <?php echo $this->Html->link(__('Nieuwe boeking'), array('controller' => 'UserMonthbookings', 'action' => 'addMonthBooking'), array('class' => 'dropdown-item')); ?>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Beheer
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php echo $this->Html->link(__('Boeking beheer'), array('controller' => 'UserMonthbookings', 'action' => 'settings'), array('class' => 'dropdown-item')); ?>
                    <div class="dropdown-divider"></div>
                    <?php echo $this->Html->link(__('Mailtekst'), array('controller' => 'Administratie', 'action' => 'mailTemplate'), array('class' => 'dropdown-item')); ?>
                    <div class="dropdown-divider"></div>
                    <?php echo $this->Html->link(__('Uren Status'), array('controller' => 'Administratie', 'action' => 'status'), array('class' => 'dropdown-item')); ?>
                </div>
            </li>
            <?php else: ?>
            <li class="nav-item active">
                <a class="nav-link" href="/cakeUren/UserMonthbookings/addMonthBooking">Nieuwe boeking <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/cakeUren/UserMonthbookings/index">Mijn boekingen <span class="sr-only">(current)</span></a>
            </li>
            <?php endif; ?>
        </ul>
        <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php echo $this->Html->link(__('Mijn profiel'), array('controller' => 'User', 'action' => 'edit/' . AuthComponent::user("user_id"))); ?>
                <div class="dropdown-divider"></div>
                    <?php echo $this->Html->link(__('Nieuw wachtwoord'), array('controller' => 'User', 'action' => 'password/' . AuthComponent::user("user_id"))); ?>
                <div class="dropdown-divider"></div>
                    <?php echo $this->Html->link('Logout', array('controller' => 'User', 'action' => 'logout')); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</nav>

    <div id="container">
            <?php echo $this->Flash->render(); ?>
            <?php echo $this->fetch('content'); ?>
        <div id="footer">
            <p>
                <?php //echo $cakeVersion; ?>
            </p>
        </div>
    </div>
<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
