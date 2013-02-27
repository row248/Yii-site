<?php

class PostController extends Controller {

	private $model;

	public function actionViewMessages() {
		if ( Yii::app()->user->checkAccess('administrator') ) {

			$model = new Messages('search');

			if ( isset($_GET['Messages']) ) {
				$model->attribute = $_GET['Messages'];
			}

			//$messages = Messages::model()->findAllBySql('SELECT * FROM messages');
			$this->render('allMessages', array('model' => $model));
			//var_dump($messages);

		} else {
			header("HTTP/1.0 404 Not Found");
		}
	}

	public function actionAjaxDelete() {
		if ( Yii::app()->request->isAjaxRequest ) {

			if ( isset($_POST['id']) ) {
				$this->loadModel()->delete();
				Yii::app()->end();
			} 
		}

		if ( !isset($_POST['ajax']) ) {
			$this->redirect(array('viewMessages'));
		}
	}

	public function loadModel() {
		return $this->model = Messages::model()->findByPk($_POST['id']);

	}
}