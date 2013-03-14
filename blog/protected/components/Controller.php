<?php

class Controller extends CController {

    public $layout = 'main';

    public $menu = array();

    public $breadcrumbs=array();

    public function myRegisterCssFile($path, $file) {
    	Yii::app()->clientScript->registerCssFile(
		    Yii::app()->assetManager->publish(
		        Yii::getPathOfAlias($path) . $file
		    )
		);
    }

    public function myRegisterJsFile($path, $file) {
		Yii::app()->clientScript->registerScriptFile(
		    Yii::app()->assetManager->publish(
		        Yii::getPathOfAlias($path) . $file
		    ),
		    CClientScript::POS_END
		);
    }

    public function myRegisterImageFile($path, $file) {
		$url = Yii::app()->assetManager->publish(
		    Yii::getPathOfAlias($path) . $file
		);
		return CHtml::image($url);
    }
}