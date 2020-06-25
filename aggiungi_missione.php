<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('aggiungi_missione.html');
session_start();

if(isset($_SESSION['livello'])){
    if($_SESSION['livello'] == "amministratore"){
            $stringa='<fieldset class="scrittemodificamissione"><legend class="scrittemodificamissione">Missione:</legend>
            <p id="erroreNome"></p>Nome: <input title="Inserisci il nome della missione"  class="buttoninputmodificamissione" type="text" name="nome"/>
            <p id="erroreDataInizio"></p>Data inizio nel formato YYYY-MM-DD: <input title="Inserisci la data iniziale"  class="buttoninputmodificamissione" type="text" name="data_inizio"/>
            <p id="erroreDataFine"></p>Data di fine nel formato YYYY-MM-DD: <input title="Inserisci la data di fine"  class="buttoninputmodificamissione" type="text" name="data_fine"/>
            <p class="scrittemodificamissione">Per lo stato è possibile inserire solamente: in preparazione, in corso, terminata o fallita.</p>
            <p id="erroreStato"></p>Stato: <input title="Inserisci lo stato della missione, puoi inserire in preparazione, in corso, terminata o fallita"  class="buttoninputmodificamissione" type="text" name="stato"/>
            <p id="erroreAffiliazioni"></p>Affiliazioni: <input title="Inserisci le agenzie affiliate nella missione"  class="buttoninputmodificamissione" type="text" name="affiliazioni"/>
            <p id="erroreLuogo"></p>Luogo: <input title="Inserisci il luogo della missione"  class="buttoninputmodificamissione" type="text" name="destinazione"/>
            <p id="erroreScopo"></p>Scopo: <input title="Inserisci lo scopo della missione"  class="buttoninputmodificamissione" type="text" name="scopo"/></fieldset>
            <div><input type="hidden" name="key"/>
            <button  class="buttonmodificamissione" type="submit" name="add">Invia</button></div>';
            $paginaHTML=str_replace('<p id="campiDati"></p>',$stringa, $paginaHTML);

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

            $errori = false;

            if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$data_inizio) || !$oggettoConnessione->validateDate($data_inizio, 'Y-m-d')){
                $erroreDataInizio = '<p class="erroreModifica">La data deve essere nel formato YYYY-MM-DD</p>';
                $paginaHTML = str_replace('<p id="erroreDataInizio"></p>', $erroreDataInizio, $paginaHTML);
                $errori = true;
            }
            else{
                $oggettoConnessione->modifica_data_inizio($missione, $data_inizio);
            }
            if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$data_fine) || !$oggettoConnessione->validateDate($data_fine, 'Y-m-d') || $data_fine < $data_inizio ){
            
                $erroreDataFine = '<p class="erroreModifica">La data di fine deve essere nel formato YYYY-MM-DD e non deve essere antecedente alla data inizio</p>';
                $paginaHTML = str_replace('<p id="erroreDataFine"></p>', $erroreDataFine, $paginaHTML);
                $errori = true;
                
            }
            else{
                $oggettoConnessione->modifica_data_fine($missione, $data_fine);
            }
            if($stato == 'in preparazione' || $stato=='in corso' || $stato=='rientrata' || $stato=='fallita' || $stato=='terminata'){
                
                $oggettoConnessione->modifica_stato($missione, $stato);
            }
            else{
                $erroreStato = '<p class="erroreModifica">Lo stato deve essere: in preparazione, in corso, rientrata, fallita o terminata</p>';
                $paginaHTML = str_replace('<p id="erroreStato"></p>', $erroreStato, $paginaHTML);
                $errori = true;
            }
            
            if(strlen($nome)<26 && strlen($nome)>6){
                if($oggettoConnessione->validateName($nome)){
                    $oggettoConnessione->modifica_nome($missione, $nome);
                }
                else{
                    $erroreNome = '<p class="erroreModifica">Il nome è già associato ad una missione</p>';
                    $paginaHTML=str_replace('<p id="erroreNome"></p>', $erroreNome, $paginaHTML);
                    $errori = true;
                }
            }
            else{
                $erroreNome = '<p class="erroreModifica">Il nome deve essere almeno di 6 caratteri e meno di 25 caratteri</p>';
                $paginaHTML=str_replace('<p id="erroreNome"></p>', $erroreNome, $paginaHTML);
                $errori = true;
            }

            if(strlen($affiliazioni)<201){
                $oggettoConnessione->modifica_affiliazioni($missione, $affiliazioni);
            }
            else{
                $paginaHTML=str_replace('<p id="erroreAffiliazioni"></p>', '<p class="erroreModifica">Affiliazioni non deve superare 200 caratteri</p>', $paginaHTML);
                $errori = true;
            }

            if(strlen($destinazione)<41 && strlen($destinazione)>3){
                $oggettoConnessione->modifica_destinazione($missione, $destinazione);
            }
            else{
                $erroreLuogo = '<p class="erroreModifica">Luogo deve essere specificato e non deve superare i 40 caratteri</p>';
                $paginaHTML=str_replace('<p id="erroreLuogo"></p>', $erroreLuogo, $paginaHTML);
                $errori = true;
            }

            if(strlen($scopo)<201){
                $oggettoConnessione->modifica_scopo($missione, $scopo);
            }
            else{
                $paginaHTML=str_replace('<p id="erroreScopo"></p>', '<p class="erroreModifica">Scopo non deve superare 200 caratteri</p>', $paginaHTML);
                $errori = true;
            }


            if($errori== false){
                $paginaHTML = file_get_contents('aggiungi_missione.html');
                $oggettoConnessione->add_mission($nome, $data_inizio, $data_fine, $stato, $affiliazioni, $destinazione, $scopo);
                $stringa2='<p class="scrittemodificamissione">Missione aggiunta</p>';
                $paginaHTML=str_replace('<p id="prova"></p>',$stringa2, $paginaHTML);
            }
            $stringa='<fieldset class="scrittemodificamissione"><legend class="scrittemodificamissione">Missione:</legend>
            <p id="erroreNome"></p>Nome: <input title="Inserisci il nome della missione"  class="buttoninputmodificamissione" type="text" name="nome" value="'. $_POST["nome"] .'"/>
            <p id="erroreDataInizio"></p>Data inizio: <input title="Inserisci la data iniziale"  class="buttoninputmodificamissione" type="text" name="data_inizio" value="'. $_POST["data_inizio"] .'"/>
            <p id="erroreDataFine"></p>Data di fine: <input title="Inserisci la data di fine"  class="buttoninputmodificamissione" type="text" name="data_fine" value="'. $_POST["data_fine"] .'"/>
            <p class="scrittemodificamissione">Per lo stato è possibile inserire solamente: in preparazione, in corso, terminata o fallita.</p>
            <p id="erroreStato"></p>Stato: <input title="Inserisci lo stato della missione, puoi inserire in preparazione, in corso, terminata o fallita"  class="buttoninputmodificamissione" type="text" name="stato" value="'. $_POST["stato"] .'"/>
            <p id="erroreAffiliazioni"></p>Affiliazioni: <input title="Inserisci le agenzie affiliate nella missione"  class="buttoninputmodificamissione" type="text" name="affiliazioni" value="'. $_POST["affiliazioni"] .'"/>
            <p id="erroreLuogo"></p>Luogo: <input title="Inserisci il luogo della missione"  class="buttoninputmodificamissione" type="text" name="destinazione" value="'. $_POST["destinazione"] .'"/>
            <p id="erroreScopo"></p>Scopo: <input title="Inserisci lo scopo della missione"  class="buttoninputmodificamissione" type="text" name="scopo" value="'. $_POST["scopo"] .'"/></fieldset>
            <div><input type="hidden" name="key"/>
            <button  class="buttonmodificamissione" type="submit" name="add">Invia</button></div>';
            $paginaHTML=str_replace('<p id="campiDati"></p>',$stringa, $paginaHTML);
   
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
