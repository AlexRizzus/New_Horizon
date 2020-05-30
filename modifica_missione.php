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
            $stringa='<fieldset class="scrittemodificamissione"><legend class="scrittemodificamissione">Missione:</legend>Nome: <input class="buttoninputmodificamissione" tabindex="1" type="text" name="nome" value="'. $missioni[0]['nome'] .'"/><br/>
            Data inizio: <input class="buttoninputmodificamissione" tabindex="2" type="text" name="data_inizio" value="'. $missioni[0]['data_inizio'] .'"/><br/>
            Data di fine: <input class="buttoninputmodificamissione" tabindex="3" type="text" name="data_fine" value="'. $missioni[0]['data_fine'] .'"/><br/>
            Stato: <input class="buttoninputmodificamissione" tabindex="4" type="text" name="stato" value="'. $missioni[0]['stato'] .'"/><br/>
            Affiliazioni: <input class="buttoninputmodificamissione" tabindex="5" type="text" name="affiliazioni" value="'. $missioni[0]['affiliazioni'] .'"/><br/>
            Luogo: <input class="buttoninputmodificamissione" tabindex="6" type="text" name="destinazione" value="'. $missioni[0]['destinazione'] .'"/><br/>
            Scopo: <input class="buttoninputmodificamissione" tabindex="7" type="text" name="scopo" value="'. $missioni[0]['scopo'] .'"/><br/>
        </fieldset>
        <div>
        <input type="hidden" value="'.$missione.'" name="key"/>
        <button class="buttonmodificamissione" tabindex="8" type="submit" value="Invia" name="change">Invia</button></div>';
            $paginaHTML=str_replace('<p id="campiDati"></p>',$stringa, $paginaHTML);
            echo($paginaHTML);


        }
        if (isset($_POST['change'])) {
            $nome= $data_inizio =$data_fine=$stato=$affiliazioni=$destinazione=$scopo= "";
            $missione=$_POST['key'];
            $nome=$oggettoConnessione->test_input($_POST["nome"]);
            $data_inizio = $oggettoConnessione->test_input($_POST["data_inizio"]);
            $data_fine = $oggettoConnessione->test_input($_POST["data_fine"]);
            $stato = $oggettoConnessione->test_input($_POST["stato"]);
            $affiliazioni = $oggettoConnessione->test_input($_POST["affiliazioni"]);
            $destinazione = $oggettoConnessione->test_input($_POST["destinazione"]);
            $scopo = $oggettoConnessione->test_input($_POST["scopo"]);


            $oggettoConnessione->modifica_nome($missione, $nome);
            $oggettoConnessione->modifica_data_inizio($missione, $data_inizio);
            $oggettoConnessione->modifica_data_fine($missione, $data_fine);
            $oggettoConnessione->modifica_stato($missione, $stato);
            $oggettoConnessione->modifica_affiliazioni($missione, $affiliazioni);
            $oggettoConnessione->modifica_destinazione($missione, $destinazione);
            $oggettoConnessione->modifica_scopo($missione, $scopo);



            $stringa2='<p>Modifiche inviate</p>';
            $stringa3='<p>Puoi tornare alla selezione missioni</p>';
            $paginaHTML = file_get_contents('modifica_missione.html');
            $paginaHTML=str_replace('<p id="aftersend"></p>',$stringa2, $paginaHTML);
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
