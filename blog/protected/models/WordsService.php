<?php

class WordsService {

	// File with subtitle
	public $srt; // Clear file name, without id
	public $words;
	public $fileName;
	public $number;
	public $storeName = "number";
	public $countWords;
	public $currentWord;
    // Delete or add current word
	public $action;


	/**
	 * Return array with words
	 */
	private function searchWords( $srt, $upFirstLetter = false ) {
        $srt = PATH_TO_SRT . $srt;
		$file = file_get_contents($srt);

		if ( !$file ) {
			throw new Exception("Don't finded file in server");
		}

		$array = array();

		if ( $upFirstLetter === true ) {
			preg_match_all('![a-zA-Z]{4,}!', $file, $array);
		} else {
			preg_match_all('!(\b[^A-Z][a-z]{4,})!', $file, $array);
		}

		$result = array_count_values($array[0]);
        arsort($result);
        $result = array_keys($result);

        $result = array_map('trim', $result); // delete space

        return $result;
	}

	/**
	 * Increment key in array at $increment value
	 */
	private function incrementKeyInArray( array $array, $increment = 1 ) {
		$result = array();
        $key = $increment;
        foreach ( $array as $value ) {
        	$result[$key] = $value;
        	$key++;
        }

        return $result;
	}

	private function saveWords( array $words, $fileName ) {
		$words = serialize($words);
		$success = file_put_contents($fileName, $words);

		if ( !$success ) {
			throw new Exception("Can not save file: $fileName");
		}

		return $success;
	}

	/**
	 * Read and take $path from server
	 * @return array with words
	 */
	private function takeWords( $path ) {
		$words = file_get_contents($path);

		if ( !$words ) {
			throw new Exception("Can not read file: $path");		
		}

		$words = unserialize($words);

		return $words;
	}

	/**
	 * Return shuffle array
	 */
	private function shuffleArray( array $words ) {
		for ( $i = 0; $i < 10; $i++ ) {
			shuffle($words);
		}

		return $words;
	}

	/**
	 * Add or takes value from $storeName
	 */
	private function syncWithStore( $storeName, &$number,  $method ) {
		if ( !isset($_COOKIE[$storeName]) ) {
			if ( isset($_SESSION[$storeName]) ) {
				setcookie($storeName, $_SESSION[$storeName], strtotime( '+30days' ));
			} else {
				$number = 1;
				setcookie($storeName, $number, strtotime( '+30days' ));
				Yii::app()->session[$storeName] = 1;
			}
		}

		if ( !isset($_SESSION[$storeName]) ) {
			Yii::app()->session[$storeName] = $_COOKIE[$storeName];
		}

		if ( $method == '+' ) {
			$number++;
			setcookie($storeName, $number, strtotime( '+30 days' ));
			Yii::app()->session[$storeName] = $number;
		} elseif ( $method == '-' ) {
			$number--;
			setcookie($storeName, $number, strtotime( '+30 days' ));
			Yii::app()->session[$storeName] = $number;
		} elseif ( $method == 'reset' ) {
			$number = 1;
			setcookie($storeName, $number, strtotime( '+30 days' ));
			Yii::app()->session[$storeName] = $number;
		} elseif ( $method == 'delete' ) {
			setcookie($storeName, '', strtotime( '-30 days' ));
			unset(Yii::app()->session[$storeName]);
		} elseif ( $method == 'sync' ) {
			$number = $_SESSION[$storeName];
		} else {
            throw new Exception("Invalid method: $method");            
        }
	}

	private function checkAtTrueNumber(&$number, $maxValue, $minValue) {
        // Just in case, max 2 iteration
        for ( $i = 1; $i < 1000; $i++ ) {
            if ( $number < $minValue ) {
                $this->syncWithStore( $this->storeName, $number, '+');
            } elseif ( $number > $maxValue ) {
                $this->syncWithStore( $this->storeName, $number, '-');
            } else {
                break;
            }
        }

	}

	/**
	 * If use already have $word @return true
	 * else @return false
	 */
    private function checkMatchWord($word) {
        $match = ACWordsService::model()->findAll('user_id=:user_id', array(':user_id' => Yii::app()->user->id));
        foreach ( $match as $item ) {
            if ( $item->word === $word ) {
                return true;
            } 
        }

        return false;
    }

    private function findWordsFromDb() {
        $words = ACWordsService::model()->findAllByAttributes(array('user_id' => Yii::app()->user->id));
        $wordsArray = array();

        foreach ( $words as $object ) {
            $wordsArray[] = $object->word;
        }

        return $wordsArray;  	
    }

    private function getUserFileName() {
        $model = new WordsService;
        $select = Srt::model()->findByAttributes(array('current_subtitle' => '1', 'user_id' => Yii::app()->user->id));
        $srt = $select->subtitle_filename;
        return $srt;
    }

