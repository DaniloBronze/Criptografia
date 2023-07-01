# Criptografia
 Encriptação e decriptação na prática

# Código de Criptografia
Este código realiza a criptografia de uma mensagem usando o algoritmo de criptografia de caixa secreta (secretbox) do Sodium. 
Ele gera uma chave aleatória se o arquivo chave.txt não existir. 
Em seguida, gera um vetor de inicialização (IV) aleatório e criptografa a mensagem usando a função sodium_crypto_secretbox().
A mensagem cifrada é então escrita em um arquivo mensagens_cifradas.txt em formato hexadecimal.

# Código de Descriptografia

Este código recupera as mensagens cifradas armazenadas no arquivo mensagens_cifradas.txt e realiza a descriptografia usando a chave armazenada no arquivo chave.txt.
Ele lê cada linha do arquivo, converte a linha hexadecimal de volta para os valores binários correspondentes e extrai o IV e a cifra.
Em seguida, a função sodium_crypto_secretbox_open() é usada para descriptografar a mensagem. Se a descriptografia for bem-sucedida, a mensagem decifrada e a mensagem criptografada correspondente são exibidas.
Caso contrário, uma mensagem de erro é exibida.

Lembre-se de habilitar a extensão Sodium no PHP para que as funções de criptografia funcionem corretamente.

É importante garantir a segurança do arquivo de chave (chave.txt) e do arquivo de mensagens cifradas (mensagens_cifradas.txt), protegendo-os contra acesso não autorizado.
