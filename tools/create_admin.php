<?php
declare(strict_types=1);
if (PHP_SAPI !== 'cli') { http_response_code(403); exit('Somente terminal.'); }
require __DIR__ . '/../app/bootstrap.php';
if ($argc !== 4) {
    fwrite(STDERR, 'Uso: php tools/create_admin.php "Nome Completo" 00000000000 "Senha-Forte"' . PHP_EOL);
    exit(1);
}
$name = trim($argv[1]);
$cpf = preg_replace('/\D+/', '', $argv[2]);
$password = $argv[3];
if (mb_strlen($name) < 3 || strlen($cpf) !== 11 || strlen($password) < 12) {
    fwrite(STDERR, 'Nome, CPF ou senha invalidos. A senha precisa ter 12 caracteres ou mais.' . PHP_EOL);
    exit(1);
}
try {
    q("INSERT INTO usuarios(nome,cpf,senha_hash,papel) VALUES(?,?,?,'coordenador')", [
        $name, $cpf, password_hash($password, PASSWORD_DEFAULT)
    ]);
    echo 'Coordenador criado.' . PHP_EOL;
} catch (PDOException $e) {
    fwrite(STDERR, 'Falha ao criar conta: verifique conexao e duplicidade de CPF.' . PHP_EOL);
    exit(1);
}
