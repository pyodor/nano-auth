<?php
App::uses('NanoAuthAppModel', 'NanoAuth.Model');
App::uses('AuthComponent', 'Controller/Component');

/**
 * User Model
 *
 */
class User extends NanoAuthAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Required',
				'allowEmpty' => false,
				'required' => true,
            ),
            'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'This username already used.',
            )
		),
		'password' => array(
			'alphanumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Required',
				'allowEmpty' => false,
				'required' => true,
            ),
            'minLength' => array(
                'rule' => array('minLength', 8),
                'message' => 'Password must be 8 characters minimum length',
            )
		),
		'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Must be an email format (i.e. user@domain.tld)',
                'allowEmpty' => false,
                'required' => true,
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'This already a user using this email address',
            )
		),
    );

    public function beforeSave($options = array()) {
        $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        return true;
    }
}
