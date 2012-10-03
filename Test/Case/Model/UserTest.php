<?php
App::uses('User', 'NanoAuth.Model');
App::uses('AuthComponent', 'Controller.Component');

/**
/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.nano_auth.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('NanoAuth.User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

    public function testUsernameAndEmailMustbeUnique() {
        $user = array('User' => array('username' => 'user1', 'password' => 'user1pass', 'email' => 'user1@dot.com')); // this user already existed on the fixtures
        $this->User->create();
        $user2 = $this->User->save($user); // so this should fail
        $this->assertFalse($user2); // is it?
        $this->assertArrayHasKey('username', $this->User->validationErrors); // so an error of username occurs
        $this->assertArrayHasKey('email', $this->User->validationErrors); // so thus the emai

    }

    public function testPasswordMustBeEncrypted() {
        $user1 = $this->User->find('first', array('username' => 'user1'));
        //debug(AuthComponent::password(($user1['User']['password'])));die;
    }
}
