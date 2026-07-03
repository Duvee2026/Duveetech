document.addEventListener("DOMContentLoaded", () => {
  const el = document.querySelector(".typewriter");
  const fullText = el.getAttribute("data-text"); 
  el.textContent = "";

  const textSpan = document.createElement("span");
  textSpan.className = "tw-text";
  const cursor = document.createElement("span");
  cursor.className = "tw-cursor";
  cursor.textContent = "|";
  el.appendChild(textSpan);
  el.appendChild(cursor);

  let i = 0;
  let isDeleting = false;
  const typingSpeed = 120;
  const deletingSpeed = 70;
  const pauseTime = 1500;

  function typeLoop() {
    if (!isDeleting && i <= fullText.length) {
      textSpan.textContent = fullText.substring(0, i);
      i++;
      setTimeout(typeLoop, typingSpeed);
    } else if (isDeleting && i >= 0) {
      textSpan.textContent = fullText.substring(0, i);
      i--;
      setTimeout(typeLoop, deletingSpeed);
    } else {
      isDeleting = !isDeleting;
      setTimeout(typeLoop, pauseTime);
    }
  }

  typeLoop();
});