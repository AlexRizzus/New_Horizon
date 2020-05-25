<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('contattaci.html');
session_start();

$stringa='<form id="formid" class="form" action="contattaci.php" method="post"><span class="errorEmail"></span>
        <div><p class = "formdescription">Inserisci qui l&#8217oggetto del tuo messaggio</p><input class="inputform" type="text" name="opzioni">
        <span class="errorOggetto"></span></div>
        <div><p class = "formdescription">Inserisci qua sotto tutto quello che vuoi comunicarci</p><textarea class="inputform" tabindex="6" id="textarea" name="testo" rows="7" cols="200"></textarea></div>
        <span class="errorTextArea"></span>
        <div><input tabindex="7" type="submit" value="Invia" name="invio" id="sendbutton"></div></form>';
$paginaHTML=str_replace("<sostituto id='formid'></sostituto>",$stringa, $paginaHTML);

$testo = "";
$reqTesto = "";
$oggetto = "";
$reqOggetto = "";
$reqEmail="";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['invio']))
{
    if(!(isset($_SESSION['email']))){
        $reqEmail= '<span class="errorEmail">Devi fare il login per poter inviare la richiesta</span>';
        $paginaHTML=str_replace('<span class="errorEmail"></span>',$reqEmail, $paginaHTML);   
    }
    if(empty($_POST["testo"])){
        $reqTesto = '<span class="errorTextArea">Il testo non può essere vuoto</span>';
        $paginaHTML=str_replace('<span class="errorTextArea"></span>',$reqTesto, $paginaHTML);
    }
    else{
        $testo="true";
    }
    if(empty($_POST["opzioni"])){
        $reqOggetto= '<span class="errorOggetto">Inserire un oggetto</span>';
        $paginaHTML=str_replace('<span class="errorOggetto"></span>',$reqOggetto, $paginaHTML);
    }
    else{
        $oggetto="true";
    }
    if(isset($_SESSION["email"]) && $testo=="true" && $oggetto=="true"){
        $oggetto= test_input($_POST["opzioni"]);
        $testo=test_input($_POST["testo"]);
        $headers = 'From: webmaster@example.com'. phpversion();
        mail("dmlazzaro98@gmail.com",$oggetto, $testo, $headers); 
        $paginaHTML=str_replace("<scriptalert></scriptalert>",'<script type="text/javascript">window.onload = function(){alert("Mail inviata con successo");}</script>', $paginaHTML);
    }
} 
echo($paginaHTML);
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>