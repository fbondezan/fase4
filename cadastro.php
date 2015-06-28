<?php
session_start();

ini_set('display_errors', true);
error_reporting(E_ALL);

require_once "classes/conexao.php";
require_once "classes/cadastro.php";

if(isset($_POST['cadastrar'])){
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_MAGIC_QUOTES);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_MAGIC_QUOTES);

    $l = new Cadastro($conexao);
    
    
    $l->setLogin($login);
    $l->setSenha($senha);
    $l->inserir();
    
    echo "usuario cadastrado";
}



?>

<?php 
# PARA VALIDAR O ACESSO, BASTA COLOCAR ESSE SCRIPT ANTES DE TUDO #####
if(isset($_SESSION['logado'])):
?>
BEM-VINDO <?php echo $_SESSION['administrador']; ?>
<br/>
<a href='index.php?logout=ok'>Sair</a>
<?php
else:
    echo "Você não tem permissão de acesso";
    exit;
endif;
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>CADASTRO PHP OO</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css"
    </head>
    <body>
        <h1>CADASTRO</h1>
        <div id="login">
            <form action="" method="POST" id="form_login">
                <label for="login">Login:</label>
                <input type="text" name="login" class="input" id="input_login"/>
                
                <label for="senha">Senha:</label>
                <input type="text" name="senha" class="input" id="input_senha"/>
                
                <label for="submit"></label>
                <input type="submit" name="cadastrar" class="input_button" value="cadastrar" id="bt_logar"/>
            </form>
            <?php echo isset($erro) ? $erro : ''; ?>
        </div>
    </body>
</html>