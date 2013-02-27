<?php

class LoginForm extends CFormModel {

	public $username;
	public $password;
	public $rememberMe;

	private $idenity;

	public function rules() {
		return array(
			array('username, password', 'required', 'message' => 'Заполните поле'),
			array('rememberMe', 'boolean'),
			array('password', 'authenticate'),
		);
	}

	public function attributeLabels() {
		return array(
			'username' => 'Ваш логин',
			'password' => 'Пароль',
			'rememberMe' => 'Запомнить меня',
		);
	}

	public function authenticate($attribute) {
		$this->idenity = new UserIdentity($this->username, $this->password);
		if ( !$this->idenity->authenticate() ) {
			$this->addError('password', 'Неверный логин или пароль');
		}
	}

	public function login() {

		// How idenity can be null? I just copy paste this code fragment from demo blog.
		if ( $this->idenity === null ) {
			$this->idenity = new UserIdentity($this->username, $this->password);
			$this->idenity->authenticate();
		}
		var_dump($this->rememberMe); // 1
		if ( $this->idenity->errorCode === UserIdentity::ERROR_NONE ) {
			$duration = $this->rememberMe ? 3600 * 24 * 30 : 0;
			Yii::app()->user->login($this->idenity, $duration);

			return true;
		} else {

			return false;
		}
	}
}