<?php
App::uses('User', 'NanoAuth.Model');
App::uses('AuthComponent', 'Controller/Component');

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

    public function testUsernamePasswordEmailAreRequired() {
        $user = array('User' => array('username' => '', 'password' => '', 'email' => '')); // fields here were left blank
        $this->User->create();
        $user = $this->User->save($user); // so this should fail
        // and validationErrors were not empty and contains the erroneus fields
        $this->assertArrayHasKey('username', $this->User->validationErrors); 
        $this->assertArrayHasKey('password', $this->User->validationErrors); 
        $this->assertArrayHasKey('email', $this->User->validationErrors);

        $user = array('User' => array('username' => 'user5', 'password' => 'user5pass', 'email' => 'user5@dot.com')); // fields were filled
        $this->User->create();
        $user = $this->User->save($user); // so this should be fine
        $this->assertEmpty($this->User->validationErrors); // so validationErrors is empty
    }

    public function testUsernameAndEmailMustbeUnique() {
        $user = array('User' => array('username' => 'user1', 'password' => 'user1pass', 'email' => 'user1@dot.com')); // this user already existed on the fixtures
        $this->User->create();
        $user2 = $this->User->save($user); // so this should fail
        $this->assertFalse($user2); // is it?
        $this->assertArrayHasKey('username', $this->User->validationErrors); // so an error of username occurs
        $this->assertArrayHasKey('email', $this->User->validationErrors); // so thus the emai

    }
    
    public function testPasswordMinimumLengthIs8() {
        $user = array('User' => array('username' => 'user4', 'password' => 'pass', 'email' => 'user4@dot.com')); // password length here is 4 characters
        $this->User->create();
        $user4 = $this->User->save($user); // so this should fail
        $this->assertArrayHasKey('password', $this->User->validationErrors); // and validationErrors is not empty and contains password key
        
        $user = array('User' => array('username' => 'user4', 'password' => 'pass12345', 'email' => 'user4@dot.com')); // password length here is 9 characters
        $this->User->create();
        $user4 = $this->User->save($user); // so this should be fine
        $this->assertEquals('user4', $user4['User']['username']); 
    }

    public function testPasswordMustBeEncrypted() {
        $user1 = $this->User->findByUsername('user1');
        $user2 = $this->User->findByUsername('user2');
        $user3 = $this->User->findByUsername('user3');
        $this->assertEquals($user1['User']['password'], AuthComponent::password('user1pass'));
        $this->assertEquals($user2['User']['password'], AuthComponent::password('user2pass'));
        $this->assertEquals($user3['User']['password'], AuthComponent::password('user3pass'));
    }

    
}
