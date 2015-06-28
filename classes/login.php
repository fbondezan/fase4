<?php
class Login{
    
    private $db;
    private $login;
    private $senha;
    
    // M�todo Dependence Injection
	// Classe vai receber um objeto PDO que � a conex�o com o banco de dados
	// a partir disso trabalhar com o atributo DB
        // exige que a variável passada $db seja uma instancia da classe 
    public function __construct(\PDO $db)
    {
            $this->db = $db;
    }
    
    public function setLogin($login){
        $this->login = $login;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }
    public function getLogin(){
        return $this->login;
    }
    public function getSenha(){
        return $this->senha;
    }
    
    public function logar(){
        
        //statement
        $query = "SELECT * FROM admin WHERE user = ? AND senha = ? ";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(1, $this->getLogin());
        $stmt->bindValue(2, $this->getSenha());
        $stmt->execute();
        if($stmt->rowCount() == 1):
            $dados = $stmt->fetch(PDO::FETCH_OBJ);
            $_SESSION['administrador'] = $dados->nome;
            $_SESSION['logado'] = true;
            return true;
        else:
            return false;
        endif;
        
    }
    
    public static function deslogar(){
        if(isset($_SESSION['logado'])):
            unset($_SESSION['logado']);
            session_destroy();
            header("Location: http://54.94.160.240/projetos/fase4/index.php?pag=home");
        endif;
    }
    
}

