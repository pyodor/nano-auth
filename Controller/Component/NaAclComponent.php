<?php 
App::uses('AclComponent', 'Controller/Component');

class NaAclComponent extends AclComponent {
    public $defaultActions = array('create', 'read', 'update', 'delete');
    public $route; 
    public $error = null;
    
    public function initialize(&$controller, $settings=array()) {
        $this->route =& $controller;
        $this->__routeIfAvailable();

        $group = $this->Aro->findById(AuthComponent::user('group_id'));
        
        $aro = !empty($group) && isset($group['Aro']) ? $group['Aro']['alias'] : null;
        $aco = Inflector::underscore(Inflector::camelize($this->route->request->controller));
        $action = $this->route->request->action;
        
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
        //debug($this->route->request);die; 
        if(in_array($action, $this->defaultActions)) {
            if(!$this->check($aro, $aco, $action)) {
                $this->__forbidden();
            }
        }
    }
    
    private function __isJsonAndXmlRequest() {
        return isset($this->route->request['ext']) && 
               in_array($this->route->request['ext'], array('json','xml'));
    }

    private function __response() {
        switch($this->route->request['ext']) {
            case 'json':
                $this->__toJson();
                break;
            case 'xml':
                $this->__toXml();
                break;
        }
    }

    public function __errorArray() {
        $here = $this->route->request->here;
        $controller = $this->route->request->controller;
        return array(
            $controller => array(
                'Error' => array(
                    'message' => "$here " . $this->error,
                )
            )
        );
    }

    private function __routeIfAvailable() {
        if(get_class($this->route)=='CakeErrorController') {
            if($this->__isJsonAndXmlRequest()) {
                $this->error = "is not a valid route or call.";
                $this->__response(); 
            }
        }
    }

    private function __forbidden() {
        if($this->__isJsonAndXmlRequest()) {
            $this->error = "access is forbidden.";
            $this->__response();
        }
        else {
            throw new ForbiddenException();
        }
    }

    private function __toJson() {
        header('Content-type: application/json');
        echo json_encode($this->__errorArray());
        die;
    }
    
    private function __toXml() {
        $xmlObject = Xml::fromArray($this->__errorArray());
        $xmlString = $xmlObject->asXML();
        header('Content-type: application/xml');
        echo $xmlString;
        die;
    }
}

