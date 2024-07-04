document.addEventListener('DOMContentLoaded', () => {
    const sideMenu = document.querySelector('aside');
    const menuBtn = document.getElementById('menu-btn');
    const closeBtn = document.getElementById('close-btn');
    const darkMode = document.querySelector('.dark-mode');
    const darkModeSpans = darkMode.querySelectorAll('span');

    // Função para verificar a preferência de tema armazenada
    const applyDarkModePreference = () => {
        const isDarkMode = localStorage.getItem('darkMode') === 'true';
        if (isDarkMode) {
            document.body.classList.add('dark-mode-variables');
            darkModeSpans.forEach(span => span.classList.add('active'));
        }
    };

    // Aplica a preferência de tema ao carregar a página
    applyDarkModePreference();

    // Exibe o menu lateral
    menuBtn.addEventListener('click', () => {
        sideMenu.style.display = 'block';
    });

    // Fecha o menu lateral
    closeBtn.addEventListener('click', () => {
        sideMenu.style.display = 'none';
    });

    // Alterna entre os modos claro e escuro
    darkMode.addEventListener('click', () => {
        const isDarkModeEnabled = document.body.classList.toggle('dark-mode-variables');
        darkModeSpans.forEach(span => span.classList.toggle('active'));

        // Salva a preferência de tema no localStorage
        localStorage.setItem('darkMode', isDarkModeEnabled ? 'true' : 'false');
    });
});

