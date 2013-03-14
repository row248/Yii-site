<?php

class Srt extends CActiveRecord {
	public $srt;

	public function tableName() {
		return 'user_date';
	}

	public static function model( $className = __CLASS__ ) {
        return parent::model($className);
    }

	public function rules() {
		return array(
			array('srt', 'required', 'message' => 'Выберите файл'),
			array('srt', 'file', 'types' => 'srt', 'maxSize' => 1048576, 'wrongType' => 'Можно загружать только файлы в формате .srt', 'tooLarge' => 'Макс. размер файла 1мб')
		);
	}

	public function attributeLabels() {
		return array(
			'srt' => 'Субтитры'
		);
	}

	public function searchSrt() {
		return new CActiveDataProvider('Srt', array(
			'pagination' => array(
				'pagesize' => 15
			),
		));
	}

	public function deleteFile($path) {
		unlink($path);

		return true;
	}
}