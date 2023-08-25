const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");


// show sidebar
menuBtn.addEventListener('click', () =>{
    sideMenu.style.display = 'block';
})

//close sidebar
closeBtn.addEventListener('click', () =>{
    sideMenu.style.display = 'none';
})

// change theme
themeToggler.addEventListener('click', () => {
    document.body.classList.toggle('dark-theme-variables');

    themeToggler.querySelector('span').classList.toggle('active');
})

// fill orders in table
Patient.forEach(patient => {
    const tr = document.createElement('tr');
    const trContent = `
                        <td>${Patient.clientName}</td>
                        <td>${Patient.clientNumber}</td>
                        <td>${Patient.clientPet}</td>
                        <td>${Patient.petBreed}</td>
                        <td>${Patient.address}</td>
                        <td class="warning">${Patient.status === 'Declined' ? 'danger' : Patient.status === 'pending' ? 'warning': 'primary'}</td>
                        <td class="primary">${Patient.details}</td>
                `;
    tr.innerHTML = trContent;
    document.querySelector('table tbody').appendChild(tr);
})



