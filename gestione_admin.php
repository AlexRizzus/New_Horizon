<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('gestione_admin.html');
session_start();
if(isset($_SESSION['livello'])){
    if($_SESSION['livello'] == "amministratore"){
        //INSERISCO CODICE PAGINA        
    $missioni = $oggettoConnessione->getMissioni();
    $icon_mod='src="images/modifica_icona.png"';
    $icon_del='src="images/cestino_icona.png"';
    if($missioni == null){
        echo("risultato query vuoto");
    } else {
        $stringa_missioni = "";
        foreach($missioni as $valore){
            $stringa_missioni .= '<div class="mission-box">' .
            "<h2>Nome: " . $valore['nome'] . "</h2>" .
            "<img ' . $icon_mod .'  alt=\"icona modifica non trovata title\" title=\"icona modifica\"/>".
            "<img ' . $icon_del. ' alt=\"icona cancellazione non trovata\" title=\"icona cancellazione\"/>". "</div>";
        }
        echo str_replace("</missionsHere>", $stringa_missioni, $paginaHTML);
        }
    }else{
        header('utente.php');
    }
}else
{
    header('login.php');
}
?>

