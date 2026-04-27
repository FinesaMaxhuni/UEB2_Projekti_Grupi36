$(document).ready(function () {
  const form = $("#paymentForm");
  const loading = $("#loadingScreen");
  const successMessage = $("#successMessage");
  const paymentType = $("#pagesa");
  const cardDetails = $("#cardDetails");

  paymentType.on("change", function () {
    if ($(this).val() === "card") {
      cardDetails.slideDown(300);
    } else {
      cardDetails.slideUp(300);
    }
  });

  form.on("submit", function (e) {
    e.preventDefault();

    let valid = true;
    $(".error").remove();

    const emri = $("#emri").val().trim();
    const mbiemri = $("#mbiemri").val().trim();
    const adresa = $("#adresa").val().trim();
    const telefoni = $("#telefoni").val().trim();
    const pagesa = $("#pagesa").val();

    const phonePattern = /^[+0-9 ]{8,20}$/;

    if (emri === "") {
      $("#emri").after('<span class="error">Shkruaj emrin.</span>');
      valid = false;
    }

    if (mbiemri === "") {
      $("#mbiemri").after('<span class="error">Shkruaj mbiemrin.</span>');
      valid = false;
    }

    if (adresa === "") {
      $("#adresa").after('<span class="error">Adresa është e detyrueshme.</span>');
      valid = false;
    }

    if (telefoni === "" || !telefoni.match(phonePattern)) {
      $("#telefoni").after('<span class="error">Numri i telefonit nuk është valid.</span>');
      valid = false;
    }

    if (pagesa === "") {
      $("#pagesa").after('<span class="error">Zgjidh mënyrën e pagesës.</span>');
      valid = false;
    }

    if (pagesa === "card") {
      const cardNumber = $("#cardNumber").val().trim();
      const cvv = $("#cvv").val().trim();

      if (cardNumber.length < 16) {
        $("#cardNumber").after('<span class="error">Numri i kartës duhet të ketë 16 shifra.</span>');
        valid = false;
      }

      if (cvv.length < 3) {
        $("#cvv").after('<span class="error">CVV duhet të ketë 3 ose 4 shifra.</span>');
        valid = false;
      }
    }

    if (valid) {
      form.fadeOut(400);
      loading.fadeIn(500);

      setTimeout(() => {
        loading.fadeOut(400, function () {
          successMessage.fadeIn(600);
        });
      }, 3000);
    }
  });
});