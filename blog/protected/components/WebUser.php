<?php

class WebUser extends CWebUser {

	private $model = null;

	function getRole() {
		if ( $user = $this->getModel() ) {
			return $user->role;
		}
	}

	private function getModel() {
		if ( !$this->isGuest && $this->model === null ) {
			$this->model = User::model()->findByPk($this->id, array('select' => 'role'));
		}

		return $this->model;
	}
}