<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */

    Router::connect('/login', array('plugin' => 'nano_auth', 'controller' => 'users', 'action' => 'login'));
    Router::connect('/logout', array('plugin' => 'nano_auth', 'controller' => 'users', 'action' => 'logout'));

    Router::connect('/users', array('plugin' => 'nano_auth', 'controller' => 'users'));
    Router::connect('/users/:action/*', array('plugin' => 'nano_auth', 'controller' => 'users'));

    Router::connect('/groups', array('plugin' => 'nano_auth', 'controller' => 'aros'));
    Router::connect('/groups/:action/*', array('plugin' => 'nano_auth', 'controller' => 'aros'));
    
    Router::connect('/controllers', array('plugin' => 'nano_auth', 'controller' => 'acos'));
    Router::connect('/controllers/:action/*', array('plugin' => 'nano_auth', 'controller' => 'acos'));
    
    Router::connect('/action', array('plugin' => 'nano_auth', 'controller' => 'aros_acos'));
    Router::connect('/action/:action/*', array('plugin' => 'nano_auth', 'controller' => 'aros_acos'));
    
    Router::connect('/forgot_password', array('plugin' => 'nano_auth', 'controller' => 'users', 'action' => 'forgot_password'));
    Router::connect('/password_reset/*', array('plugin' => 'nano_auth', 'controller' => 'users', 'action' => 'password_reset'));


