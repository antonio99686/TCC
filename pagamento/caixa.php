<?php

include('../conexao.php');
class Caixa {
    private $saldo;

    public function __construct($saldoInicial) {
        $this->saldo = $saldoInicial;
    }

    public function getSaldo() {
        return $this->saldo;
    }

    public function adicionarDinheiro($valor) {
        $this->saldo += $valor;
    }

    public function removerDinheiro($valor) {
        if ($valor <= $this->saldo) {
            $this->saldo -= $valor;
            return true;
        } else {
            return false; // Saldo insuficiente
        }
    }
}

class Pagamento {
    public static function pagarComPix($valor) {
        // Lógica para pagamento com PIX
        return true; // Retorna true se o pagamento for bem-sucedido, ou false se falhar
    }

    // Função para registrar transação no banco de dados
    public static function registrarTransacao($tipo, $valor) {
        // Conectar ao banco de dados
        $conexao = new mysqli("localhost", "root", "", "sentinelas");

        // Verificar a conexão
        if ($conexao->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
        }

        // Preparar e executar a consulta SQL para inserir a transação
        $sql = "INSERT INTO transacoes (tipo, valor) VALUES ('$tipo', '$valor')";
        if ($conexao->query($sql) === TRUE) {
            echo "Transação registrada com sucesso.";
        } else {
            echo "Erro ao registrar transação: " . $conexao->error;
        }

        // Fechar a conexão
        $conexao->close();
    }
}

// Exemplo de uso
$caixa = new Caixa(1000);

$valorCompra = 500;
if ($caixa->removerDinheiro($valorCompra)) {
    echo "Compra de " . $valorCompra . " reais realizada com sucesso!<br>";
    Pagamento::registrarTransacao("Compra", $valorCompra);
} else {
    echo "Saldo insuficiente para realizar a compra!<br>";
}

$valorPagamento = 200;
if (Pagamento::pagarComPix($valorPagamento)) {
    echo "Pagamento de " . $valorPagamento . " reais realizado com sucesso via PIX!<br>";
    Pagamento::registrarTransacao("Pagamento", $valorPagamento);
} else {
    echo "Falha ao realizar o pagamento via PIX!<br>";
}
?>
