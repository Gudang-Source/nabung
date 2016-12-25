function loadDataWS(page){
	var search2Text = $("#searchText").val();
	if (search2Text.length == 0) {
		search = null;
	}else{
		search = search2Text;
	}
	if (page == null) {
		setpage = null;
	}else{
		setpage = page;
	}

	$.get("page/wsresponse.php",{
		act: 'getData',
		searchText: search,
		page: setpage
	}, function(data){
		$("#data-wishlist").html(data);
	});
}

$(document).ready(function() {
	loadDataWS(1);
});