const screenshots = document.querySelectorAll(".screenshots");
const mainImage = document.getElementById("current-screenshot");
const caption = document.getElementById("screenshot-caption");

// affichage

screenshots.forEach((screenshot) => {
  screenshot.addEventListener("click", () => {
    mainImage.src = screenshot.src;
    caption.textContent = screenshot.getAttribute("data-caption");
    screenshots.forEach((scr) => scr.classList.remove("active"));
    screenshot.classList.add("active");
  });
});

// ajout

document.querySelectorAll(".ajout").forEach((button) => {
  button.addEventListener("click", () => {
    document.getElementById("addScreenModal").classList.remove("hidden");
  });
});

document.getElementById("closeModal").addEventListener("click", () => {
  document.getElementById("addScreenModal").classList.add("hidden");
});
