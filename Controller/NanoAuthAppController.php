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
        $this->loadUserConfig();
        $this->Auth->allow('add');
    }

    private function loadUserConfig() {
        $config = Configure::read("NanoAuth");
        if($config) {
            $this->Auth->loginRedirect = array(
                'controller' => isset($config['loginRedirect']['controller']) ? $config['loginRedirect']['controller'] : null,
                'action' => isset($config['loginRedirect']['action']) ? $config['loginRedirect']['action'] : null,
                'plugin' => isset($config['loginRedirect']['plugin']) ? $config['loginRedirect']['plugin'] : null,
            );
            $this->Auth->logoutRedirect = array(
                'controller' => isset($config['logoutRedirect']['controller']) ? $config['logoutRedirect']['controller'] : null,
                'action' => isset($config['logoutRedirect']['action']) ? $config['logoutRedirect']['action'] : null,
                'plugin' => isset($config['logoutRedirect']['plugin']) ? $config['logoutRedirect']['plugin'] : null,
            );
        }
    }
}

