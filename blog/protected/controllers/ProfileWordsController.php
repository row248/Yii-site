<?php

class ProfileWordsController extends Controller {

	public function actionOpenProfile() {
		$model = new WordsService;
		$model->initDb();
		$model->createFileFromDb($model->fileName);
		$model->reset();

		$this->redirect(array('showProfile'));
	}

	public function actionShowProfile() {
		if ( !Yii::app()->user->isGuest ) {

			$model = new WordsService;
			$model->initDb();

			$this->render('profileWords', array('model' => $model));
		}
	}

    public function actionDeleteWord() {
        $word = ACWordsService::model()->deleteAllByAttributes(
                        array('word' => $_POST['word'],
                            'user_id' => Yii::app()->user->id
                        )
                );
        $model = new WordsService;
        $model->initDb();
        $model->createFileFromDb($model->fileName);

        $this->actionShowProfile();
    }

    public function actionRandomWords() {
    	$model = new WordsService;
    	$model->initDb();
    	$model->randomWords(false);

    	$this->actionShowProfile();
    }

	public function actionNextWord() {
		$model = new WordsService;
		$model->initDb();
		$model->nextWord();

		$this->actionShowProfile();
	}

	public function actionPreviousWord() {
		$model = new WordsService;
		$model->initDb();
		$model->previousWord();

		$this->actionShowProfile();
	}
}