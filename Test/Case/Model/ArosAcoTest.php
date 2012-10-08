<?php
App::uses('ArosAco', 'NanoAuth.Model');

/**
 * ArosAco Test Case
 *
 */
class ArosAcoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.nano_auth.aros_aco'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ArosAco = ClassRegistry::init('NanoAuth.ArosAco');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ArosAco);

		parent::tearDown();
	}

}
