$(function() {
	//Hack for live :[
	if ( document.getElementById('messages-grid') ) {
		$('.grid-form').on('mouseover', 'td', function(event) {
			var parent = $(this).parent();
			$(parent).css("background-color", "#d2d5ef");
		})

		$('.grid-form').on('mouseout', 'td', function(event) {
			var parent = $(this).parent();
			$(parent).css( {
				"background-color": "white",
			});
		})
	}
})