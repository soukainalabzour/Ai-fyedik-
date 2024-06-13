document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector("#formlog_S");
    const btn = document.getElementById("submitlog_S");
    const rep = document.getElementById("reponcelog_S");

    form.addEventListener("submit", e => {
        e.preventDefault();
    });

    btn.addEventListener("click", function() {
        const emailog_S = form.elements.emaillog_S.value;
        const passwordlog_S = form.elements.passwordlog_S.value;

        if (!emailog_S || !passwordlog_S) {
            rep.innerHTML = `<input type='text' disabled value='Please fill out all the fields!' style='background:#d64040e2; color:#fff;'>`;
            return;
        }

        const xml = new XMLHttpRequest();
        xml.open("POST", "../php/loginS.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send(`emailS=${encodeURIComponent(emailog_S)}&passwordS=${encodeURIComponent(passwordlog_S)}`);
        
        xml.onload = function () {
            if (xml.readyState === XMLHttpRequest.DONE) {
                if (xml.status === 200) {
                    if (xml.responseText.trim() === "true") {
                        const encodedEmail = encodeURIComponent(emailog_S);
                        window.location.href = `../html/preseller.html?email=${encodedEmail}`;
                    } else {
                        rep.innerHTML = `<input type='text' disabled value='${xml.responseText}' style='background:#d64040e2; color:#fff;'>`;
                        console.log(xml.responseText);
                    }
                }
            }
        };
    });
});
