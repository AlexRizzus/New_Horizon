<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('contattaci.html');
session_start();

$stringa='<form id="formid" class="form" action="contattaci.php" method="post"><p class="errorEmail"></p>
<div><p class = "formdescription">Inserisci qui l&#8217;oggetto del tuo messaggio</p><label class = "formdescription" for="oggetto">Oggetto del messaggio: </label><input id="oggetto" class="inputform" type="text" tabindex="10" name="opzioni"/>
<p class="errorOggetto"></p></div>
<div><label class = "formdescription" for="textarea">Scrivi qua il messaggio: </label><textarea class="inputform" tabindex="11" id="textarea" name="testo" rows="7" cols="200"></textarea></div>
<p class="errorTextArea"></p>
<div><label class = "formdescription" for="sendbutton">Invia il messagio al nostro staff: </label><input tabindex="12" type="submit" value="Invia" name="invio" id="sendbutton"/></div></form>';
$paginaHTML=str_replace('<p id="sostituto"></p>',$stringa, $paginaHTML);

$testo = "";
$reqTesto = "";
$oggetto = "";
$reqOggetto = "";
$reqEmail="";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['invio']))
{
    if(!(isset($_SESSION['email']))){
        $reqEmail= '<p class = "formerror">Devi fare il login per poter inviare la richiesta</p>';
        $paginaHTML=str_replace('<p class="errorEmail"></p>',$reqEmail, $paginaHTML);   
    }
    if(empty($_POST["testo"])){
        $reqTesto = '<p class = "formerror">Il testo non pu&ograve; essere vuoto</p>';
        $paginaHTML=str_replace('<p class="errorTextArea"></p>',$reqTesto, $paginaHTML);
    }
    else{
        $testo="true";
    }
    if(empty($_POST["opzioni"])){
        $reqOggetto= '<p class = "formerror">Inserire un oggetto</p>';
        $paginaHTML=str_replace('<p class="errorOggetto"></p>',$reqOggetto, $paginaHTML);
    }
    else{
        $oggetto="true";
    }
    if(isset($_SESSION["email"]) && $testo=="true" && $oggetto=="true"){
        $oggetto= test_input($_POST["opzioni"]);
        $testo=test_input($_POST["testo"]);
        $headers = 'From: webmaster@example.com'. phpversion();
        mail("dmlazzaro98@gmail.com",$oggetto, $testo, $headers); 
        $paginaHTML=str_replace('<p id="scriptalert"></p>','<script type="text/javascript">window.onload = function(){alert("Mail inviata con successo");}</script>', $paginaHTML);
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