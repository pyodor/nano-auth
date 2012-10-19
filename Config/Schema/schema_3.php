<?php 
class NanoAuthSchema extends CakeSchema {

	public $file = 'schema_3.php';

    public function before($event = array()) {
        $db = ConnectionManager::getDataSource($this->connection);
        $db->cacheSources = false;
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
                        'email' => 'admin@somedomain.com',
                        'group_id' => 1, // refer to aros (group)
                    )
                ));
                $user->create();
                $user->save(array(
                    'User' => array(
                        'username' => 'user',
                        'password' => '6b4cb673c52476fbc8ab5fa44fa95446bb1a8fc9', // user12345
                        'email' => 'user@somedomain.com',
                        'group_id' => 2, // this refers to aros id 2
                    )
                ));
                break;
            case 'aros':
                $aro = ClassRegistry::init('Aro');
                $aro->create();
                $aro->save(array(
                    'Aro' => array(
                        'alias' => 'Administrator',
                    )
                ));
                $aro->create();
                $aro->save(array(
                    'Aro' => array(
                        'alias' => 'User',
                    )
                ));
                break;
            case 'acos':
                $aco = ClassRegistry::init('Aco');
                $aco->create();
                $aco->save(array(
                    'Aco' => array(
                        'alias' => 'users',
                    )
                ));
                $aco->create();
                $aco->save(array(
                    'Aco' => array(
                        'alias' => 'aros',
                    )
                ));
                $aco->create();
                $aco->save(array(
                    'Aco' => array(
                        'alias' => 'acos',
                    )
                ));
                $aco->create();
                $aco->save(array(
                    'Aco' => array(
                        'alias' => 'aros_acos',
                    )
                ));
                break;
            case 'aros_acos':
                $aros_acos = ClassRegistry::init('ArosAco');
                $aros_acos->create();
                $aros_acos->save(array(
                    'ArosAco' => array(
                        'aro_id' => 1,
                        'aco_id' => 1,
                        '_create' => 1,
                        '_read' => 1,
                        '_update' => 1,
                        '_delete' => 1,
                    )
                ));
                $aros_acos->create();
                $aros_acos->save(array(
                    'ArosAco' => array(
                        'aro_id' => 1,
                        'aco_id' => 2,
                        '_create' => 1,
                        '_read' => 1,
                        '_update' => 1,
                        '_delete' => 1,
                    )
                ));
                $aros_acos->create();
                $aros_acos->save(array(
                    'ArosAco' => array(
                        'aro_id' => 1,
                        'aco_id' => 3,
                        '_create' => 1,
                        '_read' => 1,
                        '_update' => 1,
                        '_delete' => 1,
                    )
                ));
                $aros_acos->create();
                $aros_acos->save(array(
                    'ArosAco' => array(
                        'aro_id' => 1,
                        'aco_id' => 4,
                        '_create' => 1,
                        '_read' => 1,
                        '_update' => 1,
                        '_delete' => 1,
                    )
                ));



                $aros_acos->create();
                $aros_acos->save(array(
                    'ArosAco' => array(
                        'aro_id' => 2,
                        'aco_id' => 1,
                        '_create' => 0,
                        '_read' => 0,
                        '_update' => 0,
                        '_delete' => 0,
                    )
                ));
                break;

            /*
            case 'aros_acos_extensions':
                $aros_acos_ext = ClassRegistry::init('ArosAcosExtension');
                $aros_acos_ext->create();
                $aros_acos_ext->save(array(
                    'ArosAcosExtension' => array(
                        'aros_acos_id' => 5,
                        'action_name' => 'login',
                    )
                ));
                $aros_acos_ext->create();
                $aros_acos_ext->save(array(
                    'ArosAcosExtension' => array(
                        'aros_acos_id' => 5,
                        'action_name' => 'logout',
                    )
                ));
                $aros_acos_ext->create();
                $aros_acos_ext->save(array(
                    'ArosAcosExtension' => array(
                        'aros_acos_id' => 1,
                        'action_name' => 'logout',
                    )
                ));
                break;*/
            }
        }
    }

	public $acos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'model' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'alias' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
	public $aros = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'model' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'alias' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
	public $aros_acos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'aro_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'aco_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'_create' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'_read' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'_update' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'_delete' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'ARO_ACO_KEY' => array('column' => array('aro_id', 'aco_id'), 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
	public $aros_acos_extensions = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'aros_acos_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'action_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'aros_acos_id' => array('column' => array('aros_acos_id', 'action_name', 'created', 'updated'), 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
    
    public $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'password_reset_code' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'username' => array('column' => array('username', 'email'), 'unique' => 1),
			'password' => array('column' => array('password', 'password_reset_code', 'group_id', 'created', 'updated'), 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);
}
