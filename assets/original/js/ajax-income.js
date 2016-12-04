$("#addIncome").click(function () {
  var income_from = $("#incDari").val();
  var income_value = $("#incValue").val();

  $.post("page/response.php",{
    addInc: true,
    income_from: income_from,
    income_value: income_value
  }, function(data, status){
    var response = JSON.parse(data);
    if (response.execute == 1) {
      alert(response.message);
      $("#incDari").val("");
      $("#incValue").val("");
      loadIncome();
    }else{
      alert(response.message);
    }
    $("#modal-addinc").modal("hide");
  });
});

function getIncomeData(id){
  $.post("page/response.php",{
    income_id: id,
    getIncomeData: 1
  },function(data){
    var incData = JSON.parse(data);
	  $("#idInc").val(incData.income_id);
      $("#editFromInc").val(incData.income_from);
      $("#editValueInc").val(incData.income_value);
    $("#modal-editinc").modal("show");
  });

}

function updateIncomeData(){
	var income_id = $("#idInc").val();
	var income_from = $("#editFromInc").val();
	var income_value = $("#editValueInc").val();
	
  $.post("page/response.php",{
	upIncID: income_id,
	upIncFrom: income_from,
	upIncValue: income_value,
	updateInc: 1
  },function(data){
	var response = JSON.parse(data);
		if(response.execute == 1){
			alert(response.message);
			$("#modal-editinc").modal("hide");
		}else{
			alert(response.message);
		}
		loadIncome();
  });
}

function delIncome(id){
  var bool = confirm("Anda yakin ingin menghapus ini?");
  
  if(bool == true){
	  $.post("page/response.php",{
		delInc: 1,
		income_id: id
	  }, function(data){
		var response = JSON.parse(data);
		if (response.execute == 1) {
		  alert(response.message);
		  loadIncome();
		}else{
		  alert(response.message);
		}
	  });
  }
}

function findIncome(){
  var date2show = $("#incShowDate").val();
  var text2find = $("#findText").val();
  
  if(date2show == ""){
	$("#findText").attr("disabled",1);
	$("#alertNotShow").fadeIn(300, function(){
		$("#alertNotShow").delay(1000).fadeOut(300);
	});
	$("#tableIncome").html("");
  }else{
	  $("#findText").removeAttr("disabled");
	  $.get("page/response.php",{
		income_date: date2show,
		searchInc: text2find,
		readInc: 1
	  }, function(data) {
		$("#tableIncome").html(data);
	  });
  }
}

function loadIncome() {
  var date2show = $("#incShowDate").val();
  
  if(date2show == ""){
	$("#findText").attr("disabled",1);
	$("#alertNotShow").fadeIn(300, function(){
		$("#alertNotShow").delay(1000).fadeOut(300);
	});
	$("#tableIncome").html("");
  }else{
	  $("#findText").removeAttr("disabled");
	  $.get("page/response.php",{
		readInc:1,
		income_date: date2show
	  }, function(data) {
		$("#tableIncome").html(data);
	  });
  }
}