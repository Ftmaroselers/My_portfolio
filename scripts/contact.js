document.addEventListener("DOMContentLoaded", () => {
    const accountDropdown = document.querySelector(".account-dropdown");
    const accountBtn = document.querySelector(".account-btn");

    // Toggle dropdown on click
    accountBtn.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation(); 
        accountDropdown.classList.toggle("active");
    });

    // Close dropdown when clicking anywhere else
    document.addEventListener("click", () => {
        accountDropdown.classList.remove("active");
    });

    // Prevent closing when clicking inside menu
    accountDropdown.querySelector(".dropdown-menu").addEventListener("click", (e) => {
        e.stopPropagation();
    });
});
fetch('https://github.com/Ftmaroselers/Activity3.1_CarsLocation')
.then(response => response.json())
.then(repos => {
    const projectList = document.querySelector('.project-list');
    repos.forEach(repo => {
        const card = document.createElement('div');
        card.className = 'project-card';
        card.innerHTML = `
            <h3>${repo.name}</h3>
            <p>${repo.description || 'No description'}</p>
            <a href="${repo.html_url}" target="_blank"><i class="fab fa-github"></i> View on GitHub</a>
        `;
        projectList.appendChild(card);
    });
});
