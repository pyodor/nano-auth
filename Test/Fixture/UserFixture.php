<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
    public $fields = array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'password_reset_code' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'username' => array('column' => array('username', 'email'), 'unique' => 1),
			'password' => array('column' => array('password', 'created', 'updated'), 'unique' => 0)
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
			'username' => 'user1',
			'password' => 'user1pass',
			'email' => 'user1@dot.com',
			'created' => '2012-10-03 03:36',
			'updated' => '2012-10-03 03:36'
        ),
        array(
			'id' => 2,
			'username' => 'user2',
			'password' => 'user2pass',
			'email' => 'user2@dot.com',
			'created' => '2012-10-03 03:36',
			'updated' => '2012-10-03 03:36'
        ),
        array(
			'id' => 3,
			'username' => 'user3',
			'password' => 'user3pass',
			'email' => 'user3@dot.com',
			'created' => '2012-10-03 03:36',
			'updated' => '2012-10-03 03:36'
        ),
        
	);

}
