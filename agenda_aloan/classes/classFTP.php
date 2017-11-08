<?php
	
class classFTP{
	
	private $ftp_server="www.medifile.com.br"; 
	private	$ftp_username="medifile";
	private $ftp_password="1000tonrv";
	private $ftp_DIR = "Laudo/";
	private $local_DIR = "arquivos/";
		
	function baixarArquivo($arquivo)
	{
		// define some variables
		$local_file = $local_DIR.'/'.$arquivo;
		$server_file = $ftp_DIR.'/'.$arquivo;

		// set up basic connection
		$conn_id = ftp_connect($ftp_server);

		// login with username and password
		$login_result = ftp_login($conn_id, $ftp_username, $ftp_password);

		// try to download $server_file and save to $local_file
		if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
			echo "Successfully written to $local_file\n";
		} else {
			echo "There was a problem\n";
		}

		// close the connection
		ftp_close($conn_id);

	}		
}
?>