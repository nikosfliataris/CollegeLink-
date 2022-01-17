$(document).ready(function (e) {
  //// Favorite with Ajax /////
  $(function () {
    $(document).on("submit", "form.favoriteForm", function (e) {
      e.preventDefault();

      const formData = $(this).serialize();
      console.log(formData);
      $.ajax(
        "http://hotel.collegelink.localhost/public/actions/ajax/favorite.php",
        {
          type: "POST",
          data: formData,
          datatype: "json",
        }
      ).done(function (result) {
        console.log(result);
        if (result.status) {
          console.log(result);
          $("input[name=is_favorite]").val(result.is_favorite ? "1" : "0");
        } else {
          $(".fav_heart").toggleClass("selected");
        }
      });
    });

    $(document).on("submit", "form.review", function (e) {
      e.preventDefault();

      const formData = $(this).serialize();
      console.log(formData);
      $.ajax(
        "http://hotel.collegelink.localhost/public/actions/ajax/review.php",
        {
          type: "POST",
          data: formData,
          datatype: "html",
        }
      ).done(function (result) {
        $(".Room-reviews").append(result);
        $("form.review").trigger("reset");
      });
    });
  });
});
