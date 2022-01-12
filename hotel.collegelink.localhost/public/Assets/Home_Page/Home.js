//Date Picker//
$(document).ready(function () {
  $(function () {
    $("#from").datepicker({
      dateFormat: "yy-mm-dd",
    });
  });

  $(function () {
    $("#to").datepicker({
      dateFormat: "yy-mm-dd",
    });
  });

  const Year = new Date();
  console.log(Year);
  document.querySelector("#Year").innerHTML = Year.getFullYear();
  console.log(Year.getFullYear());
});
