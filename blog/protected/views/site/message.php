<div class="main">
<?php $form = $this->beginWidget('CActiveForm'); ?>

    <div class="field">
        <?php echo $form->label($model, 'name'); ?>
        <?php echo $form->textField($model, 'name'); ?>
        <?php echo $form->error($model, 'name', array('class' => 'label label-important')); ?>
    </div>

    <div class="field">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email'); ?>
        <?php echo $form->error($model, 'email', array('class' => 'label label-important')); ?>
    </div>

    <div class="field">
        <?php echo $form->labelEx($model, 'message'); ?>
        <?php echo $form->textArea($model, 'message', array('rows' => 12, 's' => 200)); ?>
        <?php echo $form->error($model, 'message', array('class' => 'label label-important')); ?>
    </div>

    <div class="field">
        <?php echo $form->label($model, 'phone'); ?>
        <?php echo $form->textField($model, 'phone', array('colums' => '45')); ?>
        <?php echo $form->error($model, 'phone', array('class' => 'label label-important')); ?>
    </div>

    <div class="field">
        <?php echo $form->label($model, 'site'); ?>
        <?php echo $form->textField($model, 'site'); ?>
        <?php echo $form->error($model, 'site', array('class' => 'label label-important')); ?>
    </div>

    <div class="field">
        <?php echo CHtml::submitButton('Отправить', array('class' => 'btn btn-info')); ?>
    </div>

<?php $this->endWidget(); ?>
</div>   