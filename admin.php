<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('admin.html');
session_start();
if(isset($_SESSION['livello'])){
    if($_SESSION['livello'] == "amministratore"){
        //INSERISCO CODICE PAGINA
        $username=$_SESSION['username'];
        $email=$_SESSION['email'];
        $occupazione=$_SESSION['occupazione'];

        $paginaHTML = str_replace("<span></span>","<span>".$username."</span>", $paginaHTML);
        $paginaHTML = str_replace('<email class="campidatiadmin"></email>','<p class="campidatiadmin">'.$email.'</p>', $paginaHTML);
        $paginaHTML = str_replace('<occupazione class="campidatiadmin"></occupazione>','<p class="campidatiadmin">'.$occupazione.'</p>', $paginaHTML);
        echo($paginaHTML);
    }else{
        header('Location: utente.php');
    }
}else
{
    header('Location: login.php');
}
?>
