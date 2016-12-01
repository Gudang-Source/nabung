function loadData(){
  $('#income').dataTable({
    "ajax":{
      "url": "page/response.php?readInc",
      "type": "POST"
    }
  });
}

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
    }else{
      alert(response.message);
    }
    loadData();
  });
});

$(document).ready(function(){
  loadData();
});
