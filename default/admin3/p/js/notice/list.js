$(function(){
	$(".del").click(function(evt){		
		if (confirm("確定要刪除嗎?")) {
			$.json_post($(this).attr("url"), function(){
				location.reload();
			});	
		}
		return false;
	});
});