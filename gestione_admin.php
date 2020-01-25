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


        if (isset($_POST['submitPrefe']))
        {
            $missione = $_POST['nome'];
            if(isset($_SESSION['username']))
            {
            if($_POST['Azione'] == "RMV")
            {
                // rimuovo la missione dai preferiti
                echo("REMOVE");
                echo($missione);
                $oggettoConnessione->remove_mission($missione);
            
            }
        }


        $stringa_missioni = "";
        foreach($missioni as $valore){
            $stringa_missioni .= "<div class='amministratore-box' >" .
            "<h2> Nome missione: " . $valore['dssa'] . "</h2>" .
            '<form action="gestione_admin.php" method="post">
            <input type="hidden" name="Azione" value="RMV"/>
            <button type="submit" name="submitPrefe" >
            <img ' . $icon_del. ' alt=\"icona cancellazione non trovata\" title=\"icona cancellazione\"/>
            </button>
            </form>' ."</div>";
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

