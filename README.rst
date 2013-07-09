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
- ACL


Installation - Composer
-----------------------

Ensure ``require`` is present in ``composer.json``. This will install the plugin into ``Plugin/NanoAuth``::

    {
        "require": {
            "pyodor/nano-auth": "0.2.*"
        }
    }

Get composer and install::

    $ curl -sS https://getcomposer.org/installer | php
    $ php composer.phar install


Installation - Git
------------------

Make sure you properly baked your app::

    cake bake myapp
  
and provide the following parameters for your ``myapp``, database setup and some other stuffs.


Clone the plugin inside your ``myapp/Plugin`` directory::

    git clone https://github.com/pyodor/nano-auth.git NanoAuth

In your ``myapp/Config/bootstrap.php`` add this::

    CakePlugin::loadAll(array(
        'NanoAuth' => array('bootstrap' => false, 'routes' => true)
    ));

Migrate ``NanoAuth``'s schema, issue this inside your ``myapp``:: 
    
    Console/cake schema create --plugin NanoAuth

this will drop and recreates 4 tables::
    
    acos
    aros
    aros_acos
    users

Usage
--------------

Adding your first user the administrator, navigate to::

    /users/add

and provide the username, password, email and select Administrator in Group, click submit.

Locking the ``users`` controller after adding administrator, navigate to ``/login`` and provide the administrator credentials you created
then navigate to ``/controllers/add`` type ``users`` on the Alias then submit. Then navigate to ``/acl/add`` and provide the following::
    
    Group => Administrator
    Controller => users
    Create => 1
    Read => 1
    Update => 1
    Delete => 1

the above values are making the Administrator Group to have full access on the users management module. To know more on acl module read the ACL documentation.

Routes available::
    
    /login
    /logout
    /forgot_password
    /password_reset/*
    /users/:action/*
    /groups/:action/*
    /controllers/:action/*
    /acl/:action/*

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

Linking associations ``NanoAuth``'s User model with your ``myapp`` models using Configurations, for example::

    Configure::write('NanoAuth', array(
        'userAssoc' => array(
            'hasOne' => array('Profile'), // only hasOne is supported for now
        )
    ));

ACL
--------------

Inside your AppController add ``NanoAuth.NaAcl``::

    public $components = array('NanoAuth.NaAcl');

Any controller you have in your app that was entered on the ``NanoAuth`` backend will be ACLified    

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
- Custom template
- API (json, xml) generator for front-end use 

License
-------

``NanoAUth`` is released under the WTFPL_ license.

Support
-----------------

Send me_ a bottle of beer or FORK_ it! :) 

.. _WTFPL: http://sam.zoy.org/wtfpl/
.. _me: csicebu@gmail.com
.. _FORK: https://github.com/pyodor/nano-auth

