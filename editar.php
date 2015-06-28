
<?php
session_start();

ini_set('display_errors', true);
error_reporting(E_ALL);

//CONEXAO COM BANCO DE DADOS
require_once 'conexaoDB_1.php';
//CLASSE CONTEUDO
require_once 'conteudo.php';

require_once "classes/login.php";

//<!-- FUNÇAO DE LOGOUT -->
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
    <script src="ckeditor/ckeditor.js"></script>
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
// CARREGAMENTO DO CONTEÚDO DA PÁGINA
if(isset($_GET['pag'])) {$pag=$_GET['pag'];}

$conteudo = new Conteudo($conexao);
$resultado = $conteudo->find($pag);
$id_pag = $resultado['id'];
$conteudo->setId($id_pag);

// FUNÇÃO DE EDIÇÃO DO CONTEUDO
if(isset($_GET['editar']) AND $_GET['editar'] == 'sim'): 
    $cont_pag = $_POST['editor1'];
    $conteudo->setConteudo($cont_pag);
    $conteudo->editar();
endif;
// RECARREMENTO DO CONTEUDO DA PAGINA
$resultado = $conteudo->find($pag);


?>

<div style="width: 960px; border:1px grey solid; margin:0 auto; text-align: center;">

<!-- MENU -->
<?php require_once("menu.php"); ?>
<hr>
<!-- TITULO -->
    <h1><?php echo $resultado['nome']; ?></h1>
<hr>
<a href="resultados.php?pal=todos">Editar Páginas - CMS</a> &nbsp;   | &nbsp;   <?php require_once("login.php"); ?>
<hr>
<!-- CKEDITOR - CONTEUDO -->
<form action="?editar=sim&pag=<?php echo $pag; ?>" method="post">
		
		<textarea cols="80" id="editor1" name="editor1" rows="10">
                    <?php  echo $resultado['conteudo']; ?>

                </textarea>
		<script>

			CKEDITOR.replace( 'editor1' );

		</script>
		<p>
			<input type="submit" value="Submit">
		</p>
	</form>

<hr>

<!-- RODAPÉ -->
<?php require_once("rodape.php"); ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>