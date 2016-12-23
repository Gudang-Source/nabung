function loadDataWS(){
	var search2Text = $("#searchText").val();
	if (search2Text.length == 0) {
		search = null;
	}else{
		search = search2Text;
	}

	$.get("page/wsresponse.php",{
		act: 'getData',
		searchText: search
	}, function(data){
		$("#data-wishlist").html(data);
	});
}

$(document).ready(function() {
	loadDataWS();
});