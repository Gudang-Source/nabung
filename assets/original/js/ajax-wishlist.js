function insertDataWS(){
	var namaBarang = $("#namabarang").val();
	var nominalBarang = $("#nominalbarang").val();
	var halini = $("#halini").text();

	$.post("page/wsresponse.php?act=addData",{
		namaBrg: namaBarang,
		nominalBrg: nominalBarang
	}, function(data){
		var response = JSON.parse(data);
		if (response.status == 1) {
			alert(response.message);
			loadDataWS(halini);
			$("#add-barang").modal('hide');
		}else{
			alert(response.message);
		}
	});
}

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