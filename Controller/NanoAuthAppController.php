<?php

class NanoAuthAppController extends AppController {
    public $components = array(
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'na_users',
                'action' => 'login',
                'plugin' => 'nano_auth'
            ),
            'authError' => 'Did you really think you are allowed to see that?',
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username', 'password')
                )
            )
        )
    );

    public function beforeFilter() {
        $this->Auth->userModel = 'NaUsers';
        $this->Auth->allow('add');
    }
}

