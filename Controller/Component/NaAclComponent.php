<?php 
App::uses('AclComponent', 'Controller/Component');

class NaAclComponent extends AclComponent {
    public $defaultActions = array('create', 'read', 'update', 'delete');

    public function checkPermission($route) {
        $group = $this->Aro->findById(AuthComponent::user('group_id'));
        //debug($group);die;
        if(!$group) return false;

        $aro = $group['Aro']['alias'];
        $aco = $route->request->controller;
        $action = $route->request->action;

        if(in_array($action, $this->defaultActions)) {
            return $this->check($aro, $aco, $action);
        }
        else {
            return $this->checkExtensionAction($aro, $aco, $action);
        } 
    }

    private function checkExtensionAction($aro, $aco, $action) {
        // TODO: brain dump, for non-CRUD actions
        debug($this->Aro->node($aro));die;
        $this->ArosAcosExt = ClassRegistry::init("ArosAcosExtension");

    }


}

