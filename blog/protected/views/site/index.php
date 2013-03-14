<?php Yii::app()->getClientScript()->registerPackage('main'); ?>
<div class="success-msg">
	<?php if ( Yii::app()->user->hasFlash('suc-msg')): ?>
		<?php echo Yii::app()->user->getFlash('suc-msg'); ?>
	<?php endif; ?>

	<?php if ( Yii::app()->user->hasFlash('suc-reg')): ?>
			<?php echo Yii::app()->user->getFlash('suc-reg'); ?>
	<?php endif; ?>

	<?php if ( Yii::app()->user->hasFlash('suc-upload')): ?>
		<?php echo Yii::app()->user->getFlash('suc-upload'); ?>
	<?php endif; ?>
</div>

<?php if ( !Yii::app()->user->isGuest ): ?>
	<div class="user-name">
		Привет, <span class="bold"> <?php echo Yii::app()->user->name; ?> </span>
	</div>
<?php endif; ?>

<?php if ( !Yii::app()->user->isGuest ): ?>
<div class="user-menu">

	<?php

		if ( !Yii::app()->user->isGuest ) {
			$this->widget('zii.widgets.CMenu', array(
				'items' => array(
					array('label' => 'Смотреть слова', 'url' => array('words/openWords')),
					array('label' => 'Мой профиль', 'url' => array('profileWords/openProfile')),
					array('label' => 'Выбрать субтитры', 'url' => array('site/selectSrt'))
				),
			));

			echo CHtml::link('Загрузить субтитры', array('site/uploadSrt'), array('id' => 'upload-srt-link'));
		}

	?>

</div>
<?php endif; ?>