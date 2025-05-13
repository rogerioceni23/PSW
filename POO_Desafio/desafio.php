<?php

class ContaBancaria {
    private $titular;
    private $saldo;

    public function __construct($titular, $saldoInicial = 0) {
        $this->titular = $titular;
        $this->saldo = $saldoInicial;
    }

    public function depositar($valor) {
        if ($valor > 0) {
            $this->saldo += $valor;
            return "Depósito de R$$valor realizado. Saldo atual: R$" . $this->saldo;
        } else {
            return "Valor de depósito inválido.";
        }
    }

    public function sacar($valor) {
        if ($valor <= $this->saldo) {
            $this->saldo -= $valor;
            return "Saque de R$$valor realizado. Saldo atual: R$" . $this->saldo;
        } else {
            return "Saldo insuficiente para saque de R$$valor. Saldo atual: R$" . $this->saldo;
        }
    }

    public function getSaldo() {
        return $this->saldo;
    }
}

$mensagem = "";
$conta = new ContaBancaria("João", 0);

// Processa formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['depositar'])) {
        $valor = floatval($_POST['valor']);
        $mensagem = $conta->depositar($valor);
    } elseif (isset($_POST['sacar'])) {
        $valor = floatval($_POST['valor']);
        $conta->depositar(500); // Inicializa com R$500
        $mensagem = $conta->sacar($valor);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Conta Bancária</title>
</head>
<body>
    <h1>Simulador de Conta Bancária</h1>

    <form method="post">
        <label>Valor (R$):</label>
        <input type="number" name="valor" step="0.01" required>
        <br><br>
        <button type="submit" name="depositar">Depositar</button>
        <button type="submit" name="sacar">Sacar</button>
    </form>

    <p><strong><?php echo $mensagem; ?></strong></p>
    
</body>
</html>