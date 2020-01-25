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
            $stringa='Nome: <input type="text" name="nome" value="'. $missioni[0]['nome'] .'"></nome><br>
            Data inizio: <input type="text" name="data_inizio" value="'. $missioni[0]['data_inizio'] .'"></Data inizio><br>
            Data di fine: <input type="text" name="data_fine" value="'. $missioni[0]['data_fine'] .'"></Data di fine><br>
            Stato: <input type="text" name="stato" value="'. $missioni[0]['stato'] .'"></Stato><br>
            Affiliazioni: <input type="text" name="affiliazioni" value="'. $missioni[0]['affiliazioni'] .'"></Affiliazioni><br>
            Luogo: <input type="text" name="destinazione" value="'. $missioni[0]['destinazione'] .'"></Luogo><br>
            Scopo: <input type="text" name="scopo" value="'. $missioni[0]['scopo'] .'"></Scopo>';
            $paginaHTML=str_replace("</campiDati>",$stringa, $paginaHTML);
            
        }
        echo($paginaHTML);

        if (isset($_POST['change'])) {
            $nome= $data_inizio =$data_fine=$stato=$affiliazioni=$destinazione=$scopo= "";
            $data_inizio = $oggettoConnessione->test_input($_POST["data_inizio"]);
            $data_fine = $oggettoConnessione->test_input($_POST["data_fine"]);
            $stato = $oggettoConnessione->test_input($_POST["stato"]);
            $affiliazioni = $oggettoConnessione->test_input($_POST["affiliazioni"]);
            $destinazione = $oggettoConnessione->test_input($_POST["destinazione"]);
            $scopo = $oggettoConnessione->test_input($_POST["scopo"]);
            $nome = $oggettoConnessione->test_input($_POST["nome"]);

            
        }

    }else{
        header('utente.php');
    }
}else
{
    header('login.php');
}
?>
