<?php
App::uses('NanoAuthAppController', 'NanoAuth.Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends NanoAuthAppController {
    public function beforeFilter() {
        $this->linkAssoc();
    }

    private function linkAssoc() {
        $userAssoc = Configure::read('NanoAuth.userAssoc');
        if($userAssoc) $this->User->bindModel($userAssoc);
    }
/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->User->recursive = 0;
        $users = $this->paginate();
        $this->set('Users', $users);
        $this->set(array(
            'users' => $users,
            '_serialize' => array('users')
        
        ));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('User', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
        }
        $this->set('groups', $this->User->Group->find('list', array(
            'fields' => array(
                'Aro.id', 'Aro.alias'
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
               if (!$id) {
                       throw new NotFoundException(__('user id is required'));
        }
        switch(true) {
            case $this->request->is('post'):
            case $this->request->is('put'):
                if ($this->User->save($this->request->data)) {

                    // we do this as saveAll or saveAssociated will not work 
                    // if main model already exist and related models still
                    // to be inserted
                    $data = $this->request->data;
                    $user = $data['User'];
                    unset($data['User']);
                    $this->linkAssoc();
                    foreach($data as $model => $rdata) {
                        if(!isset($data[$model]['id']) or empty($data[$model]['id'])) {
                            $data[$model]['user_id'] = $user['id'];
                            $this->User->{$model}->create();
                        }
                        $this->User->{$model}->save($data);
                    }
                    // TODO support for hasMany, belongsTo & HABTM

                    $this->Session->setFlash(__('The user has been saved'));
                    return $this->redirect(array('action' => 'index'));
                }
                else {
                                   return $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                           }
            default:
                $this->request->data = $this->User->read(null, $id);
                if (!$this->request->data) {
                               throw new NotFoundException(__('Invalid user'));
                }

         }
        
        $this->set('groups', $this->User->Group->find('list', array(
            'fields' => array(
                'Aro.id', 'Aro.alias'
            )
        )));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
