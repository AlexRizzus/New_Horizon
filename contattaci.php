<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('contattaci.html');
session_start();
if(isset($_SESSION['livello'])){
    $paginaHTML=str_replace('<button  onclick="location.href=\'login.php\'" class="desktop  " xml:lang="en">Login</button>','<button  onclick="location.href=\'login.php\'" class="desktop  " xml:lang="en">Profilo</button>', $paginaHTML); 
}
$stringa='<form id="formid" class="form" action="contattaci.php" method="post"><p class="errorEmail"></p>
<div><p class = "formdescription">Inserisci qui l&#8217;oggetto del tuo messaggio</p><label class = "formdescription" for="oggetto">Oggetto del messaggio: </label><input id="oggetto" class="inputform" type="text" name="opzioni"/>
<p class="errorOggetto"></p></div>
<div><label class = "formdescription" for="textarea">Scrivi qua il messaggio: </label><textarea class="inputform" id="textarea" name="testo" rows="7" cols="200"></textarea></div>
<p class="errorTextArea"></p>
<div><label class = "formdescription" for="sendbutton">Invia il messagio al nostro staff: </label><input type="submit" value="Invia" name="invio" id="sendbutton"/></div></form>';
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
        $lunghezzaOggetto=true;
        $lunghezzaTesto=true;
       if(strlen($oggetto)>256){
        $reqOggetto= '<p class = "formerror">Oggetto troppo lungo, massimo 256 caratteri</p>';
        $paginaHTML=str_replace('<p class="errorOggetto"></p>',$reqOggetto, $paginaHTML);
       }
       if(strlen($testo)>1024){
        $reqTesto = '<p class = "formerror">Il testo è troppo lungo, massimo 1024 caratteri</p>';
        $paginaHTML=str_replace('<p class="errorTextArea"></p>',$reqTesto, $paginaHTML);

       }
        if($lunghezzaOggetto && $lunghezzaTesto){
            $oggetto= $oggettoConnessione->test_input($_POST["opzioni"]);
            $testo=$oggettoConnessione->test_input($_POST["testo"]);
            $oggettoConnessione->add_message($_SESSION["username"], $oggetto, $testo);
            $paginaHTML=str_replace('<p id="scriptalert"></p>','<script type="text/javascript">window.onload = function(){alert("Mail inviata con successo");}</script>', $paginaHTML);
        }
    }
} 
echo($paginaHTML);
?>