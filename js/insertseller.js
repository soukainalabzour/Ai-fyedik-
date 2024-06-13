let submitBtn = document.getElementById("submit_S");

submitBtn.addEventListener("click", (e) => {
    e.preventDefault(); // Prevent default form submission

    const numPhone = document.getElementById("numPhone").value;
    const lnameS = document.getElementById("lnameS").value;
    const fnameS = document.getElementById("fnameS").value;
    const description = document.getElementById("description").value;
    const lang = document.getElementById("selectedLanguages").value;
    const lien = document.getElementById("lien").value;
    const allservices = document.querySelector("all_service");
    const categories = document.getElementById("categories").value;
    const services = document.getElementById("services").value;
    const taskList = document.querySelectorAll("#task-list li span");
    let skils = "";
    taskList.forEach(el => {
        skils += "," + el.innerHTML;
    });

    let xml = new XMLHttpRequest();
    xml.open("POST", "../php/insertseller.php", true);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xml.send(
        "NOM_SELLER=" + encodeURIComponent(lnameS) +
        "&PRENOM_SELLER=" + encodeURIComponent(fnameS) +
        "&DESCRIPTION_SELLER=" + encodeURIComponent(description) +
        "&SELLER_SKILL=" + encodeURIComponent(skils) +
        "&SELLER_CATEGORY=" + encodeURIComponent(categories) +
        "&SELLER_SERVICE=" + encodeURIComponent(lang) +
        "&LIEN_SELLER=" + encodeURIComponent(lien) +
        "&SELLER_SERVICE=" + encodeURIComponent(services) +
        "&NUM_SELLER=" + encodeURIComponent(numPhone)
    );

    xml.onload = function() {
        if (xml.status === 200) {
            const response = JSON.parse(xml.responseText);
            if (response.status === "success") {
                window.location.href = "../html/valideseller.html";
            } else {
                document.getElementById("reponceS").innerHTML = `<input type='text' disabled value='${response.message}' style='background:#d64040e2; color:#fff;'>`;
                console.log(response.message);
            }
        }
    };
});
