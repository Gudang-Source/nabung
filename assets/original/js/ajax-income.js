$(document).ready(function(){
  $("#addIncome").click(function () {
    var income_for = $("#dariInput").val();
    var income_value = $("#Nominal").val();

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
    });
  });
});
