const sideMenu = document.querySelector('aside');
const menuBar = document.getElementById('menu-bar');
const darkModeSwitch = document.getElementById('darkModeSwitch');

// Verifica se há uma preferência de tema armazenada
const isDarkMode = localStorage.getItem('darkMode') === 'true';

// Aplica a classe dark-mode-variables se necessário
if (isDarkMode) {
    document.body.classList.add('dark-mode-variables');
    darkModeSwitch.checked = true;
}

menuBar.addEventListener('click', () => {
    sideMenu.classList.toggle('open');
});

darkModeSwitch.addEventListener('change', () => {
    document.body.classList.toggle('dark-mode-variables');
    const isDarkModeEnabled = document.body.classList.contains('dark-mode-variables');
    localStorage.setItem('darkMode', isDarkModeEnabled ? 'true' : 'false');
});
