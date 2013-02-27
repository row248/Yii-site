<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css">

    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/js.js"></script>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

	<div class="navbar navbar-inner">

	<?php 
    $this->widget('zii.widgets.CMenu', array(
        'htmlOptions' => array('class' => 'nav'),
        'items' => array(
            array('label' => 'На главную', 'url' => array('site/index')),
            array('label' => 'Отправить сообщение', 'url' => array('site/message')),
        ),
    ));

    if ( Yii::app()->user->isGuest ) {
        $this->widget('zii.widgets.CMenu', array(
            'htmlOptions' => array('class' => 'nav float-right'),
            'items' => array(
                array('label' => 'Регистрация', 'url' => array('site/registr')),
                array('label' => 'Войти', 'url' => array('site/login')),
            ),
        ));
    }

    if ( !Yii::app()->user->isGuest ) {
        $this->widget('zii.widgets.CMenu', array(
            'htmlOptions' => array('class' => 'nav float-right'),
            'items' => array(
                array('label' => 'Выход', 'url' => array('site/logout')),
            ),
        ));
    }

    if ( Yii::app()->user->checkAccess('administrator') ) {
        $this->widget('zii.widgets.CMenu', array(
            'htmlOptions' => array('class' => 'nav'),
            'items' => array(
                array('label' => 'Посмотреть сообщения', 'url' => array('post/viewMessages')),
            ),
        ));
    }

	?>
	
	</div>

    <?php echo $content; ?>

</body>
</html>