<?php
App::uses('NanoAuthAppController', 'NanoAuth.Controller');
/**
 * ArosAcos Controller
 *
 * @property ArosAco $ArosAco
 */
class ArosAcosController extends NanoAuthAppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
        $this->ArosAco->recursive = 1;
        //debug($this->paginate());die;
		$this->set('arosAcos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ArosAco->id = $id;
		if (!$this->ArosAco->exists()) {
			throw new NotFoundException(__('Invalid aros aco'));
		}
		$this->set('arosAco', $this->ArosAco->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ArosAco->create();
			if ($this->ArosAco->save($this->request->data)) {
				$this->Session->setFlash(__('The aros aco has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The aros aco could not be saved. Please, try again.'));
			}
        }
        $this->set('aros', $this->ArosAco->Aro->find('list', array(
            'fields' => array(
                'Aro.id', 'Aro.alias'
            )
        )));
        $this->set('acos', $this->ArosAco->Aco->find('list', array(
            'fields' => array(
                'Aco.id', 'Aco.alias'
            )
        )));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ArosAco->id = $id;
		if (!$this->ArosAco->exists()) {
			throw new NotFoundException(__('Invalid aros aco'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ArosAco->save($this->request->data)) {
				$this->Session->setFlash(__('The aros aco has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The aros aco could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ArosAco->read(null, $id);
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
		$this->ArosAco->id = $id;
		if (!$this->ArosAco->exists()) {
			throw new NotFoundException(__('Invalid aros aco'));
		}
		if ($this->ArosAco->delete()) {
			$this->Session->setFlash(__('Aros aco deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Aros aco was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
