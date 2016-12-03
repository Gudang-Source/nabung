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
  },function(data) {
    var incData = JSON.parse(data);
      $("#editFromInc").val(incData.income_from);
      $("#editValueInc").val(incData.income_value);
    $("#modal-editinc").modal("show");
  });

}

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

  $.get("page/response.php",{
    searchInc: text2find,
    readInc: 1
  }, function(data) {
    $("#tableIncome").html(data);
  });
}

function loadIncome() {
  $.get("page/response.php",{
    readInc:1
  }, function(data) {
    $("#tableIncome").html(data);
  });
}
$(document).ready(function(){
  loadIncome();
});
