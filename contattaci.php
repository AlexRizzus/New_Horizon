<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('contattaci.html');
session_start();

$stringa='<form id="formid" class="form" action="contattaci.php" method="post"><div><input tabindex="5" name="oggetti"/>
        <div/><datalist id="opzioni"><option value="Richiesta Informazioni"/><option value="Segnalazione di un problema"/><option value="Richiesta di collaborazione"/>
        <option value="Una richiesta scientifica"/><option value="Altro"/></datalist><br/><textarea tabindex="6" name="testo" rows="10" cols="100" placeholder="Scrivi qui il tuo messaggio."></textarea>
        <div><input tabindex="7" type="submit" value="Invia" name="invio"></div></form>';
$paginaHTML=str_replace("<sostituto></sostituto>",$stringa, $paginaHTML);
echo($paginaHTML);
if(isset($_POST['invio']))
{
    if(isset($_SESSION['email'])){

        $headers = 'From: '.$_SESSION['email'].'';
        echo($headers);
        mail("newhorizon@gmail.com",$_POST['opzioni'], $_POST['testo'], $headers);
    }
}
?>