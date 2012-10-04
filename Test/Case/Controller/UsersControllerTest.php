<?php
App::uses('UsersController', 'NanoAuth.Controller');

/**
 * UsersController Test Case
 *
 */
class UsersControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.nano_auth.user'
	);

/**
 * testIndex method
 *
 * @return void
 */
    public function testIndex() {
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
	}

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
	}
    
    public function testLoginRequired() {
        $this->testAction('/users'); // access login required resource
        $this->assertStringEndsWith('/login', $this->headers['Location']); // should redirect to login  
	}

    private function mockLoggedUser() {
        // mock user
        $Users = $this->generate('NanoAuth.Users', array(
            'components' => array(
                'Auth' => array('user'),
            )
        ));
        // AuthComponent::user('id') must be available
        $Users->Auth->staticExpects($this->any())
            ->method('user')
            ->with('id')
            ->will($this->returnValue(2));

        return $Users;
    }

    public function testAccessResourceUserIsLoggedIn() {
        $this->mockLoggedUser(); // logged a user   
        $this->testAction('/users'); // access login required resource
        $this->assertFalse(isset($this->headers['Location'])); // no redirection to /login  
    }

    public function testResourceNoAuthenticationRequired() {
        $Users = $this->mockLoggedUser();
        $this->testAction('/users'); // access login required resource
        $expected = array(
            'forgot_password',
            'password_reset'
        );
        $this->assertEquals($expected, $Users->Auth->allowedActions);
    }
}
