<?php Yii::app()->getClientScript()->registerPackage('main'); ?>

<div class="grid-form">

<?php echo CHtml::form(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'messages-grid',
	'dataProvider' => $model->searchSrt(),
	'cssFile' => false,
	'columns' => array(
		'subtitle_filename',
	array(
		//'class' => 'CDataColumn',
		//'header' => '1',
		//'name' => 'select',
		'type' => 'raw',
		//'type' => 'html',
		'value' => '!$data->current_subtitle ? CHtml::ajaxSubmitButton("Выбрать", array(\'site/choiseSubtitle\'),
					array(\'type\' => \'POST\', \'success\' => \'reloadGrid\', \'data\' => array(\'id\' => $data->id,
					\'YII_CSRF_TOKEN\' => csrf())), array(\'class\' => \'btn btn-info\')) : "Выбранные" '
	),
	array(
		'name' => 'id',
		'value' => '$data->id'
	),
	array(
		'class' => 'CCheckBoxColumn',
		'id' => 'id',
		'selectableRows' => 2,
		//'checkBoxHtmlOptions' => array('checked' => 'checked')
	)),
));

?>

	<div class="delete-msg">

		<script>
		function reloadGrid() {
			$.fn.yiiGridView.update('messages-grid'); //\\//\\Глючит аякс, невсегда корректно отправляет айди из-за кривого обновления
			//window.location.reload();
		}
		</script>

		<?php echo CHtml::ajaxSubmitButton('Удалить', array('site/AjaxDelete'),
					array('type' => 'POST', 'success' => 'reloadGrid',
					'beforeSend'=>'function() { if(confirm("Подтвердить удаление?")) return true; return false; }' ), 

					array('class' => 'btn btn-danger')); ?>

	</div>
<?php echo CHtml::endForm(); ?>