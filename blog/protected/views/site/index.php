<?php if ( Yii::app()->user->hasFlash('suc-msg')): ?>
	<div class="success-msg">
		<?php echo Yii::app()->user->getFlash('suc-msg'); ?>
	</div>
<?php endif; ?>

<?php if ( Yii::app()->user->hasFlash('suc-reg')): ?>
	<div class="success-msg">
		<?php echo Yii::app()->user->getFlash('suc-reg'); ?>
	</div>
<?php endif; ?>

<?php if ( !Yii::app()->user->isGuest ): ?>
	<div class="user-name">
		Привет, <span class="bold"> <?php echo Yii::app()->user->name; ?> </span>
	</div>
<?php endif; ?>

<?php if ( !Yii::app()->user->isGuest ): ?>
<div class="user-menu">

	<ul>
		<li><a href="#">Мой профиль</a></li>
		<li><a href="#">Смотреть слова</a></li>
	<ul>

</div>
<?php endif; ?>