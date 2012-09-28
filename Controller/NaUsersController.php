<?php
App::uses('NanoAuthAppController', 'NanoAuth.Controller');
App::uses('CakeEmail', 'Network/Email');
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
 * password_reset method
 *
 * @return void
 */
    public function password_reset($code=NULL) {
        if($this->request->is('post')) {
            $user = $this->NaUser->findByPasswordResetCode($this->request->data['NaUser']['code']);
            if($this->request->data['NaUser']['password'] != $this->request->data['NaUser']['password_confirmation']) {
                $this->Session->setFlash("Password doesn't match");
            }
            else {
                $this->NaUser->read(null, $user['NaUser']['id']);
                $this->NaUser->set('password', $this->request->data['NaUser']['password']);
                $this->NaUser->set('password_reset_code', '');
                if($this->NaUser->save()) {
                    $this->Session->setFlash('Password reset successfull, you may now login');
                    $this->redirect('/login');
                }
                else {
                    $this->Session->setFlash('Error resetting your password');
                }
            }
        }
        else {
            $user = $this->NaUser->findByPasswordResetCode($code);
            if(!$user) {
                $this->Session->setFlash('Password reset code is invalid');
            }
        }
        $this->set(compact('user'));
    }
/**
 * forgot_password method
 *
 * @return void
 */
    public function forgot_password() {
        if($this->request->is('post')) {
            $user = $this->NaUser->findByEmail($this->request->data['NaUser']['email']);
            if(!$user) {
                $this->Session->setFlash('Email address not found');
            }
            else {
                $reset_code = Security::hash($this->request->data['NaUser']['email']);
                $this->NaUser->read(null, $user['NaUser']['id']);
                $this->NaUser->set('password_reset_code', $reset_code);
                $this->NaUser->save();
                $user = $this->NaUser->read(null, $user['NaUser']['id']);
                if($this->sendPasswordResetCode($user)) {
                    $this->Session->setFlash('Password reset code was sent to your email address');
                }
                else {
                    $this->Session->setFlash('Error sending your password reset code');
                }
            }
        }
    }

    private function sendPasswordResetCode($user) {
        if(empty($user['NaUser']['password_reset_code'])) return false;
        
        $password_reset_url = "http://" . $this->request->host() . "/password_reset/" . $user['NaUser']['password_reset_code'] . " to reset your password";
        $message = "Copy and paste this url in your browser $password_reset_url";
        $email = new CakeEmail(array(
            'log' => $this->config['email_sending'] ? 'false' : 'true'
        ));

        $email->from(array('nanoauth@neseapl.com' => 'NanoAuth'))
            ->to($user['NaUser']['email'])
            ->subject('Password Reset Code')
            ->send($message);

        return true;
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
