<h1> CONTATO </h1>

<!-- VALIDAÇÃO DO FORMULÁRIO -->
<?php


ini_set('display_errors', true);
error_reporting(E_ALL);

$form = filter_input(INPUT_GET, "form");

if($form=='enviar'){
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "felipe@vegar.com.br";
 
    $email_subject = "Your email subject line";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "Foram encontrados erros no formulário. <br/><br/>";
 
        echo $error."<br />";
 
        echo "Por favor, conserte os erros antes de enviar.<br /><br />";
 
        //die();
 
    }
 
     
 	
    // validation expected data exists
 	/*
    if(!isset($_POST['first_name']) ||
 
        !isset($_POST['last_name']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['comments'])) {
 
        //died();       
 
    }
 	*/
     
 
    $first_name = $_POST['first_name']; // required
 
    $last_name = $_POST['last_name']; // required
 
    $email_from = $_POST['email']; // required
 
 
    $comments = $_POST['comments']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'Email inválido.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'Nome inválido.<br />';
 
  }
 
  if(!preg_match($string_exp,$last_name)) {
 
    $error_message .= 'Assunto Inválido.<br />';
 
  }
 
  if(strlen($comments) < 2) {
 
    $error_message .= 'Mensagem inválida.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "First Name: ".clean_string($first_name)."\n";
 
    $email_message .= "Last Name: ".clean_string($last_name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Mensagem: ".clean_string($comments)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();

if(strlen($error_message) == 0){
@mail($email_to, $email_subject, $email_message, $headers);  
}

?>
 
 
 
<!-- include your own success html here -->
 
 
<?php if(strlen($error_message) == 0){
echo "Dados enviados com sucesso, abaixo seguem os dados que você enviou: <br/>";
}
?>
 
<?php
 
}
}
 
?>

<!-- INICIO DO FORMULÁRIO -->
<?php
/*
if(!$_GET['form']!=enviar){
	echo 'diferente';
}
*/
?>

<form name="contactform" method="post" action="?pag=contato&form=enviar" role="form">

<div class="form-group">
  <label for="first_name">Nome</label>
  <input  type="text" name="first_name" maxlength="50" size="30" value="<?php if(isset($_POST['first_name'])){echo $_POST['first_name'];} ?>" >
</div>
 
<div class="form-group">
  <label for="email">Email</label>
  <input  type="text" name="email" maxlength="80" size="30" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
</div>
 
<div class="form-group">
  <label for="last_name">Assunto:</label>
  <input  type="text" name="last_name" maxlength="50" size="30" value="<?php if(isset($_POST['last_name'])){echo $_POST['last_name'];} ?>">
</div>
 
<div class="form-group">
  <label for="comments">Mensagem</label>
  <textarea  name="comments" maxlength="1000" cols="25" rows="6" value=""><?php if(isset($comments)){echo ($comments);} ?></textarea>
</div>

<button type="submit" class="btn btn-default">Enviar</button>

</form>

<br/><br/>
