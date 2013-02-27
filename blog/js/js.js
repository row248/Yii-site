$(function() {
	//Hack for live :[
	if ( document.getElementById('messages-grid') ) {
		$('#messages-grid td').live('mouseover', function() {
			var parent = $(this).parent();
			$(parent).css("background-color", "#d2d5ef");
		})

		$('#messages-grid td').live('mouseout', function() {
			var parent = $(this).parent();
			$(parent).css("background-color", "white");
		})
	}
})