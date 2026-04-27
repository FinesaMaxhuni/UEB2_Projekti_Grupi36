$(document).ready(function () {
  const paymentType = $("#pagesa");
  const cardDetails = $("#cardDetails");

  // Shfaq / fsheh detajet e kartës
  paymentType.on("change", function () {
    if ($(this).val() === "card") {
      cardDetails.slideDown(300);
    } else {
      cardDetails.slideUp(300);
    }
  });

  // Validime VIZUALE vetëm (nuk e ndalin formën)
  $("#paymentForm input, #paymentForm select").on("blur", function () {
    $(this).next(".error").remove();

    if ($(this).val().trim() === "") {
      $(this).after('<span class="error">Fusha është e detyrueshme.</span>');
    }
  });

  // Heq error sapo përdoruesi shkruan
  $("#paymentForm input, #paymentForm select").on("input change", function () {
    $(this).next(".error").remove();
  });

});