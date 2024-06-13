let formCl = document.querySelector("#formCl");

fetch("../php/profilvalide.php",  {
    headers: {
        "Content-Type": "application/json"
    }
})
.then(responce => responce.json())
.then(data=> {
    console.log(data)
    
    
    
});
