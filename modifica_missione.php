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
            echo($missione);
            $stringa='Nome: <input type="text" placeholder='.$missione['nome'].'></nome><br>
            Data inizio: <input type="text" placeholder=""></Data inizio><br>
            Data di fine: <input type="text"></Data di fine><br>
            Stato: <input type="text"></Stato><br>
            Affiliazioni: <input type="text"></Affiliazioni><br>
            Luogo: <input type="text"></Luogo><br>
            Scopo: <input type="text"></Scopo>';
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
