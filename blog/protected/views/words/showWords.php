<?php Yii::app()->getClientScript()->registerPackage('words'); ?>

<link href='http://fonts.googleapis.com/css?family=Roboto:900' rel='stylesheet' type='text/css'>

<div class="help">
    
    <div class="control">
        <span class="showRules">Hide rules</span>
        <ul class="rules">
            <li>Q - next</li>
            <li>A - previous</li>
            <ul>T - highbright</ul>
        </ul>
    </div>

<div class="btn-group">
  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    Опции
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu">
    <?php echo CHtml::link('В разброс', array('words/randomWords')); ?><br>
    <?php echo CHtml::link('Самые частые', array('words/mostOften')); ?><br>
    <?php echo CHtml::link('Самые редкие', array('words/mostRare')); ?><br>
    <?php echo CHtml::link('Совпадения с базой', array('words/matchWithDb')); ?>
    <!-- dropdown menu links -->
  </ul>
</div>

</div>

<div id="current-subtitle"><span class="bold">Текущий файл: </span><?php echo $srt ?></div>

<div class="main">

    <div id="error-ajax">Произошла ошибка. Попробуйте позже.</div>

    <div class="refresh-div">

        <div class="info">
            <div id="info">
                <span id="number"><?php echo $model->number; ?> из <?php echo $model->countWords; ?></span>
                <input id="hidden-number" type="hidden" value="<?php echo $model->currentWord; ?>">
                <?php echo CHtml::image('images/close.png', 'Скрыть', array('class' => 'close-img', 'title' => 'Скрыть')); ?>
            </div>
        </div>

        <div class="content">
            <div id="Acontent">
                <?php echo CHtml::form(); ?>
                    <?php echo CHtml::image('http://st0.vk.me/images/upload.gif', '', array('id' => 'loader-img')) ?>
                    <span id="word" class="word"><?php echo CHtml::encode($model->currentWord); ?></span>
                    <?php if ($model->action): ?>
                        <?php echo CHtml::image('images/close.png', 'Удалить', array('class' => 'action-img', 'id' => 'delete-img', 'title' => 'Удалить')); ?>
                    <?php else: ?>
                        <?php echo CHtml::image('images/add.gif', 'Добавить', array('class' => 'action-img', 'id' => 'add-img', 'title' => 'Добавить')); ?>
                    <?php endif; ?>
                <?php echo CHtml::endForm(); ?>
            </div>
        </div>

    </div>

    <div class="buttons">

        <script type="text/javascript">
            function showWordNext() {
                $('.content').load("<?php echo Yii::app()->createUrl('words/nextWord'); ?> #Acontent");
                $('.info').load("<?php echo Yii::app()->createUrl('words/nextWord'); ?> #info");
            };

            function showWordPrevious() {
                $('.content').load("<?php echo Yii::app()->createUrl('words/previousWord'); ?> #Acontent");
                $('.info').load("<?php echo Yii::app()->createUrl('words/previousWord'); ?> #info");
            };

            $('.content').on('click', '#add-img', function() {
                var timer = setTimeout(addLoaderImg, 700);
                $.ajax({
                    type: 'POST',
                    url: "<?php echo Yii::app()->createUrl('words/addWord'); ?>",
                    data: { word: $('#hidden-number').val(), 'YII_CSRF_TOKEN': "<?php echo Yii::app()->request->csrfToken; ?>" },
                    success: function(data) {
                        var content = $(data).find('#Acontent');
                        $('.content').html(content);
                        clearTimeout(timer);
                    }
                }).error(function() {   
                    errorMsg(8000);
                    clearTimeout(timer);
                })
            });

            $('.content').on('click', '#delete-img', function() {
                var timer = setTimeout(addLoaderImg, 700);
                $.ajax({
                    type: 'POST',
                    url: "<?php echo Yii::app()->createUrl('words/deleteWord'); ?>",
                    data: { word: $('#hidden-number').val(), 'YII_CSRF_TOKEN': "<?php echo Yii::app()->request->csrfToken; ?>" },
                    success: function(data) {
                        var content = $(data).find('#Acontent');
                        $('.content').html(content);
                        clearTimeout(timer);
                    }
                }).error(function() {
                    errorMsg(8000);
                    clearTimeout(timer);
                })
            });
        </script>

        <hr>

        <?php echo CHtml::button('Next =>', array('class' => 'button float-right', 'onclick' => 'showWordNext()')); ?>

        <?php echo CHtml::button('Previous', array('class' => 'button float-left', 'onclick' => 'showWordPrevious()')); ?>

    </div>

</div>
