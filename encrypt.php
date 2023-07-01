<?php
//Documentação - Código de Criptografia
$textoClaro = $argv[1];

try {
    if (!file_exists('chave.txt')) {
        file_put_contents('chave.txt', sodium_crypto_secretbox_keygen());
    }

    $chave = file_get_contents('chave.txt');
    if ($chave === false) {
        throw new Exception("Falha ao ler a chave do arquivo.");
    }

    $iv = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
    $mensagemCifrada = sodium_crypto_secretbox($textoClaro, $iv, $chave);

    // Abre o arquivo no modo de anexar e adiciona a mensagem cifrada em uma nova linha
    $file = fopen('mensagens_cifradas.txt', 'a');
    fwrite($file, sodium_bin2hex($iv . $mensagemCifrada) . PHP_EOL);
    fclose($file);

    echo "Mensagem Cifrada: " . bin2hex($mensagemCifrada) . PHP_EOL;
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . PHP_EOL;
}

/*
Este código realiza a criptografia de uma mensagem usando o algoritmo de criptografia de caixa secreta (secretbox) do Sodium. Ele gera uma chave aleatória se o arquivo chave.txt não existir. Em seguida, gera um vetor de inicialização (IV) aleatório e criptografa a mensagem usando a função sodium_crypto_secretbox(). A mensagem cifrada é então escrita em um arquivo mensagens_cifradas.txt em formato hexadecimal.
*/