    public function createFileFromDb($fileName) {
        $words = $this->findWordsFromDb();
        $words = $this->incrementKeyInArray($words);
        $this->saveWords($words, $fileName);
    }

    private function initWorkWithDb($fileName, &$number, $storeName) {
    	if ( !file_exists($fileName) ) {
            $this->createFileFromDb($fileName);
            $this->syncWithStore($storeName, $number, 'reset');
        } else {
            $this->syncWithStore($storeName, $number, 'sync');
        }

        $this->words = $this->takeWords($fileName);
        $this->countWords = count($this->words);
        // We can delete last word and it will be error with "Undefined offset"
        $this->checkAtTrueNumber($this->number, $this->countWords, 1);
        $this->currentWord = $this->words[$this->number];
    }

    /**
     * $fileName = what a file we will be check
     */
    private function initWorkWithFile($fileName, &$number, $storeName) {
    	if ( !file_exists($fileName) ) {
    		$words = $this->searchWords( $this->srt . id() );
    		$words = $this->incrementKeyInArray($words);
    		$this->saveWords($words, $fileName);
    		$this->syncWithStore($storeName, $number, 'reset');
    	} else {
    		$this->syncWithStore($storeName, $number, 'sync');
    	}

    	$this->words = $this->takeWords($fileName);
    	$this->countWords = count($this->words);
    	$this->currentWord = $this->words[$number];
    }

    /**
     * Replace spaces from $fileName and 
     * add user_id in $fileName
     */
    private function changeFileName($fileName, $path) {
    	if ( $path == 'db') {
    		$path = PATH_TO_FILES_FROM_DB;
    	} elseif ( $path == 'file' ) {
    		$path = PATH_TO_WORDS;
    	} else {
    		throw new Exception("Invalid path for file: $path");
    	}

    	return $path . $fileName;
    }

    public function reset() {
    	$this->syncWithStore($this->storeName, $this->number, 'reset');
    }

    public function initDb() {
        $this->srt = $this->getUserFileName();
    	$this->fileName = $this->changeFileName($this->srt . id(), 'db');
    	$this->initWorkWithDb($this->fileName, $this->number, $this->storeName);
    }

    public function init() {
        $this->srt = $this->getUserFileName();
    	$this->fileName = $this->changeFileName($this->srt . id(), 'file');
    	$this->initWorkWithFile($this->fileName, $this->number, $this->storeName);

    	$this->action = $this->checkMatchWord($this->currentWord);
    }



    public function nextWord() {
    	$this->syncWithStore($this->storeName, $this->number, '+');
    	$this->checkAtTrueNumber($this->number, $this->countWords, 1);
    }

    public function previousWord() {
    	$this->syncWithStore($this->storeName, $this->number, '-');
    	$this->checkAtTrueNumber($this->number, $this->countWords, 1);
    }


    public function randomWords($search = true) {
        if ( $search ) {
            $this->words = $this->searchWords($this->srt . id());
        }
    	$this->words = $this->shuffleArray($this->words);
    	$this->words = $this->incrementKeyInArray($this->words);
    	$this->saveWords($this->words, $this->fileName);
    	$this->syncWithStore($this->storeName, $this->number, 'reset');
    }

    public function mostRareWords() {
    	$this->words = $this->searchWords($this->srt . id());
    	$this->words = array_reverse($this->words);
    	$this->words = $this->incrementKeyInArray($this->words);
    	$this->saveWords($this->words, $this->fileName);
    	$this->syncWithStore($this->storeName, $this->number, 'reset');
    }

    public function mostOftenWords() {
    	$this->words = $this->searchWords($this->srt . id());
    	$this->words = $this->incrementKeyInArray($this->words);
    	$this->saveWords($this->words, $this->fileName);
    	$this->syncWithStore($this->storeName, $this->number, 'reset');
    }

    /**
     * Find words which match with user db
     */
    public function matchWithDb() {
        $match = ACWordsService::model()->findAllByAttributes(
                array('word' => $this->words, 'user_id' => id()));
        
        $result = array();
        foreach ( $match as $item ) {
            $result[] = $item->word;
        }

        $this->words = $result;
        $this->words = $this->incrementKeyInArray($this->words);
        $this->saveWords($this->words, $this->fileName);
        $this->syncWithStore($this->storeName, $this->number, 'reset');
    }

    public function randomMatchDb() {
        $this->matchWithDb();
        $this->words = $this->shuffleArray($this->words);
        $this->words = $this->incrementKeyInArray($this->words);
        $this->saveWords($this->words, $this->fileName);
        $this->syncWithStore($this->storeName, $this->number, 'reset');
    }

}