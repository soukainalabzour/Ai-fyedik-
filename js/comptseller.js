



document.addEventListener("DOMContentLoaded", function () {
  const languagesSelect = document.getElementById("languages");
  const searchInput = document.getElementById("searchInput");
  const selectedLanguagesDisplay = document.getElementById(
    "selectedLanguagesDisplay"
  );

  const selectedLanguagesInput = document.getElementById("selectedLanguages");

  const categoriesSelect = document.getElementById("categories");
  const servicesDiv = document.getElementById("services");

  // Function to filter options based on input value
  function filterOptions() {
    const searchValue = searchInput.value.trim().toLowerCase();
    const options = languagesSelect.querySelectorAll("option");

    options.forEach((option) => {
      const optionText = option.textContent.trim().toLowerCase();
      if (optionText.includes(searchValue)) {
        option.style.display = "";
      } else {
        option.style.display = "none";
      }
    });
  }

  // Fetch categories from PHP and populate select input
  fetch("../php/categories.php")
    .then(response => response.json())
    .then(data => {

      data.categories.forEach(category => {
        console.log(data);
        const option = new Option(category.NOM_CATEGORY, category.ID_CATEGORY);
        option.value = category.ID_CATEGORY;
        categoriesSelect.appendChild(option);
      });
    });

  // Fetch and display services when a category is selected
  categoriesSelect.addEventListener("change", function () {
    const selectedCategoryId = categoriesSelect.value;
    console.log(selectedCategoryId);
    fetchAndDisplayServices(selectedCategoryId);
  });

  //   Function to update selected languages display and hidden input
  function updateSelectedLanguages() {
    let selectedOptions = Array.from(languagesSelect.selectedOptions);
    let selectedValues = selectedOptions.map((option) => option.textContent);
    let selectedIds = selectedOptions.map((option) => option.value);
    selectedLanguagesDisplay.value = selectedValues.join(", ");
    selectedLanguagesInput.value = selectedIds.join(",");
    console.log(selectedLanguagesDisplay.value);
    console.log(selectedLanguagesInput.value);
  }

  // Attach filterOptions function to input event
  searchInput.addEventListener("input", filterOptions);

  // Show dropdown when the input is focused
  searchInput.addEventListener("focus", function () {
    languagesSelect.classList.add("show");
  });

  // Hide dropdown when clicking outside of input or select
  document.addEventListener("click", function (event) {
    if (!document.querySelector(".lang").contains(event.target)) {
      languagesSelect.classList.remove("show");
    }
  });

  // Prevent hiding when clicking inside the select box
  languagesSelect.addEventListener("mousedown", function (event) {
    event.preventDefault();
  });

  // Update selected languages when an option is selected
  languagesSelect.addEventListener("change", updateSelectedLanguages);


  // Function to fetch and display services for the selected category
  function fetchAndDisplayServices(id_category) {

    fetch(`../php/services.php?id_category=${id_category}`)
      .then(response => response.json())
      .then(data => {
        servicesDiv.innerHTML = '';
        data.services.forEach(service => {
          const checkbox = document.createElement('input');
          checkbox.type = 'checkbox';
          checkbox.id = `service-${service.ID_SERVICE}`;
          checkbox.name = 'services';
          checkbox.value = service.ID_SERVICE;
          checkbox.classList.add("all_service");  

          const label = document.createElement('label');
          label.htmlFor = `service-${service.ID_SERVICE}`;
          label.textContent = service.NOM_SERVICE;

          servicesDiv.appendChild(checkbox)
          servicesDiv.appendChild(label);
          servicesDiv.appendChild(document.createElement('br'));
        });
        console.log(data);
      });
  }



  // Fetch languages from PHP and populate select input
  fetch("../php/comptseller.php")
    .then((response) => response.json())
    .then((data) => {
      data.languages.forEach((language) => {
        const option = new Option(language.NOM_LANGUE);
        languagesSelect.appendChild(option);
      });
      const options = languagesSelect.querySelectorAll("option");
      console.log(options);

      options.forEach((el) => {
        el.addEventListener("click", () => {
          selectedLanguagesDisplay.value += el.innerHTML +",";
          selectedLanguagesInput.value +=  el.innerHTML +",";
        });
      });
    });
});



document.addEventListener('DOMContentLoaded', (event) => {
  const addTaskButton = document.getElementById('add-task-button');
  const newTaskInput = document.getElementById('new-skill');
  const taskList = document.getElementById('task-list');

  addTaskButton.addEventListener('click', () => {
    const taskText = newTaskInput.value.trim();
    if (taskText !== '') {
      addTask(taskText);
      newTaskInput.value = '';
    }
  });

  newTaskInput.addEventListener('keypress', (event) => {
    if (event.key === 'Enter') {
      const taskText = newTaskInput.value.trim();
      if (taskText !== '') {
        addTask(taskText);
        newTaskInput.value = '';
      }
    }
  });

  function addTask(taskText) {
    const li = document.createElement('li');

    const taskSpan = document.createElement('span');
    taskSpan.textContent = taskText;
    taskSpan.addEventListener('click', () => {
      li.classList.toggle('completed');
    });

    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.addEventListener('click', () => {
      taskList.removeChild(li);
    });

    li.appendChild(taskSpan);
    li.appendChild(deleteButton);
    taskList.appendChild(li);
  }
});




// let submatBtn=document.getElementById("submit_S")

// submatBtn.addEventListener("click",()=>{
//   const numPhone=document.getElementById("numPhone").value
//   const lnameS=document.getElementById("lnameS").value
//   const fnameS=document.getElementById("fnameS").value
//   const description=document.getElementById("description").value
//   const lang=document.getElementById("selectedLanguages").value
//   const lien=document.getElementById("lien").value
//   const categories=document.getElementById("categories").value
//   const services=document.getElementById("services").value
//   const taskList=document.querySelectorAll("#task-list li")
//   let skils=""
//   taskList.forEach(el=>{
//     skils+=","+el.innerHTML
//   })

//   let xml = new XMLHttpRequest();
//     xml.open("POST", "../php/comptClient.php", true);
//     xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xml.send(
//         "NOM_SELLER=" + encodeURIComponent(lnameS) +
//         "&PRENOM_SELLER=" + encodeURIComponent(fnameS) +
//         "&DESCRIPTION_SELLER=" + encodeURIComponent(description) +
//         "&SELLER_SKILL=" + encodeURIComponent(skils) +
//         "&SELLER_CATEGORY=" + encodeURIComponent(categories)+
//         "&SELLER_SERVICE=" + encodeURIComponent(lang)+
//         "&LIEN_SELLER=" + encodeURIComponent(lien)+
//         "&SELLER_SERVICE=" + encodeURIComponent(services)+
//         "&NUM_SELLER=" + encodeURIComponent(numPhone)
//     );

//     xml.onload = function() {
//         if (xml.readyState === XMLHttpRequest.DONE) {
//             if (xml.status === 200) {
//                 const response = JSON.parse(xml.responseText);
//                 if (response.status === "success") {
//                     window.location.href = "../html/profilvalide.html";
//                 } else {
//                     rep.innerHTML = `<input type='text' disabled value='${response.message}' style='background:#d64040e2; color:#fff;'>`;
//                     console.log(response.message);
//                 }
//             }
//         }
//     };
// })


