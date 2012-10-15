<?php
App::uses('ArosAcosExtension', 'NanoAuth.Model');

/**
 * ArosAcosExtension Test Case
 *
 */
class ArosAcosExtensionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.nano_auth.aros_acos_extension',
		'plugin.nano_auth.aros_acos'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ArosAcosExtension = ClassRegistry::init('NanoAuth.ArosAcosExtension');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ArosAcosExtension);

		parent::tearDown();
	}

}
