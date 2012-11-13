<?php
App::uses('NanoAuthAppModel', 'NanoAuth.Model');
App::uses('AuthComponent', 'Controller/Component');
App::uses('DigestAuthenticate', 'Controller/Component/Auth');

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
                'on' => 'create',
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
                'on' => 'create',
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'This already a user using this email address',
            )
		),
    );

    public $belongsTo = array(
        'Group' => array(
            'className' => 'Aro',
            'foreignKey' => 'group_id' 
        )
    );

    public function beforeSave($options = array()) {
        $user = $this->findById($this->id);
        if($user['User']['password'] != $this->data['User']['password']) {
            $this->data['User']['digest_hash'] = DigestAuthenticate::password($this->data['User']['username'], $this->data['User']['password'], env("SERVER_NAME"));
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }
}
