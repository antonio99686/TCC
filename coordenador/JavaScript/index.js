const sideMenu = document.querySelector("aside");
const menuBtn = document.getElementById("menu-btn");
const closeBtn = document.getElementById("close-btn");

const darkMode = document.querySelector(".dark-mode");

// Verifica se há uma preferência de tema armazenada
const isDarkMode = localStorage.getItem("darkMode") === "true";

// Aplica a classe dark-mode-variables se necessário
if (isDarkMode) {
  document.body.classList.add("dark-mode-variables");
  darkMode.querySelector("span:nth-child(2)").classList.add("active");
} else {
  darkMode.querySelector("span:nth-child(1)").classList.add("active");
}

menuBtn.addEventListener("click", () => {
  sideMenu.style.display = "block";
});

closeBtn.addEventListener("click", () => {
  sideMenu.style.display = "none";
});

darkMode.addEventListener("click", () => {
  // Alterna entre os modos claro e escuro
  document.body.classList.toggle("dark-mode-variables");
  
  const darkIcon = darkMode.querySelector("span:nth-child(2)");
  const lightIcon = darkMode.querySelector("span:nth-child(1)");
  
  // Alterna as classes dos ícones
  darkIcon.classList.toggle("active");
  lightIcon.classList.toggle("active");

  // Salva a preferência de tema no localStorage
  const isDarkModeEnabled = document.body.classList.contains("dark-mode-variables");
  localStorage.setItem("darkMode", isDarkModeEnabled ? "true" : "false");
});



