<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'Flash',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'User',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'User',
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            )
        )
    );

    /**
     * Helpers loaded for this controller.
     *
     * @var array
     */
    public $helpers = array(
        'Form',
        'Html',
        'Flash',
        'Js'
    );


    /**
     * Models loaded for this controller.
     *
     * @var array
     */
    public $uses = array();


    public $user_id =  NULL;


    public function beforeFilter()
    {

        $this->Auth->allow('login');

    }

    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        // Default deny
        return false;
    }

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Verkeerde gebruikersnaam of wachtwoord. Probeer het nog eens.'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Called after controller action logic, but before the view is rendered.
     *
     * @return void
     */
    public function beforeRender() {
        parent::beforeRender();
    }

    /**
     * Called after every controller action, and after rendering is complete.
     * This is the last controller method to run.
     *
     * @return void
     */
    public function afterFilter() {
        parent::afterFilter();
    }
}
