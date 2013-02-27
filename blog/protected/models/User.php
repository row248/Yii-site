<?php

class User extends CActiveRecord {

    /**
     * The followings are the available columns in table 'users':
     * @var integer $user_id
     * @var string $login
     * @var string $password
     * @var role
     */

    public $passwordRepeat;

    public function tableName() {
        return 'users';
    }

    public static function model( $className = __CLASS__ ) {
        return parent::model($className);
    }

    public function rules() {
        return array(
            array('login, password', 'required', 'message' => 'Вы забыли заполнить поле'),
            array('login', 'length', 'tooShort' => 'Слишком короткий логин', 'tooLong' => 'Слишком длинный логин', 'min' => 4, 'max' => 30),
            array('login', 'match', 'message' => 'Присутствуют запрещенные символы', 'pattern' => '!^[a-zA-Z0-9]{4,}$!'),
            array('login', 'unique', 'message' => 'Этот логин уже занят'),
            array('password', 'length', 'tooShort' => 'Слишком короткий пароль', 'tooLong' => 'Слишком длинный пароль', 'min' => 5, 'max' => 30),
            array('passwordRepeat', 'compare', 'compareAttribute' => 'password', 'operator' => '==', 'strict' => true, 'message' => 'Пароль не совпадают'),
        );
    }

    public function attributeLabels() {
        return array(
            'login' => 'Логин',
            'password' => 'Пароль',
            'passwordRepeat' => 'Повторите пароль',
        );
    }

    public function hashPassword($password) {
        return $password = md5($password);
    }

    public function autoLogin() {
        $idenity = new UserIdentity($this->login, $this->password);
        var_dump($idenity->authenticate($noPass = true));
        Yii::app()->user->login($idenity);
    }

    public function beforeSave() {
        if ( parent::beforeSave() ) {

            if ( $this->isNewRecord ) {
                $this->password = $this->hashPassword($this->password);
            }

            return true;
        }

        return false;
    }

}