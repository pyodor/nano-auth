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
        $this->mockLoggedUser(); // logged a user   
        $this->testAction('/users'); // access login required resource
        $this->assertArrayHasKey('Users', $this->vars);
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
        $this->mockLoggedUser(); // logged a user   
        // viewing existing user
        $this->testAction('/users/view/1');
        $this->assertEquals(1, $this->vars['User']['User']['id']);

        // viewing non-existing user
        try {
            $this->testAction('/users/view/999');
        }
        catch(Exception $ex) {
            $this->assertInstanceOf('NotFoundException', $ex);
        }
	}

/**
 * testAdd method
 *
 * @return void
 */
    public function testAdd() {
        $this->mockLoggedUser(); // logged a user   
        // data can be saved
        $data = array(
            'User' => array(
                'username' => 'user6',
                'password' => 'user6pass',
                'email' => 'user6@dot.com'
            )
        );
        $this->testAction('/users/add', array('data' => $data));
        $this->assertStringEndsWith('/users', $this->headers['Location']); // should redirect users list after saving 
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

    public function testForgotPassword() {
        // with existing email address
        $data = array(
            'User' => array(
                'email' => 'user1@dot.com'
            )
        );
        $this->testAction('/forgot_password', array('data' => $data));
        
        // with non-existing email address
        $data = array(
            'User' => array(
                'email' => 'user1@dotdot.com'
            )
        );
        $this->testAction('/forgot_password', array('data' => $data));
    }
}
