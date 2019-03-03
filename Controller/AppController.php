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
 * @Property $user User
 * @Property $abilitiesroles AbilitiesRoles
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Flash',
        'RequestHandler',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'Pages',
                'action' => 'display'
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
    public $uses = array('User', 'AbilitiesRoles');


    public $user_id =  NULL;


    public function beforeFilter()
    {
        $this->Auth->allow('login');
        CakeLog::write('debug', Router::url(null, true) . '  gebruiker: ' . AuthComponent::user('username') . ', id: ' . AuthComponent::user('user_id') . ', roles: ' . AuthComponent::user('role_id'));

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
                $userAbilities = $this->AbilitiesRoles->find("list", array(
                    'conditions' => array(
                        'role_id' => AuthComponent::user('role_id')
                    ),
                    'fields' => array(
                        'ability_id'
                    )
                ));

                SessionComponent::write('Abilities', $userAbilities);    //zoek de abilities op van de ingelogde user adhv diens role_id en sla de abilities op.
                return $this->redirect('/');
            }
            CakeLog::write('debug', Router::url(null, true) . '  gebruiker: ' . AuthComponent::user('username') . ', id: ' . AuthComponent::user('user_id') . ', rol: ' . AuthComponent::user('role_id'));
            $this->Flash->error(__('Verkeerde gebruikersnaam of wachtwoord. Probeer het nog eens.'));
        }
    }

    public function logout() {
        SessionComponent::write('Abilities');
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Called after controller action logic, but before the view is rendered.
     *
     * @return void
     */
    public function beforeRender() {
        $userAbilities = SessionComponent::read('Abilities');
        if ($userAbilities == null) {
            $userAbilities = array();
        }
        $this->set('userAbilities', $userAbilities);
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

    protected function checkAuth($roleId) {
        $searchAbility = SessionComponent::read('Abilities');   //check of de userrol bevoegt is voor deze pagina
        if (!array_search($roleId, $searchAbility) && !array_search(1, $searchAbility)) {
            $this->Flash->error(__('Je hebt geen autorisatie voor deze handeling.'));
            $this->redirect('/');
            return false;
        } else {
            return true;
        }
    }
}
