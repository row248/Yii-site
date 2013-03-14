<?php Yii::app()->getClientScript()->registerPackage('main'); ?>
<div class="main">
<?php $form = $this->beginWidget('CActiveForm'); ?>

<div class="field">
	<?php echo $form->label($model, 'username'); ?>
	<?php echo $form->textField($model, 'username');?>
	<?php echo $form->error($model, 'username', array('class' => 'label label-important')); ?>
</div>

<div class="field">
	<?php echo $form->label($model, 'password'); ?>
	<?php echo $form->passwordField($model, 'password');?>
	<?php echo $form->error($model, 'password', array('class' => 'label label-important')); ?>
</div>

<div class="field rememberMe">
	<?php echo $form->checkBox($model, 'rememberMe'); ?>
	<?php echo $form->label($model, 'rememberMe', array('class' => 'rememberMeLabel'));?>
</div>

<div class="field">
	<?php echo CHtml::submitButton('Войти', array('class' => 'btn btn-success')); ?>
</div>

<?php $this->endWidget(); ?>
</div>

