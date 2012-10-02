<?php 
App::uses('User', 'Model');
class NanoAuthSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

    public function after($event = array()) {
        if (isset($event['create'])) {
            switch ($event['create']) {
            case 'users':
                $user = ClassRegistry::init('User');
                $user->create();
                $user->save(array(
                    'User' => array(
                        'username' => 'admin',
                        'password' => 'f03a008f086621ee18f276afeb3e6eae0e90bd68', // admin123
                        'email' => 'dado@neseapl.com',
                    )
                ));
                break;
            }
        }
	}

	public $users = array(
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
			'password_crypt' => array('column' => array('password', 'created', 'updated'), 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
}
