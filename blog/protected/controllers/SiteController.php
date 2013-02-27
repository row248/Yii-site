<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class SiteController extends Controller
{
	/**
	 * Index action is the default action in a controller.
	 */
	public function actionIndex() {
		$this->render('index');
	}

	public function actionMessage() {

		$model = new Messages;

		if ( isset($_POST['Messages']) ) {
			$model->attributes = $_POST['Messages'];

			if ( $model->validate() ) {
				$model->save();
				Yii::app()->user->setFlash('suc-msg', 'Сообщение успешно отправленно!');
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		$this->render('message',array('model' => $model));
	}

	public function actionRegistr() {

		$model = new User;

		if ( isset($_POST['User']) ) {
			$model->attributes = $_POST['User'];

			if ( $model->validate() ) {
				$model->save();
				$model->autoLogin(); // Auto-login after registration

				Yii::app()->user->setFlash('suc-reg', 'Добро пожаловать!');
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		$this->render('registr', array('model' => $model));
	}

	public function actionLogin() {

		$model = new LoginForm;

		if ( isset($_POST['LoginForm']) ) {
			$model->attributes = $_POST['LoginForm'];

			if ( $model->validate() && $model->login() ) {
				$this->redirect(Yii::app()->user->returnUrl);
				
			}
		}

		$this->render('login', array('model' => $model));
	}

	public function actionLogout() {
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

}