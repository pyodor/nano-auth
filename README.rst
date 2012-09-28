=================================================
Welcome to NanoAuth a CakePHP Plugin
=================================================

``NanoAuth`` is an Authenctication Plugin for CakePHP  that utilizes and wraps Auth Component of the framework.   

Features
------------------

- Full CRUD user management with pagination
- Utilizes CakePHP Auth Component
- Supports app level configuration (i.e setting landing page after login or logout)
- Forgot Password feature (sends password reset code)
- Password reset page (using the password reset code)

Installation
--------------

Clone the plugin inside your app/Plugin directory::

    git clone http://[your_username]@202.172.229.26/rhodecode/NanoAuth

Migrate the latest schema, inside your app directory do this::

    Console/cake schema create -s [latest schema number] --plugin NanoAuth

In your app/Config/bootstrap.php add this::

    CakePlugin::loadAll(array(
        'NanoAuth' => array('bootstrap' => false, 'routes' => true)
    ));

Usage
--------------

Default routes::

    /login
    /logout
    /user/add
    /forgot_password
    /password_reset/*

Accessing the authentication page::

    http://your-app-url/login
    http://your-app-url/logout

You may want to make your own route for the login/logout page just add this on your routes.php::

    Router::connect('/anything-you-like', array('plugin' => 'nano_auth', 'controller' => 'na_users', 'action' => 'login'));

You can access logged-in user in your controller like this::
    
    $user = $this->Session->read('NaUser');
    if(!$user) { // user not logged-in
        $this->redirect('/login'); 
    }
    debug($user); // see what's inside user

Configuration
--------------

Default page after login and logout is ``NaUsers/index`` of the plugin, to configure your own landing page add this on your Config/core.php ::
    
    Configure::write('NanoAuth', array(
        'loginRedirect' => array('controller' => 'MyController', 'action' => 'index'),
        'logoutRedirect' => array('controller' => 'MyOtherController', 'action' => 'index'),
    ));

For forgot password feature, the sending of email by default is in debug mode, 
to enable this in production add this in your Config/core.php under NanoAuth's configuration::

    'email_sending' => true,

TODO
----------------

- Role Management 
- Custom template
- API (json, xml) generator for front-end use 

License
-------

``NanoAUth`` is released under the WTFPL_ license.

Support
-----------------

Holler me_ or FORK_ it! :) 

.. _WTFPL: http://sam.zoy.org/wtfpl/
.. _me: dado@neseapl.com
.. _FORK: http://202.172.229.26/rhodecode/NanoAuth/fork

