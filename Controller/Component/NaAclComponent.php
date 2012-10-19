<?php 
App::uses('AclComponent', 'Controller/Component');

class NaAclComponent extends AclComponent {
    public $defaultActions = array('create', 'read', 'update', 'delete');

    public function checkPermission($route) {
        //debug(AuthComponent::user());die;
        $group = $this->Aro->findById(AuthComponent::user('group_id'));
        //debug($group);die;
        //if(!$group) {
        //    throw new ForbiddenException();
        //}

        $aro = $group['Aro']['alias'];
        $aco = $route->request->controller;
        $action = $route->request->action;

        switch($action) {
            case 'add':
                $action = 'create';
                break;
            case 'index':
            case 'view':
                $action = 'read';
                break;
            case 'edit':
                $action = 'update';
        }

        //debug($this->Aco->node($aco));
        // if not added as aro  and aco, return as is 
        if(!$this->Aco->node($aco)) {
            return;
        }

        //debug($aro);
        //debug($aco);
        //debug($action);

        if(in_array($action, $this->defaultActions)) {
            if(!$this->check($aro, $aco, $action)) {
                throw new ForbiddenException();
            }
        }
        else {
            if(!$this->checkExtensionAction($aro, $aco, $action)) {
                throw new ForbiddenException();
            }
        } 
    }

    private function checkExtensionAction($aro, $aco, $action) {
        $ArosAco = ClassRegistry::init("ArosAco");
        $ArosAcosExt = ClassRegistry::init("ArosAcosExtension");

        $aros = $this->Aro->node($aro);
        $acos = $this->Aco->node($aco);

        $aros_acos = $ArosAco->find('first', array( 
            'conditions' => array(
                'aro_id' => $aros[0]['Aro']['id'],
                'aco_id' => $acos[0]['Aco']['id'],
            )
        ));

        $aros_acos_ext = $ArosAcosExt->find('first', array(
            'conditions' => array(
                'aros_acos_id' => $aros_acos['ArosAco']['id'],
                'action_name' => $action,
            )
        )); 

        return $aros_acos_ext;
    }

}

