<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('admin.html');

if(isset($_SESSION['livello'])){
    if($_SESSION['livello'] == "amministratore"){
        //INSERISCO CODICE PAGINA
        $username=$_SESSION['username'];
        $email=$_SESSION['email'];
        $occupazione=$_SESSION['occupazione'];

        $paginaHTML = str_replace("<username></username>","<p>".$username."</p>", $paginaHTML);
        $paginaHTML = str_replace("<email></email>","<p>".$email."</p>", $paginaHTML);
        $paginaHTML = str_replace("<occupazione></occupazione>","<p>".$occupazione."</p>", $paginaHTML);
    }else{
        header('utente.php');
    }
}else
{
    header('login.php');
}
?>