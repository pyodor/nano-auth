=================================================
Welcome to NanoAuth a CakePHP Plugin
=================================================

``NanoAuth`` is an Authenctication Plugin for CakePHP  that utilizes and wraps Auth and ACL Component of the framework.   

Features
------------------

- Full CRUD user management with pagination
- Utilizes CakePHP Auth Component
- Supports app level configuration (i.e setting landing page after login or logout)
- Forgot Password feature (sends password reset code through email)
- Password Reset page (using the password reset code)
- With Unit & Functional Testing and Code Coverage  (in progress)
- ACL (todo)


Installation
--------------

Make sure you properly baked your app::

    cake bake myapp
  
and provide the following parameters for your ``myapp``, database setup and some other stuffs.


Clone the plugin inside your ``myapp/Plugin`` directory::

    git clone http://[your_username]@202.172.229.26/rhodecode/CakePHP_Plugin/NanoAuth

In your ``myapp/Config/bootstrap.php`` add this::

    CakePlugin::loadAll(array(
        'NanoAuth' => array('bootstrap' => false, 'routes' => true)
    ));

Migrate ``NanoAuth``'s schema, issue this inside your ``myapp``, please do note this will drop and recreates ``users`` table:: 
    
    Console/cake schema create -s [latest schema number] --plugin NanoAuth

after the schema was created a default user ``admin`` with password ``admin123`` will be inserted.

Usage
--------------

Default routes::
    
    /login
    /logout
    /forgot_password
    /password_reset/*
    /users/:action/*

Accessing the authentication page::

    http://your-app-url/login
    http://your-app-url/logout

You may want to make your own route for the login/logout page just add this on your ``myapp/Config/routes.php``::

    Router::connect('/anything-you-like', array('plugin' => 'nano_auth', 'controller' => 'users', 'action' => 'login'));

You can access logged-in user in your controller like this::
    App::uses('AuthComponent', 'Controller/Component');

    $user = AuthComponent::user();
    if(!$user) { // user not logged-in
        $this->redirect('/login'); 
    }
    debug($user); // see what's inside user

Accessing ``NanoAuth``'s User model from your app controller::

    public $uses = array('NanoAuth.User');

    public function index() {
        debug($this->User->find('all'));
    }

Relating ``NanoAuth``'s User model with your ``myapp`` models, for example::

    // Inside your app Profile model
    class Profile extends AppModel {
        public $belongsTo = array(
            'User'
        );
    }

    // And then accessing it on the controller
    public $uses = array('NanoAuth.User', 'Profile');

    public function index() {
        debug($this->Profile->find('all'));
    }
    
Configuration
--------------

Default page after login and logout is ``users/index`` of ``NanoAuth``'s plugin, to configure your own landing page add this on your ``myapp/Config/core.php``::
    
    Configure::write('NanoAuth', array(
        'loginRedirect' => array('controller' => 'my_controller', 'action' => 'index'),
        'logoutRedirect' => array('controller' => 'my_other_Controller', 'action' => 'index'),
    ));

For forgot password feature, the sending of email by default is in debug mode, 
to enable this in production add this in your ``myapp/Config/core.php`` under ``NanoAuth``'s configuration::

    'email_sending' => true,

Tests
--------------

Make sure you installed properly ``PHPUnit`` and ``Xdebug`` for testing
To run the tests using web runner access the test page of your ``myapp``::
    
    http://myapp.com/test.php

and run all the tests under ``Plugins->NanoAuth``. 

TODO
----------------

- Unit Testing and Code Coverage
- ACL support
- Custom template
- API (json, xml) generator for front-end use 

License
-------

``NanoAUth`` is released under the WTFPL_ license.

Support
-----------------

Send me_ a bottle of beer or FORK_ it! :) 

.. _WTFPL: http://sam.zoy.org/wtfpl/
.. _me: dado@neseapl.com
.. _FORK: http://202.172.229.26/rhodecode/CakePHP_Plugin/NanoAuth/fork

