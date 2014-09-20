$(function(){
	window.onbeforeunload = function(){
		$.ajax({url:'deal.php?act=unload',async:false});
	}
})
