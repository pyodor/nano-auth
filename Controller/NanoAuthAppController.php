<?php

class NanoAuthAppController extends AppController {
    public $allowed_actions = array(
        'add', 'forgot_password', 'password_reset'
    );

    public $components = array(
        'RequestHandler',
        'Session',
        'Security',
        'NanoAuth.NaAcl',
        'Auth' => array(
            /*'authenticate' => array(
                'Digest' => array(
                    'realm' => 'cake_plugin_tester.dev',
                    'fields' => array('password' => 'digest_hash')
                )
            ),
            /*'authenticate' => array(
                'Basic',
            ),
            /*'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            ),*/
            'loginAction' => array(
                'controller' => 'pages',
                'action' => 'login',
                'plugin' => 'nano_auth'
            ),
            'loginRedirect' => array('controller' => 'users', 'action' => 'index', 'plugin' => 'nano_auth'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'login', 'plugin' => 'nano_auth'),
        )
    );

    public $config = null;

    public function beforeFilter() {
        $this->setDigestAuthIfNeeded(); 
        $this->loadUserConfig();
        $this->Auth->allow($this->allowed_actions);
    }

    public function isApiCall() {
        return $this->RequestHandler->accepts(array('json'));
    }

    private function setDigestAuthIfNeeded() {
        if(isset($_SERVER['HTTP_X_DIGEST_AUTH']) && $_SERVER['HTTP_X_DIGEST_AUTH']) {
            $realm = env('SERVER_NAME');
            $this->Auth->authenticate = array(
                'Digest' => array(
                    'realm' => $realm,
                    'fields' => array('password' => 'digest_hash')
                )
            );
        }
    }

    private function loadUserConfig() {
        $this->config = Configure::read("NanoAuth");
        if($this->config) {
            $config = $this->config;
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

