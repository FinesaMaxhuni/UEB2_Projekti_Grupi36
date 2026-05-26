const deleteButtons = document.querySelectorAll('.delete-package-btn');

deleteButtons.forEach(button => {

    button.addEventListener('click', function(){

        if(!confirm('A je i sigurt qe don me fshi kete pakete?')){
            return;
        }

        const packageId = this.dataset.id;
        const packageType = this.dataset.type;

        fetch('/UEB2_Projekti_Grupi36/pages/delete-package.php', {

            method: 'POST',

            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },

            body:
                'id=' + packageId +
                '&type=' + packageType
        })

        .then(response => response.json())

        .then(data => {

            if(data.success){

                document
                    .getElementById('package-row-' + packageId)
                    .remove();

            }else{

                alert(data.message);
            }

        })

        .catch(() => {

            alert('Gabim ne server.');

        });

    });

});