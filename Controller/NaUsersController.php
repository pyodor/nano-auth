<?php
App::uses('NanoAuthAppController', 'NanoAuth.Controller');
/**
 * NaUsers Controller
 *
 * @property NaUser $NaUser
 */
class NaUsersController extends NanoAuthAppController {
/**
 * beforeFilter method
 *
 * @return void
 */
    public function beforeFilter() {
        parent::beforeFilter();
    }

/**
 * logout method
 *
 * @return void
 */
    public function logout() {
        $this->Session->delete('NaUser');
        $this->redirect($this->Auth->logout());
    }

/**
 * login method
 *
 * @return void
 */
    public function login() {
        if($this->Auth->user()) {
            $this->redirect($this->Auth->redirect());
        }

        if($this->request->is('post')) {
            if($this->Auth->login()) {
                $this->Session->write('NaUser', $this->Auth->user());
                $this->redirect($this->Auth->redirect());
            }
            else{
                $this->Session->setFlash('Your username/password combination was incorrect.');
            }
        } 
    }

/**
 * index method
 *
 * @return void
 */
    public function index() {
		$this->NaUser->recursive = 0;
		$this->set('naUsers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->NaUser->id = $id;
		if (!$this->NaUser->exists()) {
			throw new NotFoundException(__('Invalid na user'));
		}
		$this->set('naUser', $this->NaUser->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
        if ($this->request->is('post')) {
			$this->NaUser->create();
			if ($this->NaUser->save($this->request->data)) {
				$this->Session->setFlash(__('The na user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The na user could not be saved. Please, try again.'));
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
		$this->NaUser->id = $id;
		if (!$this->NaUser->exists()) {
			throw new NotFoundException(__('Invalid na user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->NaUser->save($this->request->data)) {
				$this->Session->setFlash(__('The na user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The na user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->NaUser->read(null, $id);
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
		$this->NaUser->id = $id;
		if (!$this->NaUser->exists()) {
			throw new NotFoundException(__('Invalid na user'));
		}
		if ($this->NaUser->delete()) {
			$this->Session->setFlash(__('Na user deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Na user was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
