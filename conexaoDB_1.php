<?php 

//conexao com o PDO - Banco de Dados


		try {
	$conexao = new \PDO("mysql:host=localhost;dbname=fase4", "root", "1meapmu8sw");
		
} catch (\PDOException $e) {
	// die, usado para parar a minha aplica��o
	die("Nao foi possivel estabelecer a conexao com o bando de dados\n");
}

