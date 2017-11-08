<?php
	  set_time_limit(0);
      class ftp {
 
		  public $ftp_server;
 		  public $login_ftp;
 		  public $pass_ftp;
                  public $ftp_dir;
                  public $local_dir;
                  public $id_ftp;
                  private $ftp_port = 21;
                  public $ftp_time = 90;
                  public $ftp_contents;
                  public $login_result;
                  public $copy;
		  public $extensoes;
 
          public function __construct($arquivo,$hospital) {		  
		  include_once('config.inc.php');
		  if($hospital == 'Hospital de Clinicas Dr. Aloa'){
			$ftpDIR = "Laudo";
			$localDIR = "laudo/arquivos/";
		  }else{
			$ftpDIR = "Prontolab";
			$localDIR = "prontolab/arquivos/";
		  }
		  $this->ftp_server = $servidorFTP;
 		  $this->login_ftp = $loginFTP;
 		  $this->pass_ftp = $passFTP;
          $this->ftp_dir = $ftpDIR;
          $this->local_dir = $localDIR;
          $this->extensoes = $extensoesDOWNLOAD;
 
              $this->id_ftp = ftp_connect($this->ftp_server,$this->ftp_port,$this->ftp_time) or die("Nao conectou ao ftp");
 
              if ($this->id_ftp) {
                  $this->setLogin($arquivo);
              }
 
          }
 
          public function setLogin($arquivo){
 
              $this->login_result = ftp_login($this->id_ftp, $this->login_ftp, $this->pass_ftp);
 
              if($this->login_result){
 
                  $this->getlistFiles($arquivo);
 
              }
 
          }
 
          public function getlistFiles($arquivo){
 
              $this->ftp_dir = ftp_chdir($this->id_ftp, $this->ftp_dir);//coloque o diretorio de origem dos arquivos
 
              $this->ftp_contents = ftp_nlist($this->id_ftp,"");
 
              if ($this->ftp_contents){
 
                  //print_r($this->ftp_contents);
 
                  $this->copyFiles($arquivo);
 
              }
 
          }
 
          public function copyFiles($arquivo){
 
			  if(($this->local_dir != "") and (!is_dir($this->local_dir))){#CRIA O DIRETORIO LOCAL,CASO ELE NAO EXISTA
			  	mkdir ($this->local_dir, 0777);
			  }	
 
              for($i=0; $i<count ($this->ftp_contents); $i++){
 
				  $extensao = strrchr($this->ftp_contents[$i], '.');
				  if(!in_array($extensao, $this->extensoes))continue;
				
				  if($arquivo == $this->ftp_contents[$i]){
					$this->copy = ftp_nb_get($this->id_ftp, $this->local_dir.$this->ftp_contents[$i], $this->ftp_contents[$i], FTP_BINARY);
				  }
                  //echo $this->ftp_contents[$i]." - download: ";

				  while ($this->copy == FTP_MOREDATA) {
//                      echo ".";
                      $this->copy = ftp_nb_continue($this->id_ftp);
                  }
 
				  if ($this->copy == FTP_FINISHED) {
//                    echo " 100%\n";
                  }
 
                  if ($this->copy != FTP_FINISHED) {
//                      echo "Ocorreu um erro ao baixar o arquivo ".$this->ftp_contents[$i];
                  }else{				  
				  		continue;
				  }
				
              }
 
          }
 
          public function __destruct(){
 
              ftp_close($this->id_ftp);
 
          }
 
      }
 
   ?>