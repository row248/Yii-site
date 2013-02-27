<?php echo CHtml::form(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'messages-grid',
	'dataProvider' => $model->search(),
	'cssFile' => Yii::app()->baseUrl . '/css/style.css',
	'columns' => array(
		'name',
		'email',
		'message',
		'site',
		'phone',
	array(
		'class' => 'CCheckBoxColumn',
		'id' => 'id',
		'selectableRows' => 2,
		'checkBoxHtmlOptions' => array('checked' => 'checked'),

	)),
)); ?> 

<div class="delete-msg">

	<script>
	function reloadGrid() {
		$.fn.yiiGridView.update('messages-grid');
	}
	</script>

	<?php echo CHtml::ajaxSubmitButton('Удалить', array('Post/AjaxDelete'),
				array('type' => 'POST', 'success' => 'reloadGrid',
				'beforeSend'=>'function() { if(confirm("Подтвердить удаление?")) return true; return false; }' ), 

				array('class' => 'btn btn-danger')); ?>

</div>

<?php echo CHtml::endForm(); ?>