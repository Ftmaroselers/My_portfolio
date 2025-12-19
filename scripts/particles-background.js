const canvas = document.getElementById("techCanvas");
const ctx = canvas.getContext("2d");

// ===== Resize =====
function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}
resizeCanvas();
window.addEventListener("resize", resizeCanvas);

// ===== Wavy Lines Settings =====
const LINE_COUNT = 100;          
const LINE_COLOR = "rgba(84, 14, 170, 0.78)";
let time = 0;
let isPaused = false;
let animationId;

// ===== Stars Settings =====
const STAR_COUNT = 300;
let stars = [];

// Initialize stars
function initStars() {
    stars = [];
    for (let i = 0; i < STAR_COUNT; i++) {
        stars.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            size: Math.random() * 2,
            alpha: Math.random()
        });
    }
}
initStars();

// ===== Draw Galaxy Background =====
function drawBackground() {
    // Galaxy gradient
    const gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
    gradient.addColorStop(0, "#0b0f14"); // dark blue/black
    gradient.addColorStop(0.5, "#06020eff"); // deep purple
    gradient.addColorStop(1, "#0b0f14");

    ctx.fillStyle = gradient;
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    stars.forEach(star => {
        ctx.beginPath();
        ctx.arc(star.x, star.y, star.size, 0, Math.PI * 6);
        ctx.fillStyle = `rgba(255,255,255,${star.alpha})`;
        ctx.fill();
    });
}
function drawWaves() {
    const baseY = canvas.height - 150; 
    const spacing = 10;

    for (let i = 0; i < LINE_COUNT; i++) {
        const amplitude = 4 + i * 0.5;       
        const frequency = 0.008 + i * 0.001; 
        const yOffset = baseY + i * spacing;

        ctx.beginPath();
        ctx.strokeStyle = LINE_COLOR;
        ctx.lineWidth = 1.5;

        for (let x = 0; x <= canvas.width; x += 10) {
            const y = Math.sin(x * frequency + time * 0.03) * amplitude + yOffset;
            if (x === 0) {
                ctx.moveTo(x, y);
            } else {
                ctx.lineTo(x, y);
            }
        }
        ctx.stroke();
    }
}

// ===== Animation Loop =====
function update() {
    drawBackground();
    if (!isPaused) time++;
    drawWaves();
    animationId = requestAnimationFrame(update);
}

// Start animation
update();

// ===== Play/Pause Button =====
document.addEventListener("DOMContentLoaded", () => {
    const particleControl = document.getElementById("particleControl");
    const particleIcon = document.getElementById("particleIcon");

    if (!particleControl) return;

    particleControl.addEventListener("click", () => {
        isPaused = !isPaused;

        if (isPaused) {
            particleIcon.classList.replace("fa-pause", "fa-play");
        } else {
            particleIcon.classList.replace("fa-play", "fa-pause");
        }

        // Stop/resume title-image animation
        document.body.classList.toggle("stop-animation", isPaused);
    });
});
