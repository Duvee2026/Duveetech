const track = document.querySelector(".carousel-track");
const items = document.querySelectorAll(".carousel-item");
const prevBtn = document.querySelector(".carousel-btn.left");
const nextBtn = document.querySelector(".carousel-btn.right");
const dotsContainer = document.querySelector(".carousel-dots");

let slidesPerPage = getSlidesPerPage();
let totalPages = Math.ceil(items.length / slidesPerPage);
let currentPage = 0;

function getSlidesPerPage() {
  if (window.innerWidth >= 992) return 4;
  if (window.innerWidth >= 768) return 2;
  return 1;
}

function updateCarousel() {
  const itemWidth = items[0].offsetWidth;
  const maxOffset = (items.length - slidesPerPage) * itemWidth;

  // Calculate current offset
  let offset = currentPage * itemWidth * slidesPerPage;

  // Prevent scrolling into empty space
  if (offset > maxOffset) {
    offset = maxOffset;
  }

  track.style.transform = `translateX(-${offset}px)`;

  // Update dots
  document.querySelectorAll(".dot").forEach((dot, i) => {
    dot.classList.toggle("active", i === currentPage);
  });
}


function createDots() {
  dotsContainer.innerHTML = "";
  for (let i = 0; i < totalPages; i++) {
    const dot = document.createElement("span");
    dot.classList.add("dot");
    if (i === 0) dot.classList.add("active");
    dot.addEventListener("click", () => {
      currentPage = i;
      updateCarousel();
    });
    dotsContainer.appendChild(dot);
  }
}

prevBtn.addEventListener("click", () => {
  currentPage = (currentPage - 1 + totalPages) % totalPages;
  updateCarousel();
});

nextBtn.addEventListener("click", () => {
  currentPage = (currentPage + 1) % totalPages;
  updateCarousel();
});

window.addEventListener("resize", () => {
  slidesPerPage = getSlidesPerPage();
  totalPages = Math.ceil(items.length / slidesPerPage);
  currentPage = 0;
  createDots();
  updateCarousel();
});

// Init
createDots();
updateCarousel();
