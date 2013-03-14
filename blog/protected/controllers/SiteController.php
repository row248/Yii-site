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

	public function actionUploadSrt() {
		$model = new Srt;
		if ( isset($_POST['Srt']) ) {
			$model->attributes = $_POST['Srt'];
			$model->srt = CUploadedFile::getInstance($model, 'srt');

			if ( $model->validate() ) {
				$model->srt->saveAs('userFiles/srt/' . $model->srt->name . Yii::app()->user->id);

				$model->subtitle_filename = $model->srt->name;
				$model->user_id = Yii::app()->user->id;
				$model->save();

				Yii::app()->user->setFlash('suc-upload', 'Файл успешно загружен. Теперь вы можете просмотреть найденые слова.');
				$this->redirect(Yii::app()->homeUrl);
			} 
		} 

		$this->render('uploadSrt', array('model' => $model));
	}

	public function actionSelectSrt() {
		if ( !Yii::app()->user->isGuest ) {
			$model = new Srt;

			$this->render('showSrt', array('model' => $model)); 
		}
	}

	public function actionChoiseSubtitle() {
		$model = new Srt;
		if ( Yii::app()->request->isAjaxRequest ) {

			if ( isset($_POST['id']) ) {
				
				// Return all "current_subtitle" to zero (default)
				$returnToZero = Srt::model()->findAllByAttributes(array('current_subtitle' => '1', 'user_id' => Yii::app()->user->id));
				foreach ( $returnToZero as $item ) {
					$item->current_subtitle = "0";
					$item->update();
				}

				// Update $_POST['id'] to value "1"
				$update = Srt::model()->findByPk($_POST['id']);
				$update->current_subtitle = "1";
				$update->update();

				Yii::app()->end();
			} 
		}

		if ( !isset($_POST['ajax']) ) {
			$this->redirect(array('uploadSrt'));
		}
	}

	public function actionAjaxDelete() {
		$model = new Srt;
		if ( Yii::app()->request->isAjaxRequest ) {

			if ( isset($_POST['id']) ) {

				$array = $this->loadModel();
				foreach ( $array as $item ) {

					if ($item->delete()) {
						$model->deleteFile(Yii::app()->basePath . '/../' . PATH_TO_SRT . $item->subtitle_filename . Yii::app()->user->id);
					}
				}

				Yii::app()->end();
			} 
		}

		if ( !isset($_POST['ajax']) ) {
			$this->redirect(array('uploadSrt'));
		}
	}

	public function loadModel() {
		return Srt::model()->findAllByPk($_POST['id']);
	}

}