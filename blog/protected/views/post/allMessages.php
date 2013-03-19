<?php Yii::app()->getClientScript()->registerPackage('main'); ?>

<div id="popup">

	<?php
		$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
			'id' => 'popup-window',
			'options' => array(
				'title' => 'Сообщение от',
				'autoOpen' => false,
				'modal' => true,
				'width' => '65%',
				'height' => '600',
				'closeOnEscape' => true
			),
		));
	?>

		<div id="popup-content"></div>

	<?php
		
		$this->endWidget('zii.widgets.jui.CJuiDialog');
	?>

</div>

<div class="grid-form">
	
<?php echo CHtml::form(); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'messages-grid',
	'dataProvider' => $model->search(),
	'cssFile' => false, //Yii::app()->baseUrl . '/css/style.css',
	'summaryText' => 'Показаны <span class="bold">{end}</span> сообщени(й,я) из <span class="bold">{count}</span>',
	'columns' => array(
		'name',
		array(
			'name' => 'email',
			'type' => 'raw',
			'value' => 'H::getEmailLink($data->email)'
		),
		array(
			'type' => 'raw',
			'name' => 'message',
			'headerHtmlOptions' => array('class' => 'th-sort'),
			'value' => 'mb_strlen($data->message) > 700 ? Messages::filterLength(CHtml::encode($data->message)) .
						CHtml::ajaxLink("Читать далее", array("post/fullScreenMsg"),
						array("type" => "POST",
							"success" => "js:function(data) { var title = $(data).find(\'.title\');
														  	  var msg = $(data).find(\'.content\');
															  $(\'#popup-content\').html(msg);
															  $(\'#ui-id-1\').html(title); }",
							"data" => array("id" => "$data->id", "YII_CSRF_TOKEN" => H::csrf())),
						array("class" => "read-further")) : CHtml::encode($data->message)',
		),
		array(
			'name' => 'site',
			'type' => 'raw',
			'value' => 'H::regexpSite($data->site)'
		),
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
		}/*
		$(function() {
			$('.read-further').click(function() {
				$.ajax({
					type: "POST",
					url: "<?php Yii::app()->createUrl('post/fullScreenMsg'); ?>",
					data: { 'YII_CSRF_TOKEN': "<?php echo Yii::app()->request->csrfToken; ?>", id: "20" },
					success: function(data) {
						$('#popup-content').html(data);
					}
				})
			})
		})*/
		</script>

		<?php echo CHtml::ajaxSubmitButton('Удалить', array('Post/AjaxDelete'),
					array('type' => 'POST', 'success' => 'reloadGrid',
					'beforeSend'=>'beforeDeleteConfirm' ), 

					array('class' => 'btn btn-danger delete')); ?>

	</div>

</div>

<?php echo CHtml::endForm(); ?>