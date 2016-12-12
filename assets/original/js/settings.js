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

$("#editFullname").click(function(){
	$("#fullnameView").hide(function(){
		$("#form-fullname").slideDown();
	});
});

$("#saveEditFullname").click(function(){
	$("#fullnameView").show(function(){
		$("#form-fullname").slideUp();
	});
});