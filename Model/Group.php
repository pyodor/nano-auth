<?php
App::uses('NanoAuthAppModel', 'NanoAuth.Model');
/**
 * Group Model
 *
 */
class Group extends NanoAuthAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
        'name' => array(
            'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Group name must be alphanumeric',
				'allowEmpty' => false,
				'required' => true,
            ),
            'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'This name already used.',
            )
		),
    );
    
    public $actsAs = array('Acl' => array('type' => 'requester'));

    public function parentNode() {
        return null;
    }
    
}
