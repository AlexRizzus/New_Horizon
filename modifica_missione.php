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
            $stringa='<fieldset class="scrittemodificamissione"><legend class="scrittemodificamissione">Missione:</legend>Nome: <input title="Modifica il nome della missione" class="buttoninputmodificamissione" tabindex="1" type="text" name="nome" value="'. $missioni[0]['nome'] .'"/>
            Data inizio: <input title="Modifica la data inizio missione" class="buttoninputmodificamissione" type="text" name="data_inizio" value="'. $missioni[0]['data_inizio'] .'"/>
            Data di fine: <input title="Modifica la data di fine missione" class="buttoninputmodificamissione"  type="text" name="data_fine" value="'. $missioni[0]['data_fine'] .'"/>
            <p class="scrittemodificamissione">Per lo stato è possibile inserire solamente: in preparazione, in corso, terminata o fallita.</p>
            Stato: <input title="Modifica lo stato della missione" class="buttoninputmodificamissione"  type="text" name="stato" value="'. $missioni[0]['stato'] .'"/>
            Affiliazioni: <input title="Modifica le agenzie associate alla missione" class="buttoninputmodificamissione"  type="text" name="affiliazioni" value="'. $missioni[0]['affiliazioni'] .'"/>
            Luogo: <input title="Modifica il luogo della missione" class="buttoninputmodificamissione"  type="text" name="destinazione" value="'. $missioni[0]['destinazione'] .'"/>
            Scopo: <input title="Modifica lo scopo della missione" class="buttoninputmodificamissione"  type="text" name="scopo" value="'. $missioni[0]['scopo'] .'"/>
        </fieldset>
        <div>
        <input type="hidden" value="'.$missione.'" name="key"/>
        <button title="Invia le modifiche" class="buttonmodificamissione"  type="submit" value="Invia" name="change">Invia</button></div>';
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
            $scopo =$oggettoConnessione->test_input($_POST["scopo"]);


            $oggettoConnessione->modifica_nome($missione, $nome);
            $oggettoConnessione->modifica_data_inizio($missione, $data_inizio);
            $oggettoConnessione->modifica_data_fine($missione, $data_fine);
            $oggettoConnessione->modifica_stato($missione, $stato);
            $oggettoConnessione->modifica_affiliazioni($missione, $affiliazioni);
            $oggettoConnessione->modifica_destinazione($missione, $destinazione);
            $oggettoConnessione->modifica_scopo($missione, $scopo);



            $stringa2='<p class="scrittemodificamissione" >Modifiche inviate</p>';
            $stringa3='<p class="scrittemodificamissione" >Puoi tornare alla selezione missioni</p>';
            $paginaHTML = file_get_contents('modifica_missione.html');
            $paginaHTML=str_replace('<p id="aftersend"></p>',$stringa2, $paginaHTML);
            $paginaHTML=str_replace('<p id="printinvia" class="scrittemodificamissione">Cliccando su Invia modifichi la missione con i valori che hai inserito</p>',$stringa3, $paginaHTML);
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
