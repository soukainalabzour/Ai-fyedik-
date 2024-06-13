document.addEventListener("DOMContentLoaded", function() {
    fetch('../php/getprofil.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const clientData = data.data;

                document.querySelector('input[name="email_log"]').value = clientData.EMAIL_CLIENT;
                document.querySelector('input[name="fnameCl"]').value = clientData.NOM_CLIENT;
                document.querySelector('input[name="lnameCl"]').value = clientData.PRENOM_CLIENT;
                document.querySelector('input[name="lang"]').value = clientData.LANGUAGE_CLIENT;
                document.querySelector('input[name="countryCl"]').value = clientData.PAYS_CLIENT;
                document.querySelector('input[name="cityCl"]').value = clientData.VILLE_CLIENT;
                document.querySelector('input[name="adressCl"]').value = clientData.ADRESSE_CLIENT;
                document.querySelector('input[name="numCl"]').value = clientData.NUM_CLIENT;
            } else {
                console.error(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
});



// const form = document.getElementById('formCl');
// form.addEventListener('submit', function(e) {
//     e.preventDefault();

//     const formData = {
//         email_log: form.elements.email_log.value,
//         fnameCl: form.elements.fnameCl.value,
//         lnameCl: form.elements.lnameCl.value,
//         lang: form.elements.lang.value,
//         countryCl: form.elements.countryCl.value,
//         cityCl: form.elements.cityCl.value,
//         adressCl: form.elements.adressCl.value,
//         numCl: form.elements.numCl.value
//     };

//     fetch('../php/getprofil.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify(formData)
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.status === 'success') {
//             alert(data.message);
//             window.location.href = "../html/profilvalide.html";
//         } else {
//             console.error(data.message);
//         }
//     })
//     .catch(error => console.error('Error:', error));
// });

