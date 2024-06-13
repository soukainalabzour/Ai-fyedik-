const form = document.querySelector("form");
let btn = document.getElementById("submit_Cl");
let rep = document.getElementById("reponceCl");

form.addEventListener("submit", e => {
    e.preventDefault();
});

btn.addEventListener('click', function() {
    let fname = form.elements.fnameCl.value;
    let lname = form.elements.lnameCl.value;
    let language = form.elements.lang.value;
    let country = form.elements.countryCl.value;
    let city = form.elements.cityCl.value;
    let address = form.elements.adressCl.value;
    let numphone = form.elements.numCl.value;

    let xml = new XMLHttpRequest();
    xml.open("POST", "../php/comptClient.php", true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send(
        "NOM_CLIENT=" + encodeURIComponent(fname) +
        "&PRENOM_CLIENT=" + encodeURIComponent(lname) +
        "&LANGUAGE_CLIENT=" + encodeURIComponent(language) +
        "&PAYS_CLIENT=" + encodeURIComponent(country) +
        "&VILLE_CLIENT=" + encodeURIComponent(city) +
        "&ADRESSE_CLIENT=" + encodeURIComponent(address) +
        "&NUM_CLIENT=" + encodeURIComponent(numphone)
    );

    xml.onload = function() {
        if (xml.readyState === XMLHttpRequest.DONE) {
            if (xml.status === 200) {
                const response = JSON.parse(xml.responseText);
                if (response.status === "success") {
                    window.location.href = "../html/profilvalide.html";
                } else {
                    rep.innerHTML = `<input type='text' disabled value='${response.message}' style='background:#d64040e2; color:#fff;'>`;
                    console.log(response.message);
                }
            }
        }
    };
});
