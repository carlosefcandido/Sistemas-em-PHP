<?php

	session_start();
	unset($_SESSION['USUARIO']);
	unset($_SESSION['FUNCIONARIO']);
	unset($_SESSION['FUNCIONARIOS']);
	unset($_SESSION['ERROS']);
	unset($_SESSION['UNIDADE']);
	unset($_SESSION['UNIDADES']);
	unset($_SESSION['PACIENTES']);
	header("Location: ./");
?>