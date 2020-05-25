<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('aggiungi_missione.html');
session_start();

if(isset($_SESSION['livello'])){
    if($_SESSION['livello'] == "amministratore"){
            $stringa='<fieldset><legend>Missione:</legend>Nome: <input tabindex="1" type="text" name="nome"></nome><br>
            Data inizio: <input tabindex="2" type="text" name="data_inizio"></Data inizio><br>
            Data di fine: <input tabindex="3" type="text" name="data_fine"></Data di fine><br>
            Stato: <input tabindex="4" type="text" name="stato"></Stato><br>
            Affiliazioni: <input tabindex="5" type="text" name="affiliazioni"></Affiliazioni><br>
            Luogo: <input tabindex="6" type="text" name="destinazione"></Luogo><br>
            Scopo: <input tabindex="7" type="text" name="scopo"></Scopo></fieldset><br><br><input type="hidden" name="key">
            <button tabindex="8" class="login-button" type="submit" name="add">Invia</button>';
            $paginaHTML=str_replace("<campiDati/>",$stringa, $paginaHTML);

        if (isset($_POST['add'])) {
            $nome= $data_inizio =$data_fine=$stato=$affiliazioni=$destinazione=$scopo= "";
            $missione=$_POST['key'];
            $nome=$oggettoConnessione->test_input($_POST["nome"]);
            $data_inizio = $oggettoConnessione->test_input($_POST["data_inizio"]);
            $data_fine = $oggettoConnessione->test_input($_POST["data_fine"]);
            $stato = $oggettoConnessione->test_input($_POST["stato"]);
            $affiliazioni = $oggettoConnessione->test_input($_POST["affiliazioni"]);
            $destinazione = $oggettoConnessione->test_input($_POST["destinazione"]);
            $scopo = $oggettoConnessione->test_input($_POST["scopo"]);

            $oggettoConnessione->add_mission($nome, $data_inizio, $data_fine, $stato, $affiliazioni, $destinazione, $scopo);





            $stringa2='<p>Missione aggiunta</p>';
            $paginaHTML=str_replace("<prova/>",$stringa2, $paginaHTML);
        }
            echo($paginaHTML);

    }else{
        header('Location: utente.php');
    }
}else
{
    header('Location: login.php');
}
?>
