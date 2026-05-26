document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("contactForm");
    const fullnameInput = document.getElementById("fullname");
    const emailInput = document.getElementById("email");
    const messageInput = document.getElementById("message");

    const fullnameError = document.getElementById("fullnameError");
    const emailError = document.getElementById("emailError");
    const messageError = document.getElementById("messageError");

    // REGEX rregullat
    // Emri dhe Mbiemri: Së paku dy fjalë të ndara me hapësirë, vetëm shkronja (përfshirë ato shqipe si ç, ë)
    const fullnameRegex = /^[A-Za-jÇçËë]{2,}\s+[A-Za-jÇçËë]{2,}(?:\s+[A-Za-jÇçËë]{2,})*$/;
    
    // Email standard regex
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    contactForm.addEventListener("submit", function (event) {
        let isValid = true;

        // Resetojmë mesazhet e gabimeve para çdo validimi
        fullnameError.textContent = "";
        emailError.textContent = "";
        messageError.textContent = "";
        
        fullnameInput.classList.remove("input-error");
        emailInput.classList.remove("input-error");
        messageInput.classList.remove("input-error");

        // 1. Validimi i Emrit dhe Mbiemrit
        const fullnameValue = fullnameInput.value.trim();
        if (fullnameValue === "") {
            fullnameError.textContent = "Ju lutem shkruani Emrin dhe Mbiemrin.";
            fullnameInput.classList.add("input-error");
            isValid = false;
        } else if (!fullnameRegex.test(fullnameValue)) {
            fullnameError.textContent = "Ju lutem shkruani emrin dhe mbiemrin e plotë (vetëm shkronja).";
            fullnameInput.classList.add("input-error");
            isValid = false;
        }

        // 2. Validimi i Email-it
        const emailValue = emailInput.value.trim();
        if (emailValue === "") {
            emailError.textContent = "Ju lutem shkruani adresën e email-it.";
            emailInput.classList.add("input-error");
            isValid = false;
        } else if (!emailRegex.test(emailValue)) {
            emailError.textContent = "Formati i email-it nuk është i vlefshëm (psh. emri@gmail.com).";
            emailInput.classList.add("input-error");
            isValid = false;
        }

        // 3. Validimi i Mesazhit
        const messageValue = messageInput.value.trim();
        if (messageValue === "") {
            messageError.textContent = "Ju lutem shkruani mesazhin tuaj.";
            messageInput.classList.add("input-error");
            isValid = false;
        } else if (messageValue.length < 10) {
            messageError.textContent = "Mesazhi duhet të jetë së paku 10 karaktere i gjatë.";
            messageInput.classList.add("input-error");
            isValid = false;
        }

        // Nëse ndonjëri nga inputet nuk është valid, bllokohet dërgimi i formës
        if (!isValid) {
            event.preventDefault();
        }
    });

    // Opsionale: Validimi në kohë reale (kur përdoruesi shkruan)
    fullnameInput.addEventListener("input", function() {
        if(fullnameRegex.test(fullnameInput.value.trim())) {
            fullnameError.textContent = "";
            fullnameInput.classList.remove("input-error");
        }
    });

    emailInput.addEventListener("input", function() {
        if(emailRegex.test(emailInput.value.trim())) {
            emailError.textContent = "";
            emailInput.classList.remove("input-error");
        }
    });

    messageInput.addEventListener("input", function() {
        if(messageInput.value.trim().length >= 10) {
            messageError.textContent = "";
            messageInput.classList.remove("input-error");
        }
    });
});