//// Range Slider ////
$(document).ready(function (e) {
  $(function () {
    let value1 = parseInt($("#amount1").val());
    let value2 = parseInt($("#amount2").val());
    console.log(typeof value1, typeof value2, value1, value2);
    $("#slider-range").slider({
      range: true,
      min: 0,
      max: 1500,
      values: [0, 1500],
      slide: function (event, ui) {
        $("#amount1").val("$" + ui.values[0]);
        $("#amount2").val("$" + ui.values[1]);
        console.log(ui.values[0]);
        console.log(ui.values[1]);
      },
    });
  });

  ///Date Picker///

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

  //// Search page with Ajax /////

  $(function () {
    $(document).on("submit", "form.searchForm", function (e) {
      e.preventDefault();

      const formData = $(this).serialize();
      console.log(formData);
      $.ajax(
        "http://hotel.collegelink.localhost/public/actions/ajax/search-results.php",
        {
          type: "GET",
          data: "formData",
          datatype: "html",
        }
      ).done(function (result) {
        $(".result-bar").html("");
        $(".result-bar").append(result);
        history.pushState(
          {},
          "",
          "http://hotel.collegelink.localhost/public/Assets/List_Pages/Hotel.php?" +
            formData
        );
      });
    });
  });
});
