=================================================
Welcome to NanoAuth a CakePHP Plugin
=================================================

``NanoAuth`` is an Authenctication Plugin for CakePHP  that utilizes and wraps Auth Component of the framework.   

Installation
--------------

Clone the plugin inside your app/Plugin directory::

    git clone http://[your_username]@202.172.229.26/rhodecode/NanoAuth

Usage
--------------

Accessing the authentication page:

Login route is ``http://your-app-url/login``
Logout route is ``http://your-app-url/login``

You may want to make your own route for the login/logout page just add this on your routes.php::

    Router::connect('/anything-you-like', array('plugin' => 'nano_auth', 'controller' => 'na_users', 'action' => 'login'));

You can access logged-in user in your controller like this::

    if(!$this->Session->read('NaUser')) { // user not logged-in
        $this->redirect('/login'); 
    }

NanoAuth Features
------------------

- Full CRUD user management with pagination
- Utilizes CakePHP Auth Component
    
TODO
----------------

- Role Management 
- Custome template
- API (json, xml) generator for front-end use 

License
-------

``NanoAUth`` is released under the WTFPL_ license.

Support
-----------------

Holler me_ :)

.. _WTFPL: http://sam.zoy.org/wtfpl/
.. _me: dado@neseapl.com
