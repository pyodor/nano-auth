<?php
App::uses('NanoAuthAppController', 'NanoAuth.Controller');
/**
 * Aros Controller
 *
 * @property Aro $Aro
 */
class ArosController extends NanoAuthAppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Aro->recursive = 0;
		$this->set('aros', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Aro->id = $id;
		if (!$this->Aro->exists()) {
			throw new NotFoundException(__('Invalid aro'));
        }
        $aro = $this->Aro->read(null, $id);
        $this->set('aro', $aro);
        //debug($aro);die;
        /*
        $aros_acos_id = $aro['Aco'][0]['Permission']['id'];
        $ArosAcosExt = ClassRegistry::init('ArosAcosExtension');
        $action_extensions = $ArosAcosExt->find('all', array(
            'fields' => array(
                'aros_acos_id', 'action_name'
            ),
            'conditions'=>array(
                'aros_acos_id'=>$aros_acos_id
            )
        ));*/
        //debug($action_extensions);die;
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Aro->create();
			if ($this->Aro->save($this->request->data)) {
				$this->Session->setFlash(__('The aro has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The aro could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Aro->id = $id;
		if (!$this->Aro->exists()) {
			throw new NotFoundException(__('Invalid aro'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Aro->save($this->request->data)) {
				$this->Session->setFlash(__('The aro has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The aro could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Aro->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Aro->id = $id;
		if (!$this->Aro->exists()) {
			throw new NotFoundException(__('Invalid aro'));
		}
		if ($this->Aro->delete()) {
			$this->Session->setFlash(__('Aro deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Aro was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
