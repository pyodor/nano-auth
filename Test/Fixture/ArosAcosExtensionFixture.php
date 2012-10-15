<?php
/**
 * ArosAcosExtensionFixture
 *
 */
class ArosAcosExtensionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'aros_acos_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'action_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'allow' => array('type' => 'boolean', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'aros_acos_id' => array('column' => array('aros_acos_id', 'action_name', 'allow', 'created', 'updated'), 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'aros_acos_id' => 1,
			'action_name' => 'Lorem ipsum dolor sit amet',
			'allow' => 1,
			'created' => '2012-10-15 15:42:30',
			'updated' => '2012-10-15 15:42:30'
		),
	);

}
