document.addEventListener('DOMContentLoaded', () => {
    const accountDropdown = document.querySelector('.account-dropdown');
    const accountBtn = document.querySelector('.account-btn');

    // Toggle dropdown on click
    accountBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        accountDropdown.classList.toggle('active');
    });

    // Close dropdown when clicking anywhere else
    document.addEventListener('click', () => {
        accountDropdown.classList.remove('active');
    });

    // Prevent closing when clicking inside menu
    accountDropdown
        .querySelector('.dropdown-menu')
        .addEventListener('click', (e) => {
            e.stopPropagation();
        });

    // Smooth scroll for all anchor links
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach((link) => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // GitHub fetch example
    fetch('https://github.com/Ftmaroselers/Activity3.1_CarsLocation')
        .then((response) => response.json())
        .then((repos) => {
            const projectList = document.querySelector('.project-list');
            repos.forEach((repo) => {
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

    // Page transition helper
    window.transitionToPage = (page) => {
        let content = document.getElementById('page-content');
        content.classList.add('slide-up');
        setTimeout(() => {
            window.location.href = page;
        }, 650);
    };
});
document.addEventListener('DOMContentLoaded', () => {
    const navHome = document.getElementById('navHome');
    const aboutBtn = document.getElementById('aboutBtn');
    const introSection = document.getElementById('intro');
    const homeSection = document.getElementById('home');

    // Show intro when clicking About Me button
    aboutBtn.addEventListener('click', (e) => {
        e.preventDefault();
        homeSection.classList.add('hide');
        introSection.style.display = 'block';
        setTimeout(() => introSection.classList.add('show'), 50);
    });

    // Show home when clicking Home in navbar
    navHome.addEventListener('click', (e) => {
        e.preventDefault();
        introSection.classList.remove('show');
        setTimeout(() => introSection.style.display = 'none', 500);

        homeSection.classList.remove('hide');
        homeSection.scrollIntoView({ behavior: 'smooth' });
    });
});


