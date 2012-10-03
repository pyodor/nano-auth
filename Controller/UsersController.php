<?php
App::uses('NanoAuthAppController', 'NanoAuth.Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends NanoAuthAppController {
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
            $user = $this->User->findByPasswordResetCode($this->request->data['User']['code']);
            if($this->request->data['User']['password'] != $this->request->data['User']['password_confirmation']) {
                $this->Session->setFlash("Password doesn't match");
            }
            else {
                $this->User->read(null, $user['User']['id']);
                $this->User->set('password', $this->request->data['User']['password']);
                $this->User->set('password_reset_code', '');
                if($this->User->save()) {
                    $this->Session->setFlash('Password reset successfull, you may now login');
                    $this->redirect('/login');
                }
                else {
                    $this->Session->setFlash('Error resetting your password');
                }
            }
        }
        else {
            $user = $this->User->findByPasswordResetCode($code);
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
            $user = $this->User->findByEmail($this->request->data['User']['email']);
            if(!$user) {
                $this->Session->setFlash('Email address not found');
            }
            else {
                $reset_code = Security::hash($this->request->data['User']['email']);
                $this->User->read(null, $user['User']['id']);
                $this->User->set('password_reset_code', $reset_code);
                $this->User->save();
                $user = $this->User->read(null, $user['User']['id']);
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
        if(empty($user['User']['password_reset_code'])) return false;
        
        $password_reset_url = "http://" . $this->request->host() . "/password_reset/" . $user['User']['password_reset_code'] . " to reset your password";
        $message = "Copy and paste this url in your browser $password_reset_url";
        $email = new CakeEmail(array(
            'log' => $this->config['email_sending'] ? 'false' : 'true'
        ));

        $email->from(array('nanoauth@neseapl.com' => 'NanoAuth'))
            ->to($user['User']['email'])
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
		$this->User->recursive = 0;
		$this->set('Users', $this->paginate());
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
			throw new NotFoundException(__('Invalid na user'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid na user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The na user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The na user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid na user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('Na user deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Na user was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
