<?php

class Messages extends CActiveRecord {

	/**
	 * The followings are the available columns in table 'messages':
	 * @var string name
	 * @var string email
	 * @var string message
	 * @var string phone
	 * @var string site
	 */

	public $delete;

	public function tableName() {
		return 'messages';
	}

	public static function model( $className = __CLASS__ ) {
        return parent::model($className);
    }

	public function rules() {
		return array(
			array('email, message', 'required', 'message' => 'Обязательное поле'),
			array('email', 'email', 'message' => 'Некорректный емаил'),
			array('phone', 'match', 'pattern' => '!^[0-9()-\\s+]+$!u', 'message' => 'Неверный номер'),
			array('name, phone, site', 'safe'),
			array('delete', 'safe'),
		);
	}

	public function attributeLabels() {
		return array(
			'name' => 'Имя',
			'message' => 'Сообщение',
			'phone' => 'Телефон',
			'site' => 'Сайт',
		);
	}

	public function search() {
		//var_dump(Yii::app()->pagination);
		return new CActiveDataProvider('Messages', array(
			'pagination' => array(
				'pagesize' => 10, 
			),
		));
	}

}


