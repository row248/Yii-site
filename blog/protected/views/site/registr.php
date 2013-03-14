<?php Yii::app()->getClientScript()->registerPackage('main'); ?>
<div class="main">
<?php $form = $this->beginWidget('CActiveForm'); ?>

	<div class="field">
		<?php echo $form->label($model, 'login'); ?>
		<?php echo $form->textField($model, 'login'); ?>
		<?php echo $form->error($model, 'login', array('class' => 'label label-important')); ?>
	</div>

	<div class="field">
		<?php echo $form->label($model, 'password'); ?>
		<?php echo $form->PasswordField($model, 'password'); ?>
		<?php echo $form->error($model, 'password', array('class' => 'label label-important')); ?>
	</div>

	<div class="field">
		<?php echo $form->label($model, 'passwordRepeat'); ?>
		<?php echo $form->PasswordField($model, 'passwordRepeat'); ?>
		<?php echo $form->error($model, 'passwordRepeat', array('class' => 'label label-important')); ?>
	</div>

	<div class="field">
		<?php echo CHtml::submitButton('Зарегистрироваться', array('class' => 'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>


