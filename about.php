<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('about.html');
session_start();
if(isset($_SESSION['livello'])){
    $paginaHTML=str_replace('<button onclick="location.href=\'login.php\'" class="desktop  " xml:lang="en">Login</button>','<button onclick="location.href=\'login.php\'" class="desktop  " xml:lang="en">Profilo</button>', $paginaHTML); 
}
echo($paginaHTML);
?>