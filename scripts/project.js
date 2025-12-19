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

const carousel = document.querySelector(".carousel");
const list = carousel.querySelector(".list");
const items = Array.from(list.querySelectorAll(".item"));
const thumbnails = Array.from(carousel.querySelectorAll(".thumbnail .item"));
const prevBtn = document.getElementById("prev");
const nextBtn = document.getElementById("next");
const timeBar = carousel.querySelector(".time");

let currentIndex = 0;
let isAnimating = false;
const animDuration = 500; // transition duration
const runningTime = 5000; // auto slide duration

function updateCarousel(index){
    items.forEach((item,i)=>{
        item.style.opacity = i===index ? 1 : 0;
        item.style.zIndex = i===index ? 1 : 0;
    });
    thumbnails.forEach((thumb,i)=>{
        thumb.classList.toggle("active", i===index);
    });
    // animate progress bar
    timeBar.style.width = "0%";
    timeBar.animate([{width:"0%"},{width:"100%"}],{
        duration: runningTime,
        easing:"linear",
        fill:"forwards"
    });
}

function nextSlide(){
    if(isAnimating) return;
    isAnimating = true;
    currentIndex = (currentIndex+1)%items.length;
    updateCarousel(currentIndex);
    setTimeout(()=>isAnimating=false, animDuration);
}

function prevSlide(){
    if(isAnimating) return;
    isAnimating = true;
    currentIndex = (currentIndex-1+items.length)%items.length;
    updateCarousel(currentIndex);
    setTimeout(()=>isAnimating=false, animDuration);
}

// navigation buttons
nextBtn.addEventListener("click", nextSlide);
prevBtn.addEventListener("click", prevSlide);

// auto-slide
setInterval(nextSlide, runningTime);
updateCarousel(currentIndex);
