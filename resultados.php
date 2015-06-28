<?php
session_start();

ini_set('display_errors', true);
error_reporting(E_ALL);

//CONEXAO COM BANCO DE DADOS
require_once 'conexaoDB_1.php';
//CLASSE CONTEUDO
require_once 'conteudo.php';

require_once "classes/login.php";

if(isset($_GET['logout'])):
    if($_GET['logout'] == 'ok'):
        Login::deslogar();
    endif;
endif;

?>

<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> PHP - Fase 4 - AREA ADMINISTRATIVA</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    

<?php

// URL BASE
/*
$url = $_SERVER['HTTP_HOST'] . "/projetos/fase4/";
$rota = parse_url("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$path = str_replace("/projetos/fase4/", "", $rota['path']); 
*/
if(isset($_GET['pag'])) {$pag=$_GET['pag'];} else {$pag='home';}

if(isset($_GET['pal'])) {$_POST['palavra']='';}
?>

<div style="width: 960px; border:1px grey solid; margin:0 auto; ">

<!-- MENU -->
<?php require_once("menu.php"); ?>
<hr>
<?php require_once("busca.php"); ?>
<hr>
<?php require_once("login.php"); ?>
<hr>
<!-- CONTEÚDO -->
<?php  
/**** BANCO DE DADOS - CONTEUDO ****/

$palavra = trim($_POST['palavra']);

$conteudo = new Conteudo($conexao);
$resultado = $conteudo->buscar($palavra);
//echo $resultado[0]['conteudo'] . "<br/>";
$count = count($resultado);
$slug = '';
if(isset($_SESSION['logado'])):   
    $editar = "<a href='editar.php?pag=$slug'> EDITAR </a>";
    else:
    $editar = "Faça o login";
    endif;     
?>

<table style="width:100%">
  <tr>
    <th>ID</th>
    <th>Nome</th> 
    <th>Acessar Página</th>
    <th>Editar Conteudo</th>
  </tr>
    <?php
if(isset($count) AND $count > 0){
    for($x = 0; $x < $count; $x++){
        $url_pag = "http://54.94.160.240/projetos/fase4/index.php?pag=" . $resultado[$x]['slug'];
        $id_pag = $resultado[$x]['id'];
        $slug = $resultado[$x]['slug'];
            
            if(isset($_SESSION['logado'])):   
            $editar = "<a href='editar.php?pag=$slug'> EDITAR </a>";
            else:
            $editar = "Faça o login";
            endif;     
            
        echo '<tr>';
        echo "<td>" . $resultado[$x]['id'] . "</td><td>" . $resultado[$x]['nome'] . "</td>"  . "<td>"  .
                "<a href='$url_pag'> LINK </a> </td>" . "<td>"  . $editar .  " </td> <br/>";
        echo '</tr>';
    }
}
#echo $resultado;
?>
    
</table>

</p>
<!-- RODAPÉ -->
<?php require_once("rodape.php"); ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>