<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Alerta com SweetAlert2</title>
	<!--  SweetAlert2 CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
</head>

<body>
	<!--  SweetAlert2 JS -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!--  script customizado -->
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			// Função para mostrar alerta de sucesso
			function mostrarAlertaSucesso() {
				Swal.fire({
					icon: 'success',
					title: 'Cadastrado com Sucesso!',
					showConfirmButton: false,
					timer: 1500 // Tempo em milissegundos (1.5 segundos)
				});
			}

			// Função para mostrar alerta de erro
			function mostrarAlertaErro() {
				Swal.fire({
					icon: 'error',
					title: 'Erro!',
					text: 'Algo deu errado. Por favor, tente novamente.',
					confirmButtonColor: '#dc3545' // Cor do botão de confirmação
				});
			}

			// Event listener para o botão de "Cadastrar com Sucesso"
			document.getElementById('botao-sucesso').addEventListener('click', function () {
				mostrarAlertaSucesso();
			});

			// Event listener para o botão de "Cadastrar com Erro"
			document.getElementById('botao-erro').addEventListener('click', function () {
				mostrarAlertaErro();
			});
		});
	</script>

	<!-- Botão para simular um cadastro bem-sucedido -->
	<button id="botao-sucesso">Cadastrar com Sucesso</button>

	<!-- Botão para simular um cadastro com erro -->
	<button id="botao-erro">Cadastrar com Erro</button>
</body>

</html>