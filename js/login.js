document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector("#formlog");
    const btn = document.getElementById("submit_log");
    const rep = document.getElementById("reponcelog");

    form.addEventListener("submit", e => {
        e.preventDefault();
    });

    btn.addEventListener("click", function() {
        const emailog = form.elements.email_log.value;
        const passwordlog = form.elements.password_log.value;

        if (!emailog || !passwordlog) {
            rep.innerHTML = `<input type='text' disabled value='Please fill out all the fields!' style='background:#d64040e2; color:#fff;'>`;
            return;
        }

        const xml = new XMLHttpRequest();
        xml.open("POST", "../php/login.php", true);
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xml.send(`email_log=${encodeURIComponent(emailog)}&password_log=${encodeURIComponent(passwordlog)}`);
        
        xml.onload = function () {
            if (xml.readyState === XMLHttpRequest.DONE) {
                if (xml.status === 200) {
                    if (xml.responseText.trim() == "client") {
                        const encodedEmail = encodeURIComponent(emailog);
                        window.location.href = `../html/profilvalide.html?email=${encodedEmail}`;
                    }if (xml.responseText.trim() == "admin") {
                        const encodedEmail = encodeURIComponent(emailog);
                        window.location.href = `../admin/index.html?email=${encodedEmail}`;
                    } else {
                        rep.innerHTML = `<input type='text' disabled value='${xml.responseText}' style='background:#d64040e2; color:#fff;'>`;
                        console.log(xml.responseText);
                    }
                }
            }
        };
    });
});
