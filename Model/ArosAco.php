<?php
App::uses('NanoAuthAppModel', 'NanoAuth.Model');
/**
 * ArosAco Model
 *
 */
class ArosAco extends NanoAuthAppModel {
    public $hasMany = array(
		'ActionExtensions' => array(
			'className' => 'ArosAcosExtension',
			'foreignKey' => 'aros_acos_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
