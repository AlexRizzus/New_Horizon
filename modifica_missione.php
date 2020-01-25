<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('modifica_missione.html');
session_start();
if(isset($_SESSION['livello'])){
    if($_SESSION['livello'] == "amministratore"){
        //creazione form modifica
        if (isset($_POST['updateMission']))
        {
            $missione = $_POST['nome'];
            $missioni=[];
            $missioni=$oggettoConnessione->getMissioni_perNome($missione);
            $stringa='Nome: <input type="text" placeholder="'. $missioni[0]['nome'] .'"></nome><br>
            Data inizio: <input type="text" placeholder="'. $missioni[0]['data_inizio'] .'"></Data inizio><br>
            Data di fine: <input type="text" placeholder="'. $missioni[0]['data_fine'] .'"></Data di fine><br>
            Stato: <input type="text" placeholder="'. $missioni[0]['stato'] .'"></Stato><br>
            Affiliazioni: <input type="text" placeholder="'. $missioni[0]['affiliazioni'] .'"></Affiliazioni><br>
            Luogo: <input type="text" placeholder="'. $missioni[0]['destinazione'] .'"></Luogo><br>
            Scopo: <input type="text" placeholder="'. $missioni[0]['scopo'] .'"></Scopo>';
            $paginaHTML=str_replace("</campiDati>",$stringa, $paginaHTML);
            
        }
        echo($paginaHTML);
    }else{
        header('utente.php');
    }
}else
{
    header('login.php');
}
?>
