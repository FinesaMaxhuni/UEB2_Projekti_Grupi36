$(document).ready(function () {
  $("#abonohuForm").on("submit", function (e) {
    e.preventDefault();
    let isValid = true;
    $(".error").remove();

    const emri = $("#emri").val().trim();
    const mbiemri = $("#mbiemri").val().trim();
    const email = $("#email").val().trim();
    const telefon = $("#telefon").val().trim();

    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    const phonePattern = /^[0-9]{8,15}$/;

    // Validimi
    if (emri === "") {
      $("#emri").after('<span class="error">Ju lutem shkruani emrin.</span>');
      isValid = false;
    }
    if (mbiemri === "") {
      $("#mbiemri").after('<span class="error">Ju lutem shkruani mbiemrin.</span>');
      isValid = false;
    }
    if (email === "") {
      $("#email").after('<span class="error">Emaili është i detyrueshëm.</span>');
      isValid = false;
    } else if (!email.match(emailPattern)) {
      $("#email").after('<span class="error">Emaili nuk është valid.</span>');
      isValid = false;
    }
    if (telefon === "") {
      $("#telefon").after('<span class="error">Numri i telefonit është i detyrueshëm.</span>');
      isValid = false;
    } else if (!telefon.match(phonePattern)) {
      $("#telefon").after('<span class="error">Numri duhet të përmbajë vetëm shifra (8–15).</span>');
      isValid = false;
    }

    // Nëse çdo gjë është OK
    if (isValid) {
      $("#abonohuForm").fadeOut(400);
      $("#loadingScreen").fadeIn(500);

      setTimeout(() => {
        $("#loadingScreen").fadeOut(400, function () {
          $("#successMessage").fadeIn(600);
        });
      }, 3000);
    }
  });
});
