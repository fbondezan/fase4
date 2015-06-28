<?php

class Cadastro
{
	private $db;
	//ID, Nome e Email do cliente
	private $login;
	private $senha;
	
	
	
	// M�todo Dependence Injection
	// Classe vai receber um objeto PDO que � a conex�o com o banco de dados
	// a partir disso trabalhar com o atributo DB
	public function __construct(\PDO $db)
	{
		$this->db = $db;
	}

	public function inserir()
	{
		//statement
		$query = "Insert INTO admin(user, senha) Values(:login, :senha)";
		
		$stmt = $this->db->prepare($query);
		$stmt->bindValue(':login', $this->getLogin());
                $stmt->bindValue(':senha', $this->getSenha());
		if($stmt->execute()){
			return true;
		}
		

	}
	
	// GETTERS E SETTERS - pegar dados dos atributos
	public function setLogin($login)
	{
		$this->login = $login;
		// ter uma interface mais fluente
		return $this;
	}
	
	public function getLogin()
	{
		return $this->login;
	}

        public function getSenha()
	{
		return $this->senha;
	}
        
        public function setSenha($senha)
	{
		$this->senha = $senha;
		// ter uma interface mais fluente
		return $this;
	}
	
}