<?php
//Documentação - Código de Descriptografia
$chave = file_get_contents('chave.txt');
if ($chave === false) {
    echo "Erro: Falha ao ler a chave do arquivo." . PHP_EOL;
    exit();
}

$file = fopen('mensagens_cifradas.txt', 'r');
if ($file === false) {
    echo "Erro: Falha ao abrir o arquivo de mensagens cifradas." . PHP_EOL;
    exit();
}

while (($linha = fgets($file)) !== false) {
    $linha = trim($linha);

    // Converte a linha hexadecimal de volta para valores binários
    $dadosBinarios = hex2bin($linha);

    // Verifica se a linha possui o tamanho esperado (IV + cifra)
    if (strlen($dadosBinarios) < (SODIUM_CRYPTO_SECRETBOX_NONCEBYTES + SODIUM_CRYPTO_SECRETBOX_MACBYTES)) {
        echo "Erro: Linha inválida no arquivo de mensagens cifradas." . PHP_EOL;
        continue;
    }

    // Extrai o IV e a cifra dos dados binários
    $iv = substr($dadosBinarios, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
    $cifra = substr($dadosBinarios, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);

    // Descriptografa a mensagem
    $mensagemClara = sodium_crypto_secretbox_open($cifra, $iv, $chave);
    if ($mensagemClara === false) {
        echo "Erro: Falha ao descriptografar a mensagem: " . $linha . PHP_EOL;
        continue;
    }

    echo "Mensagem Decifrada: " . $mensagemClara . PHP_EOL;
    echo "Mensagem Criptografada: " . $linha . PHP_EOL;
}

fclose($file);

/*
Este código recupera as mensagens cifradas armazenadas no arquivo mensagens_cifradas.txt e realiza a descriptografia usando a chave armazenada no arquivo chave.txt. Ele lê cada linha do arquivo, converte a linha hexadecimal de volta para os valores binários correspondentes e extrai o IV e a cifra. Em seguida, a função sodium_crypto_secretbox_open() é usada para descriptografar a mensagem. Se a descriptografia for bem-sucedida, a mensagem decifrada e a mensagem criptografada correspondente são exibidas. Caso contrário, uma mensagem de erro é exibida.

Lembre-se de habilitar a extensão Sodium no PHP para que as funções de criptografia funcionem corretamente.

É importante garantir a segurança do arquivo de chave (chave.txt) e do arquivo de mensagens cifradas (mensagens_cifradas.txt), protegendo-os contra acesso não autorizado.
*/
