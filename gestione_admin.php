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


        if (isset($_POST['deleteMission']))
        {
            $missione = $_POST['nome'];
            //rimuovo la missione
            $oggettoConnessione->remove_mission($missione);
            header("Refresh:0");
           
        }

        $stringa_missioni = "";
        foreach($missioni as $valore){
            $stringa_missioni .= "<div class='amministratore-box' >" .
            "<h2> Nome missione: " . $valore['nome'] . "</h2>" .
            '<form action="gestione_admin.php" method="post">
            <input type="hidden" name="nome" value="' . $valore['nome'] . '"/>
            <button type="submit" name="deleteMission" >
            <img ' . $icon_del. ' alt="icona cancellazione non trovata" title="icona cancellazione"/>
            </button>
            </form>' .
            '<form action="modifica_missione.php" method="post">
            <input type="hidden" name="nome" value="' . $valore['nome'] . '"/>
            <button type="submit" name="updateMission" >
            <img ' . $icon_mod. ' alt="icona modifica bob trovata" title="icona modifica"/>
            </button>
            </form>' ."</div>";
        }
        echo str_replace("</missionsHere>", $stringa_missioni, $paginaHTML);
        }
    }else{
        header('Location: utente.php');
    }
}else
{
    header('Location: login.php');
}
?>

