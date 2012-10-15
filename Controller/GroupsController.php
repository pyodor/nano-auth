<?php
App::uses('NanoAuthAppController', 'NanoAuth.Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 */
class GroupsController extends NanoAuthAppController {

    public function init() {
        /*($aro = $this->Acl->Aco;
        $groups = array(
            0 => array(
                'alias' => 'groups'
            ),
            1 => array(
                'alias' => 'users'
            ),
        );
        foreach ($groups as $data) {
            $aro->create();
            $aro->save($data);
        }*/

        $aro = new Aro();
        $users = array(
            0 => array(
                'alias' => 'admin',
                'parent_id' => 3,
                'model' => 'User',
                'foreign_key' => 1,
            ),
            1 => array(
                'alias' => 'normal',
                'parent_id' => 4,
                'model' => 'User',
                'foreign_key' => 2,
            ),
        );

        foreach ($users as $data) {
            $aro->create();
            $aro->save($data);
        }
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->set('group', $this->Group->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
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
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Group->read(null, $id);
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
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		if ($this->Group->delete()) {
			$this->Session->setFlash(__('Group deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Group was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
