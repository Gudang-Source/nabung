$("#editPassword").click(function(){
	$("#passwordView").hide(function(){
		$("#form-password").slideDown();
	});
});

$("#saveEditPassword").click(function(){
	$("#passwordView").show(function(){
		$("#form-password").slideUp();
	});
});

$("#editGoal").click(function(){
	$("#editGoal").hide(0, function(){
		$("#saveGoal").show();
		$("#goalInput").removeAttr('readonly');
	});
});

$("#saveGoal").click(function(){
	$("#saveGoal").hide(0, function(){
		$("#editGoal").show();
		$("#goalInput").attr('readonly', 1);
	});
});

function saveName(){
	var fullname = $("#fullname-input").val();

	$.post("page/rsettings.php?act=changeName",{
		name: fullname
	}, function(data){
		var response = JSON.parse(data);
		if (response.status != 0) {
			//Sembunyikan form
			$("#form-fullname").hide(0,function(){
				$("#fullname-setting").show();
			});

			//Sembunyikan tombol save
			$("#saveEditFullname").hide(0, function(){
				$("#editFullname").show();
			});

			alert(response.message);

			//load data kembali
			loadData();
		}else{
			alert(response.message);
		}
	});
}

function loadData(){
	$.get("page/rsettings.php",{
		act: "getUserData"
	},function(data){
		var userdata = JSON.parse(data);
		$("#fullname-setting").text(userdata.name);
		$("#fullname-input").val(userdata.name);
	});
}

$(document).ready(function(){
	//Tombol Edit Nama
	$("#editFullname").click(function(){
		$("#fullname-setting").hide(0,function(){
			$("#form-fullname").show();
		});
		$("#editFullname").hide(0,function(){
			$("#saveEditFullname").show();
		});
	});

	//Tombol Password

	loadData();
});