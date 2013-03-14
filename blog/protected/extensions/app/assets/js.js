$(function() {

	var Q_button = 81;
	var A_button = 65;
	var T_button = 84;

	var widthForImgClose = $('.close-img').css('width'); // store property
	var heigthForImgClose = $('.close-img').css('heigth'); // store property

	var widthForImgAdd = $('.add-img').css('width');
	var heigthForImgAdd = $('.add-img').css('width');

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

	$('.close-img').mouseover(function() {
		$(this).css({
			width:  '+=2px',
			cursor: 'pointer'
		});
	})

	$('.add-img').mouseover(function() {
		$(this).css({
			width: '+=2px',
			cursor: 'pointer'
		})
	})

	$('.close-img').mouseout(function() {
		$(this).css({
			width: widthForImgClose,
			heigth: heigthForImgClose,
			cursor: 'default'
		});
	})

	$('.add-img').mouseout(function() {
		$(this).css({
			width: widthForImgAdd,
			heigth: widthForImgAdd,
			cursor: 'default'
		})
	})

	$('.add-img').click(function() {
		$.ajax({
			type: 'POST',
			url: 'index.php?add-word=true',
			data: { word: $('#hidden-number').val() }
		}).done(function() {
			alert('Done?');
		})
	})

	$('.close-img').click(function() {
		$('#number').toggleClass('active');
	})


	$('.showRules').click(function() {
		$('.rules').toggleClass('active');
	})
})



function showWordNext() {
	$('#word').load('index.php?next=next #word');
	$('#number').load('index.php #number');

	return false;
}

function showWordPrevious() {
	$('#word').load('index.php?previous=previous #word');
	$('#number').load('index.php #number');

	return false;
}

function selectText() {
	var text = document.getElementById('word');
	var selection = window.getSelection();
	var range = document.createRange();
	range.selectNodeContents(text);
	selection.removeAllRanges();
	selection.addRange(range);

	return false;
}

