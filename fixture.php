<?php

// execu��es r�pidas no desenvolvimento com o banco de dados
// deletar tabelas e insere registro de testes

require_once "conexaoDB.php";

echo "#### Executando Fixtures ####\n";

$conn = conexaoDB();

//pra ver o que est� acontecendo
echo "Removendo tabela";
// executa uma query a partir da conex�o com o banco
$conn->query("DROP TABLE IF EXISTS teste;");
echo " - OK\n";

echo "Criar tabela";
// executa uma query a partir da conex�o com o banco
$conn->query("CREATE TABLE teste (
	id INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(45) CHARACTER SET 'utf8' NULL,
	slug TEXT CHARACTER SET 'utf8' NULL,
	conteudo TEXT CHARACTER SET 'utf8' NULL,
	PRIMARY KEY (id));");
echo " - OK\n";

echo "Inserindo dados";
for($x = 0; $x < 5; $x++){
	$conteudo = "Conteúdo página {$x}";
	
	$mst = $conn->prepare("INSERT INTO teste (conteudo) VALUE (:conteudo);");
	$mst->bindParam(":conteudo", $conteudo);
	$mst->execute();
	

	
}

echo " - OK\n";

echo "#### Concluído ####\n"; 

