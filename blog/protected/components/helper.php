<?php

class H {
	public static function dump($value) {
		echo '<pre>';
		CVarDumper::dump($value);
		Yii::app()->end();
	}

	public static function csrf() {
		return Yii::app()->request->csrfToken;
	}

	public static function id() {
		return Yii::app()->user->id;
	}

	public static function displaySummary($start, $end, $count, $page, $pages) {
		var_dump($start, $end, $count, $page, $pages);
	}

	public static function regexpSite($site){
		if ( preg_match('!^((wap|http|https)://)?([a-zа-я1-9]+\\.[a-zа-я1-9]+)+(/[a-zа-я1-9]*)?$!u', $site) ) {
			if ( !preg_match('!^(wap|http|https)://!', $site) ) {
				return $site = "<a href='http://$site'>$site</a>";
			}
			$site = "<a href='$site'>$site</a>";
		} else {
			return CHtml::encode($site);
		}

		return $site;
	}

	public static function getEmailLink($email) {
		return "<a href='mailto:$email'>$email</a>";
	}
} 