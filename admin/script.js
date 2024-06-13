document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.sidebar nav ul li a');
    const sections = document.querySelectorAll('main section');
     const clientsTableBody = document.querySelector('#clients tbody');
     const sellersTableBody = document.querySelector('#sellers tbody');
     const adminsTableBody = document.querySelector('#admins tbody');
     const ordersTableBody = document.querySelector('#orders tbody');

    function showSection(targetId) {
        sections.forEach(section => {
            section.classList.remove('active-section');
            if(section.id === targetId) {
                section.classList.add('active-section');
            }
        });
    }

    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = e.target.getAttribute('href').substring(1);
            showSection(targetId);
        });
    });



    //dashboard total
    
    fetch("dashboard.php",  {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(responce => responce.json())
    .then(data=> {
        console.log(data);
        document.getElementById('total-users').textContent = data['TOTAL_ADMIN'];
        document.getElementById('total-clients').textContent = data['TOTAL_CLIENT'];
        document.getElementById('total-sellers').textContent = data['TOTAL_SELLER'];
        document.getElementById('total-projects').textContent = data['TOTAL_ORDER'];
        
    });

 

    // Populate the clients table

    fetch("getClient.php",  {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(responce => responce.json())
    .then(data=> {
        console.log(data);
        data.forEach(client => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${client.NOM_CLIENT}</td>
                <td>${client.PRENOM_CLIENT}</td>
                <td>${client.EMAIL_CLIENT}</td>
                <td>${client.LANGUAGE_CLIENT}</td>
                <td>${client.PAYS_CLIENT}</td>
                <td>${client.VILLE_CLIENT}</td>
                <td>${client.ADRESSE_CLIENT}</td>
                <td>${client.NUM_CLIENT}</td>
                <td>
                    <button><a href="editClient.php?idC=${client.ID_CLIENT}">Edit</a></button> 
                    <button><a href="deleteClient.php?idC=${client.ID_CLIENT}">Delete</a></button>
                </td>
            `;
            clientsTableBody.appendChild(row);

        });
        
    });




    // Populate the sellers table

    fetch("getSeller.php",  {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(responce => responce.json())
    .then(data=> {
        console.log(data);
        data.forEach(seller => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${seller.NOM_SELLER}</td>
                <td>${seller.PRENOM_SELLER}</td>
                <td>${seller.DESCRIPTION_SELLER}</td>
                <td>${seller.LIEN_SELLER}</td>
                <td>${seller.EMAIL_SELLER}</td>
                <td>${seller.NUM_SELLER}</td>
                <td>
                    <button><a href="editSeller.php?idS=${seller.ID_SELLER}">Edit</a></button> 
                    <button><a href="deleteSeller.php?idS=${seller.ID_SELLER}">Delete</a></button>
                </td>
            `;
            sellersTableBody.appendChild(row);
        });
        
    });
    
  

    // Populate the admins table
    fetch("getAdmin.php",  {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(responce => responce.json())
    .then(data=> {
        console.log(data);
        data.forEach(admin => {
            const row = document.createElement('tr');
            row.innerHTML = `
               <td>${admin.NOM_ADMIN}</td>
                <td>${admin.PRENOM_ADMIN}</td>
                <td>${admin.EMAIL_ADMIN}</td>
                <td>
                    <button><a href="editAdmin.php?idA=${admin.ID_ADMIN}">Edit</a></button> 
                    <button><a href="deleteAdmin.php?idA=${admin.ID_ADMIN}">Delete</a></button>
                </td>
            `;
            adminsTableBody.appendChild(row);
        });
        
    });




    // Populate the orders table
    fetch("getOrder.php",  {
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(responce => responce.json())
    .then(data=> {
        console.log(data);
        data.forEach(order => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${order.NOM_CLIENT}</td>
                <td>${order.NOM_SERVICE}</td>
                <td>${order.NOM_CATEGORY}</td>
                <td>${order.DATE_ORDER}</td>
                <td>${order.ETAT_ORDER}</td>
                <td>
                    <button><a href="deleteOrder.php?idO=${order.ID_ORDER}">Delete</a></button>
                </td>
            `;
            ordersTableBody.appendChild(row);
        });
        
    });

    
//     const ordersTableBody = document.querySelector('#orders tbody');
//     orders.forEach(order => {
//         const row = document.createElement('tr');
//         row.innerHTML = `
//             <td>${order.id}</td>
//             <td>${order.client}</td>
//             <td>${order.seller}</td>
//             <td>${order.status}</td>
//             <td><button>Edit</button> <button>Delete</button></td>
//         `;
//         ordersTableBody.appendChild(row);
//     });
// });

// document.addEventListener('DOMContentLoaded', function() {
//     // Example for handling profile settings click
//     document.getElementById('profile-settings').addEventListener('click', function() {
//         // Code to show profile settings modal or navigate to profile settings page
//     });

//     // Similarly, add event listeners for other settings buttons
//     document.getElementById('theme-settings').addEventListener('click', function() {
//         // Code to show theme settings modal or navigate to theme settings page
//     });

//     // Add more event listeners for other buttons...
});

