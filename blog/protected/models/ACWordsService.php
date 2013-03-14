<?php

class ACWordsService extends CActiveRecord {

	/**
	* @string word
	* @string user_id
	*/

	public function tableName() {
        return 'user_words';
    }

    public static function model( $className = __CLASS__ ) {
        return parent::model($className);
    }
}