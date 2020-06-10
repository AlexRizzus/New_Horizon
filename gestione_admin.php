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
    $icon_mod="images/modifica_icona.png";
    $icon_del="images/cestino_icona.png";
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
        $contatore = 0;
        $stringa_missioni = "";
        foreach($missioni as $valore){
            $contatore++;
            $contatore++;
            $stringa_missioni .= '<div class="amministratore-box" >
            <h1 class="nomemissione"> Nome missione: "' . $valore["nome"] . '"</h1>
            <form class="invisibleprint" action="gestione_admin.php" method="post">
              <fieldset>
              <input class="invisibleprint" type="hidden" name="nome" value="' . $valore['nome'] . '"/>
              <button title="Cancella la missione" class="invisibleprint" type="submit" name="deleteMission" >
                <img src="' . $icon_del. '" alt="icona cancellazione non trovata" title="icona cancellazione"/>
              </button>
          </fieldset>
          </form><form class="invisibleprint" action="modifica_missione.php" method="post">
            <fieldset>
              <input class="invisibleprint" type="hidden" name="nome" value="' . $valore['nome'] . '"/>
              <button title="Modifica la missione" class="invisibleprint" type="submit" name="updateMission" >
                <img src="' . $icon_mod. '" alt="icona modifica non trovata" title="icona modifica"/>
              </button>
            </fieldset> 
          </form>
        </div>';
        }
        echo str_replace('<p id="missionsHere"></p>', $stringa_missioni, $paginaHTML);
        }
    }else{
        header('Location: utente.php');
    }
}else
{
    header('Location: login.php');
}
?>
