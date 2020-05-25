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
            Scopo: <input tabindex="7" type="text" name="scopo"></Scopo></fieldset><br><br><input type="hidden" name="key"><input tabindex="8" type="submit" value="Invia" name="change">';
            $paginaHTML=str_replace("<campiDati/>",$stringa, $paginaHTML);
            echo($paginaHTML);

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





            $stringa2='<p>Modifiche inviate</p>';
            $stringa3='<p>Puoi tornare alla selezione missioni</p>';
            $paginaHTML = file_get_contents('modifica_missione.html');
            $paginaHTML=str_replace("<prova/>",$stringa2, $paginaHTML);
            $paginaHTML=str_replace("<p>Cliccando su Invia modifichi la missione con i valori che hai inserito</p>",$stringa3, $paginaHTML);
            echo($paginaHTML);
        }


    }else{
        header('Location: utente.php');
    }
}else
{
    header('Location: login.php');
}
?>
