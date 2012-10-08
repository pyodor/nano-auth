<?php 
App::uses('AclComponent', 'Controller/Component');

class NaAclComponent extends AclComponent {
    public $components = array('Acl');

    public function check($route) {
        $Aro = ClassRegistry::init('Aro');
        debug($Aro->find('all'));die;
        $controller = $route->request->controller;
        $action = $route->request->action;
        debug($this->Acl->check('Users', $controller, $action));die;
    }
}

