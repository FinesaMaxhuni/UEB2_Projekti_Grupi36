$(document).ready(function () {

  $("#abonohuForm input").on("blur", function () {
    $(this).next(".error").remove();

    if ($(this).val().trim() === "") {
      $(this).after('<span class="error">Fusha është e detyrueshme.</span>');
    }
  });

  $("#abonohuForm input").on("input", function () {
    $(this).next(".error").remove();
  });

});