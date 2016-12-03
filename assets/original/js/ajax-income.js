$("#addIncome").click(function () {
  var income_for = $("#incDari").val();
  var income_value = $("#incValue").val();

  $.post("page/response.php",{
    addInc: true,
    income_for: income_for,
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

function delIncome(id){
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

function findIncome(){
  var text2find = $("#findText").val();

  $.post("page/response.php",{
    
  })
}

function loadIncome() {
  $.get("page/response.php?readInc",{
    readInc:1
  }, function(data) {
    $("#tableIncome").html(data);
  });
}
$(document).ready(function(){
  loadIncome();
});
