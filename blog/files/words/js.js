$(function() {

	var Q_button = 81;
	var A_button = 65;
	var T_button = 84;

	var widthForImgClose = $('.close-img').css('width'); // store property
	var heigthForImgClose = $('.close-img').css('heigth'); // store property

	var widthForImgAction = $('.action-img').css('width');
	var heigthForImgAction = $('.action-img').css('width');

	/**
	* Keydown events
	*/

	$(document).keydown(function(event) {
		if ( event.which == Q_button ) {
			showWordNext();
		}
	})

	$(document).keydown(function(event) {
		if ( event.which == A_button ) {
			showWordPrevious();
		}
	})

	$(document).keydown(function(event) {
		if ( event.which == T_button ) {
			selectText();
		}
	})


	/**
	* Event with propertys css
	*/

	$('.info').on('mouseover', '.close-img', function() {
		$(this).css({
			width:  '+=2px',
			cursor: 'pointer'
		});
	})

	$('.content').on('mouseover', '.action-img', function(event) {
		$(this).css({
			width: '+=2px',
			cursor: 'pointer'
		})
	})

	$('.info').on('mouseout', '.close-img', function() {
		$(this).css({
			width: widthForImgClose,
			heigth: heigthForImgClose,
			cursor: 'default'
		});
	})

	$('.content').on('mouseout', '.action-img', function(event) {
		$(this).css({
			width: widthForImgAction,
			heigth: widthForImgAction,
			cursor: 'default'
		})
	})




	$('.info').on('click', '.close-img', function() {
		$('#number').toggleClass('active');
	})


	$('.showRules').click(function() {
		$('.rules').toggleClass('active');
	})
})

function selectText() {
	var text = document.getElementById('word');
	var selection = window.getSelection();
	var range = document.createRange();
	range.selectNodeContents(text);
	selection.removeAllRanges();
	selection.addRange(range);

	return false;
}

function showWordNext(url) {
    $('.content').load("<?php echo Yii::app()->createUrl('words/nextWord'); ?> #content");
    $('.info').load("<?php echo Yii::app()->createUrl('words/nextWord'); ?> #info");
}

function showWordPrevious() {
    $('.content').load("<?php echo Yii::app()->createUrl('words/previousWord'); ?> #content");
    $('.info').load("<?php echo Yii::app()->createUrl('words/previousWord'); ?> #info");
}


function errorMsg(duration) {
    $('#error-ajax').css({
        display: 'block',
        opacity: 1
    }, 1000);
    setTimeout(function() {
        $('#error-ajax').animate({
            display: 'none',
            opacity: 0 
        }, 1500)
    }, 5000);
}

function addLoaderImg() {
	$('#loader-img').css({
		display: 'inline'
	})
}

