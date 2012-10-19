<?php
App::uses('NanoAuthAppController', 'NanoAuth.Controller');
/**
 * Acos Controller
 *
 * @property Aco $Aco
 */
class AcosController extends NanoAuthAppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Aco->recursive = 0;
		$this->set('acos', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Aco->id = $id;
		if (!$this->Aco->exists()) {
			throw new NotFoundException(__('Invalid aco'));
        }
        //debug($this->Aco->read(null, $id));die;
		$this->set('aco', $this->Aco->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Aco->create();
			if ($this->Aco->save($this->request->data)) {
				$this->Session->setFlash(__('The aco has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The aco could not be saved. Please, try again.'));
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
		$this->Aco->id = $id;
		if (!$this->Aco->exists()) {
			throw new NotFoundException(__('Invalid aco'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Aco->save($this->request->data)) {
				$this->Session->setFlash(__('The aco has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The aco could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Aco->read(null, $id);
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
		$this->Aco->id = $id;
		if (!$this->Aco->exists()) {
			throw new NotFoundException(__('Invalid aco'));
		}
		if ($this->Aco->delete()) {
			$this->Session->setFlash(__('Aco deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Aco was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
