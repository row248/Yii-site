<?php

class UserIdentity extends CUserIdentity {
	
	protected $_id;

	public function authenticate($noPass = false) {
		//$user = User::model()->find('LOWER(login)=?', array(strtolower($this->username)));
		$user = User::model()->find('login=?', array($this->username));
		if ( $user === null ) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} elseif ( $noPass === false && (md5($this->password) !== $user->password) ) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else {
			$this->_id = $user->user_id;
			$this->errorCode = self::ERROR_NONE;
		}

		return !$this->errorCode;

		/*
		if ( ($user === null) || (md5($this->password) !== $user->password)) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;

		// Как можно обойти копипасту?
		} elseif ( $user !== null && $noPass === true ) { 
			$this->_id = $user->user_id;
			$this->errorCode = self::ERROR_NONE;

		} else {
			$this->_id = $user->user_id;
			$this->errorCode = self::ERROR_NONE;
		}

		return !$this->errorCode;
		*/
	}

	public function getId() {
		return $this->_id;
	}

}