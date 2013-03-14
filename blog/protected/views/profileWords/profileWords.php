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
    Перемешать
    <span class="caret"></span>
  </a>
  <ul class="dropdown-menu" id="dropdown-menu-words">
    <?php echo CHtml::link('В разброс', array('profileWords/randomWords')); ?><br>
    <?php echo CHtml::link('В порядке добавления', array('profileWords/openProfile')) ?>
    <!-- dropdown menu links -->
  </ul>
</div>

</div>

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
                    <span id="word" class="word"><?php echo CHtml::encode($model->currentWord); ?></span>
                    <?php echo CHtml::image('images/close.png', 'Удалить', array('class' => 'action-img', 'id' => 'delete-img', 'title' => 'Удалить')); ?>
            </div>
        </div>

    </div>

    <div class="buttons">

        <script type="text/javascript">
            function showWordNext() {
                $('.content').load("<?php echo Yii::app()->createUrl('profileWords/nextWord'); ?> #Acontent");
                $('.info').load("<?php echo Yii::app()->createUrl('profileWords/nextWord'); ?> #info");
            };

            function showWordPrevious() {
                $('.content').load("<?php echo Yii::app()->createUrl('profileWords/previousWord'); ?> #Acontent");
                $('.info').load("<?php echo Yii::app()->createUrl('profileWords/previousWord'); ?> #info");
            };

            $('.content').on('click', '#delete-img', function() {
                var timer = setTimeout(addLoaderImg, 700);
                $.ajax({
                    type: 'POST',
                    url: "<?php echo Yii::app()->createUrl('profileWords/deleteWord'); ?>",
                    data: { word: $('#hidden-number').val(), 'YII_CSRF_TOKEN': "<?php echo Yii::app()->request->csrfToken; ?>" },
                    success: function(data) {
                        var content = $(data).find('#Acontent');
                        var info = $(data).find('#info'); // update hidden value in #info
                        $('.info').html(info); 
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
