$(document).ready(function() {
	// Удаление
	$(".del_news").click(function() {
		var res = confirm("Подтвердите удаление");
		if(!res) return false;
	});
});