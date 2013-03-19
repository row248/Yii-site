$(function() {
	$('.grid-form').on('mouseover', 'td', function(event) {
		var parent = $(this).parent();
		$(parent).css("background-color", "#DCDFF2");
	})

	$('.grid-form').on('mouseout', 'td', function(event) {
		var parent = $(this).parent();
		$(parent).css( {
			"background-color": "white",
		});
	})

	$('.delete').prop('disabled', true); // Default

	$('.grid-form').on('change', 'input[type="checkbox"]', function() {
		if ( $('input[type="checkbox"]:checked').length > 0 ) {
			$('.delete').prop('disabled', false);
			console.log(false);
		} else {
			$('.delete').prop('disabled', true);
			console.log(true);
		}
	})

	$('.grid-form').on('click', '.read-further', function() {
		$('#popup-window').dialog("open");
	})

	$('.grid-form').on('click', '.th-sort > a', function() {
		var parent = $(this).parent();
		parent.css({
			"background-color": "yellow"
		});
	})
})

function beforeDeleteConfirm() {
	var ending;
	var a = 'ие'
	var b = 'ия';
	var c = 'ий';
	var count = $('.checkbox-column > :checkbox:checked').length;

	if ( count === 1 ) {
		ending = a;
	} else if ( count === 2 || count === 3 || count === 4 ) {
		ending = b;
	} else if ( count >= 5 && count <= 20) {
		ending = c;
	}

	if(confirm("Вы хотите удалить всего " + count + " сообщен" + ending + "?")) { 
		return true;
	}
	return false;
}

