<?php

function dump($value) {
	echo '<pre>';
	CVarDumper::dump($value);
	Yii::app()->end();
}

function csrf() {
	return Yii::app()->request->csrfToken;
}

function id() {
	return Yii::app()->user->id;
} 