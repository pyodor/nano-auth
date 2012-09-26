<?php
App::uses('NaUser', 'NanoAuth.Model');

/**
 * NaUser Test Case
 *
 */
class NaUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.nano_auth.na_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->NaUser = ClassRegistry::init('NanoAuth.NaUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NaUser);

		parent::tearDown();
	}

}
