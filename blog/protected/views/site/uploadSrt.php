<?php Yii::app()->getClientScript()->registerPackage('main'); ?>

<div class="main">
	<?php echo CHtml::form('', 'post', array('enctype' => 'multipart/form-data')); ?>

	<div class="field">
		<?php echo CHtml::activeFileField($model, 'srt', array('class' => 'input-file')); ?>
		<?php echo CHtml::submitButton('Загрузить', array('class' => 'btn btn-info')); ?>
		<?php echo CHtml::error($model, 'srt', array('class' => 'label label-important uploadError')); ?>
		<?php //echo CHtml::ajaxSubmitButton('Отправить', array('type' => 'POST')); ?>
	</div>

	<?php echo CHtml::endForm(); ?>
</div>