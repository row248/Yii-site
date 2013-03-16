<?php

class WordsController extends Controller {

	public function actionOpenWords() {
		$model = new WordsService;
		$model->reset();
		$this->redirect(array('showWords'));
	}

	public function actionShowWords() {
		if ( !Yii::app()->user->isGuest ) {

			$model = new WordsService;
			$model->init();

			$this->render('showWords', array('model' => $model, 'srt' => $model->srt));
		}
	}

    public function actionDeleteWord() {
        $word = ACWordsService::model()->deleteAllByAttributes(
                        array('word' => $_POST['word'],
                            'user_id' => id()
                        )
                );

        $this->actionShowWords();
    }

    public function actionAddWord() {
    	$word = new ACWordsService;
    	$word->word = $_POST['word'];
    	$word->user_id = Yii::app()->user->id;
    	$word->save();

    	$this->actionShowWords();
    }

	public function actionNextWord() {
		$model = new WordsService;
		$model->init();
		$model->nextWord();

		$this->actionShowWords();
	}


	public function actionPreviousWord() {
		$model = new WordsService;
		$model->init();
		$model->previousWord();

		$this->actionShowWords();
	}

	public function actionRandomWords() {
		$model = new WordsService;
		$model->init();
		$model->randomWords();

		$this->redirect(array('showWords'));
	}

	public function actionMostRare() {
		$model = new WordsService;
		$model->init();
		$model->mostRareWords();

		$this->redirect(array('showWords'));
	}

	public function actionMostOften() {
		$model = new WordsService;
		$model->init();
		$model->mostOftenWords();

		$this->redirect(array('showWords'));
	}

	public function actionMatchWithDb() {
		$model = new WordsService;
		$model->init();
		$model->matchWithDb();

		$this->redirect(array('showWords'));
	}

	public function actionRandomMatchDb() {
		$model = new WordsService;
		$model->init();
		$model->randomMatchDb();

		$this->redirect(array('showWords'));
	}
}