<?php
App::uses('NanoAuthAppController', 'NanoAuth.Controller');
App::uses('CakeEmail', 'Network/Email');
/**
 * Users Controller
 *
 * @property User $User
 */
class PagesController extends NanoAuthAppController {

    public $uses = array('User', 'Aro', 'Aco', 'ArosAco');
/**
 * beforeFilter method
 * @return void
 */
    /*public function beforeFilter() {
        parent::beforeFilter();
        //$this->Acl->allow('Users', 'pages', '*');
    }*/

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
                    return $this->redirect('/login');
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
        debug($this->request->data);
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
        return $this->redirect($this->Auth->logout());
    }

/**
 * login method
 *
 * @return void
 */
    public function login() {
        if($this->Auth->login()) {
            return $this->redirect($this->Auth->loginRedirect);
        }
        else{
            if($this->request->is('post')) {
                $this->Session->setFlash('Your username/password combination was incorrect.');
            }
        }
    }
}
