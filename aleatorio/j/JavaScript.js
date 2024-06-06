document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    const inputs = form.querySelectorAll('.form-input');
    const validationMessages = form.querySelectorAll('.validation-message');

    inputs.forEach((input, index) => {
        input.addEventListener('input', () => validateInput(input, validationMessages[index]));
    });

    function validateInput(input, messageElement) {
        // Verifique se o campo está vazio
        if (input.value.trim() === '') {
            messageElement.textContent = 'Este campo é obrigatório.';
            return;
        }

        // Adicione outras validações conforme necessário
        
        // Se passar por todas as validações, limpe a mensagem de erro
        messageElement.textContent = '';
    }
});
