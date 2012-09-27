<?php

class NanoAuthAppController extends AppController {
    public $components = array(
        'Session',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'na_users',
                'action' => 'login',
                'plugin' => 'nano_auth'
            ),
            'authenticate' => array(
                'Form' => array('userModel' => 'NaUser'),
            ),
            'loginRedirect' => array('controller' => 'na_users', 'action' => 'index', 'plugin' => 'nano_auth'),
            'logoutRedirect' => array('controller' => 'na_users', 'action' => 'index', 'plugin' => 'nano_auth'),
        )
    );

    public function beforeFilter() {
    }
}

