$("#addOutcome").click(function(){
	var outcome_for = $("#outUntuk").val();
	var outcome_value = $("#outValue").val();
	var page = $("#disPage").text();

	$.post("page/response.php",{
		addOut: true,
		outcome_for: outcome_for,
		outcome_value: outcome_value
	},function(data){
		var response = JSON.parse(data);
		if (response.execute == 1) {
			alert(response.message);
			$("#outUntuk").val("");
			$("#outValue").val("");
			loadOutcome(page);
		}else{
			alert(response.message);
		}
		$("#modal-addout").modal("hide");
	});
});

function delOutcome(id){
	var bool = confirm("Apakah anda yakin ingin menghapus ini?");
	var page = $("#disPage").text();
	var pageData = $("#disCount").text();

	if (bool == true) {
		$.post("page/response.php",{
			delOut: 1,
			outcome_id: id
		}, function(data){
			var response = JSON.parse(data);
			if (response.execute == 1) {
				alert(response.message);
				if (pageData == 1) {
					loadOutcome(parseInt(page)-1);
				}else{
					loadOutcome(page);
				}
			}else{
				alert(response.message);
			}
		});
	}
}

function loadOutcome(page){
	var date2show = $("#outShowDate").val();
	var text2find = $("#outFindText").val();

	if (date2show == "") {
		$("#outFindText").attr("disabled", 1);
		$("#alertNotShow").fadeIn(300, function(){
			$("#alertNotShow").delay(1000).fadeOut(300);
		});
		$("#tableOutcome").html("");
	}else{
		$("#outFindText").removeAttr("disabled");
		if (text2find == "") {
			$.get("page/response.php",{
				readOut: 1,
				outcome_date: date2show,
				hal: page
			},function(data){
				$("#tableOutcome").html(data);
			});
		}else{
			$.get("page/response.php",{
				readOut: 1,
				searchOut: text2find,
				outcome_date: date2show,
				hal: page
			},function(data){
				$("#tableOutcome").html(data);
			});
		}
	}
}