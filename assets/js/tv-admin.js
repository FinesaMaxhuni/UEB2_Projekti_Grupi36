const deleteButtons = document.querySelectorAll('.delete-package-btn');

function decrementCounter(counterId) {
    const counter = document.getElementById(counterId);
    if (!counter) return;

    const currentValue = parseInt(counter.textContent, 10);
    if (Number.isNaN(currentValue)) return;

    counter.textContent = Math.max(currentValue - 1, 0);
}

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

                const packageRow = document.getElementById('package-row-' + packageType + '-' + packageId);
                if (packageRow) packageRow.remove();

                const summaryRow = document.getElementById('summary-row-' + packageType + '-' + packageId);
                if (summaryRow) summaryRow.remove();

                if (packageType === 'tv') {
                    decrementCounter('total-tv-packages');
                }

                if (packageType === 'tv_internet') {
                    decrementCounter('total-tv-internet-packages');
                }

            }else{

                alert(data.message);
            }

        })

        .catch(() => {

            alert('Gabim ne server.');

        });

    });

});
