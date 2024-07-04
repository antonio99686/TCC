<style>
	*{
		padding: 0;
		margin: 0;
		border: 0;
	}
	
	#form-checkout {
      display: flex;
      flex-direction: column;
      width: 60%;
	  margin: 100px 20%;
	  padding: 10px 20px;
	  background-color: #eee;	
    }

    .container {
      height: auto;
      display: block;
	  margin-top: 10px; 
    }
	
	.container iframe{
		background-color: #fff !important;
		padding: 10px 20px !important;
		width: 95.6%;
		height: 18px !important;
	}
	
	h1{
		font-size: 1.6em;
		font-weight: 600;
		font-family: 'Montserrat', sans-serif;
		text-transform: uppercase;
		margin-top: 30px;
	}
	
	p{
		font-size: 1em;
		font-weight: 400;
		font-family: 'Montserrat', sans-serif;
		text-align: center;
		margin: 10px 0;
	}
	
	label{
		margin-top: 10px;
		margin-bottom: 3px;
		font-size: 1em;
		font-weight: 400;
		font-family: 'Montserrat', sans-serif;
		display: block;
	}
	
	input[type=text], input[type=email], input[type=number]{
		padding: 10px 20px;
		margin-top: 10px;
		margin-bottom: 3px;
		font-size: 1em;
		font-weight: 400;
		font-family: 'Montserrat', sans-serif;
		display: block;
		background-color: #fff;
		width: 100%;
	}
	
	select{
		padding: 10px 20px;
		margin-top: 10px;
		margin-bottom: 3px;
		font-size: 1em;
		font-weight: 400;
		font-family: 'Montserrat', sans-serif;
		display: block;
		background-color: #fff;
		width: 100%;
	}
	
	button{
		margin-top: 10px;
		padding: 10px 20px;
		font-size: 1em;
		font-weight: 400;
		font-family: 'Montserrat', sans-serif;
		width: 100%;
		background-color: #662747;
		color: #fff;
		border-radius: 5px;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		cursor: pointer;
	}
	
	button:hover{
		background-color: #511f38;
	}
	
</style>

<!-- Examplo retirado da documentação: https://www.mercadopago.com.br/developers/pt/docs/checkout-api/integration-configuration/card/integrate-via-cardform -->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://sdk.mercadopago.com/js/v2"></script>
  <script type="text/javascript" src="index.js" defer></script>
  
  <script>
    const mp = new MercadoPago("TEST-#");
  </script>
  
  
  <form id="form-checkout" action="process_payment.php" method="POST">

      <label for="payerFirstName">Nome</label>
      <input id="form-checkout__payerFirstName" name="payerFirstName" type="text" value="Jeferson">

      <label for="payerLastName">Sobrenome</label>
      <input id="form-checkout__payerLastName" name="payerLastName" type="text" value="Souza">

      <label for="identificationEmail">E-mail</label>
      <input id="form-identificationEmail" name="identificationEmail" type="text" value="contato@mestresdophp.com.br">

      <label for="identificationType">Tipo de documento</label>
      <select id="form-checkout__identificationType" name="identificationType" type="text"></select>

      <label for="identificationNumber">Número do documento</label>
      <input id="form-checkout__identificationNumber" name="identificationNumber" type="text" value="19119119100">

      <label for="description">Produto</label>
      <input type="text" name="description" id="description" value="Produto Teste">

      <label for="transactionAmount">Valor do Produto</label>
      <input type="text" name="transactionAmount" id="transactionAmount" value="100">

      <br>

    <button type="submit" id="form-checkout__submit">Gerar Pix</button>
  </form>
