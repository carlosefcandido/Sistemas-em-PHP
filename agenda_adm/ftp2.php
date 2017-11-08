<?php
/**
* Conexão via FTP com o PHP
* 05 de maio de 2009
* Thiago Belem ~ http://blog.thiagobelem.net/
*/

// Dados do servidor
$servidor = 'medifile.com.br'; // Endereço
$usuario = 'medifile'; // Usuário
$senha = '1000tonrv'; // Senha

// Abre a conexão com o servidor FTP
$ftp = ftp_connect($servidor); // Retorno: true ou false
if($ftp=true)
	echo "conexao bem sucedida";
else
	echo "erro";
// Faz o login no servidor FTP
$login = ftp_login($ftp, $usuario, $senha); // Retorno: true ou false
if($login=true)
	echo "login bem sucedido";
else
	echo "erro de login";


// ======

// Define variáveis para o recebimento de arquivo
$local_arquivo = '/public_html/agenda/laudo/arquivos/00070680700001.xml'; // Localização (local)
$ftp_pasta = '/Laudo'; // Pasta (externa)
$ftp_arquivo = '00070680700001.xml'; // Nome do arquivo (externo)

// Recebe o arquivo pelo FTP em modo ASCII
$recebe = ftp_get($ftp, $ftp_pasta.$ftp_arquivo, $local_arquivo, FTP_ASCII); // Retorno: true / false
if($recebe=true)
	echo "download sucedido";
else
	echo "erro de download";
?>