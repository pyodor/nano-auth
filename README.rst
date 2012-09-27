=================================================
Welcome to NanoAuth a CakePHP Plugin
=================================================

``NanoAuth`` is an Authenctication Plugin for CakePHP  that utilizes and wraps Auth Component of the framework.   

Installation
--------------

Clone the plugin inside your app/Plugin directory::

    git clone http://[your_username]@202.172.229.26/rhodecode/NanoAuth

Migrate the latest schema::

    cake schema create -s [latest schema number] --plugin NanoAuth

In your app/Config/bootstrap.php add this::

    CakePlugin::loadAll(array(
        'NanoAuth' => array('bootstrap' => false, 'routes' => true)
    ));
    <F3>

Usage
--------------

Accessing the authentication page::

    http://your-app-url/login
    http://your-app-url/logout

You may want to make your own route for the login/logout page just add this on your routes.php::

    Router::connect('/anything-you-like', array('plugin' => 'nano_auth', 'controller' => 'na_users', 'action' => 'login'));

You can access logged-in user in your controller like this::

    if(!$this->Session->read('NaUser')) { // user not logged-in
        $this->redirect('/login'); 
    }

Features
------------------

- Full CRUD user management with pagination
- Utilizes CakePHP Auth Component
    
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

