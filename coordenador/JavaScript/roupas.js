// Seleção de elementos do DOM
const openSearchBox = document.getElementById('openSearchBox');
const modal = document.getElementById('userSelectionModal');
const closeModal = document.getElementsByClassName('close')[0];
const userSearchInput = document.getElementById('userSearchInput');
const userList = document.getElementById('userList');
const selectedUserDetails = document.getElementById('selectedUserDetails');
const saveClothingButton = document.getElementById('saveClothingButton');

// Event listener para abrir o modal de seleção
openSearchBox.addEventListener('click', function() {
    modal.style.display = 'block';
});

// Event listener para fechar o modal
closeModal.addEventListener('click', function() {
    modal.style.display = 'none';
});

// Event listener para clicar fora do modal e fechá-lo
window.addEventListener('click', function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
});

// Função para buscar usuários ao digitar no campo de busca
userSearchInput.addEventListener('input', function() {
    const searchText = userSearchInput.value.trim();

    // Limpa a lista de usuários
    userList.innerHTML = '';

    // Verifica se o texto de busca não está vazio
    if (searchText.length > 0) {
        // Faz uma requisição AJAX para buscar usuários
        fetch('buscar_usuarios.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'termo=' + encodeURIComponent(searchText)
        })
        .then(response => response.json())
        .then(data => {
            // Processa os resultados da busca
            if (data.error) {
                console.error(data.error);
                return;
            }

            // Cria itens da lista de usuários
            data.forEach(usuario => {
                const li = document.createElement('li');
                li.textContent = usuario.nome;
                li.setAttribute('data-id', usuario.id_usuario);
                li.classList.add('user-item');
                userList.appendChild(li);

                // Event listener para selecionar um usuário
                li.addEventListener('click', function() {
                    selectUser(usuario.id_usuario, usuario.nome);
                });
            });
        })
        .catch(error => console.error('Erro ao buscar usuários:', error));
    }
});

// Função para selecionar um usuário e exibir detalhes
function selectUser(userId, userName) {
    // Exibe o nome do usuário selecionado
    selectedUserDetails.textContent = 'Usuário Selecionado: ' + userName;

    // Aqui você pode adicionar mais lógica para exibir detalhes adicionais do usuário
}

// Event listener para salvar as roupas selecionadas (exemplo)
saveClothingButton.addEventListener('click', function() {
    // Aqui você pode implementar a lógica para salvar as roupas selecionadas
    console.log('Roupas salvas!');
});
