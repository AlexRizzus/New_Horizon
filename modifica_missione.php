<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('modifica_missione.html');
session_start();


if(isset($_SESSION['livello'])){
    if($_SESSION['livello'] == "amministratore"){
        //creazione form modifica

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

            $errori = false;
            $errore_scopo = false;
            $errore_nome= false;
            $errore_stato= false;
            $errore_destionazione=false;
            $errore_affiliazione = false;
            $errore_dataFine = false;
            $errore_dataInizio=false;





            
            if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$data_inizio) || !$oggettoConnessione->validateDate($data_inizio, 'Y-m-d')){
               
                $errore_dataInizio = true;   
            }
            else{
                $oggettoConnessione->modifica_data_inizio($missione, $data_inizio);
            }
            if(!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$data_fine) || !$oggettoConnessione->validateDate($data_fine, 'Y-m-d') || $data_fine < $data_inizio ){
            
                $errore_dataFine = true;
                
            }
            else{
                $oggettoConnessione->modifica_data_fine($missione, $data_fine);
            }
            if($stato == 'in preparazione' || $stato=='in corso' || $stato=='rientrata' || $stato=='fallita' || $stato=='terminata'){
                
                $oggettoConnessione->modifica_stato($missione, $stato);
            }
            else{
                $errore_stato=true;
            }
            
            if(strlen($nome)<26 && strlen($nome)>6){
                 $oggettoConnessione->modifica_nome($missione, $nome);
            }
            else{
                $errore_nome = true;
            }
            
            if(strlen($affiliazioni)<201){
                $oggettoConnessione->modifica_affiliazioni($missione, $affiliazioni);
            }
            else{
                $errore_affiliazione=true;
            }

            if(strlen($destinazione)<41 && strlen($destinazione)>3){
                $oggettoConnessione->modifica_destinazione($missione, $destinazione);
            }
            else{
                $errore_destionazione=true;
            }

            if(strlen($scopo)<201){
                $oggettoConnessione->modifica_scopo($missione, $scopo);
            }
            else{
                $errore_scopo=true;
            }



            $stringa2='<p class="scrittemodificamissione" >Modifiche inviate</p>';
            $stringa3='<p class="scrittemodificamissione" >Puoi tornare alla selezione missioni</p>';
            
            
            
        }
        $missione = $_POST['nome'];
        if(strlen($missione)>25){
            $missione=$_POST['key'];
        }
        $missioni=[];
        $missioni=$oggettoConnessione->getMissioni_perNome($missione);
        $stringa='<fieldset class="scrittemodificamissione"><legend class="scrittemodificamissione">Missione:</legend><p id="erroreNome"></p>Nome: <input title="Modifica il nome della missione" class="buttoninputmodificamissione" type="text" name="nome" value="'. $missioni[0]['nome'] .'"/>
        <p id="erroreDataInizio"></p>Data inizio: <input title="Modifica la data inizio missione" class="buttoninputmodificamissione" type="text" name="data_inizio" value="'. $missioni[0]['data_inizio'] .'"/>
        <p id="erroreDataFine"></p>Data di fine: <input title="Modifica la data di fine missione" class="buttoninputmodificamissione"  type="text" name="data_fine" value="'. $missioni[0]['data_fine'] .'"/>
        <p class="scrittemodificamissione">Per lo stato è possibile inserire solamente: in preparazione, in corso, terminata o fallita.</p>
        <p id="erroreStato"></p> Stato: <input title="Modifica lo stato della missione, puoi inserire in preparazione, in corso, terminata o fallita" class="buttoninputmodificamissione"  type="text" name="stato" value="'. $missioni[0]['stato'] .'"/>
        <p id="erroreAffiliazioni"></p> Affiliazioni: <input title="Modifica le agenzie associate alla missione" class="buttoninputmodificamissione"  type="text" name="affiliazioni" value="'. $missioni[0]['affiliazioni'] .'"/>
        <p id="erroreLuogo"></p> Luogo: <input title="Modifica il luogo della missione" class="buttoninputmodificamissione"  type="text" name="destinazione" value="'. $missioni[0]['destinazione'] .'"/>
        <p id="erroreScopo"></p> Scopo: <input title="Modifica lo scopo della missione" class="buttoninputmodificamissione"  type="text" name="scopo" value="'. $missioni[0]['scopo'] .'"/>
        </fieldset>
        <div>
        <input type="hidden" value="'.$missione.'" name="key"/>
        <button title="Invia le modifiche" class="buttonmodificamissione"  type="submit" value="Invia" name="change">Invia</button></div>';
        $paginaHTML=str_replace('<p id="campiDati"></p>',$stringa, $paginaHTML);
        
        
        if(isset($_POST['change'])){
            if($errore_dataInizio){
                $erroreDataInizio = '<p class="erroreModifica">La data deve essere nel formato YYYY-MM-DD</p>';
                $paginaHTML = str_replace('<p id="erroreDataInizio"></p>', $erroreDataInizio, $paginaHTML);
                $errori = true;
            }
            if($errore_dataFine){
                $erroreDataFine = '<p class="erroreModifica">La data di fine deve essere nel formato YYYY-MM-DD e non deve essere antecedente alla data inizio</p>';
                $paginaHTML = str_replace('<p id="erroreDataFine"></p>', $erroreDataFine, $paginaHTML);
                $errori = true;
            }
            if($errore_stato){
                $erroreStato = '<p class="erroreModifica">Lo stato deve essere: in preparazione, in corso, rientrata, fallita o terminata</p>';
                $paginaHTML = str_replace('<p id="erroreStato"></p>', $erroreStato, $paginaHTML);
                $errori = true;
            }
            if($errore_nome){
                $erroreNome = '<p class="erroreModifica">Il nome non deve eccedere 25 caratteri ma deve superare 6 caratteri di lunghezza</p>';
                $paginaHTML=str_replace('<p id="erroreNome"></p>', $erroreNome, $paginaHTML);
                $errori = true;
            }
            if($errore_affiliazione){
                $paginaHTML=str_replace('<p id="erroreAffiliazioni"></p>', '<p class="erroreModifica">Affiliazioni non deve superare 200 caratteri</p>', $paginaHTML);
                $errori = true;
            }
            if($errore_destionazione){
                $erroreLuogo = '<p class="erroreModifica">Luogo non deve superare 40 caratteri ma deve essere almeno di 3 caratteri</p>';
                $paginaHTML=str_replace('<p id="erroreLuogo"></p>', $erroreLuogo, $paginaHTML);
                $errori = true;
            }
            if($errore_scopo){
                $paginaHTML=str_replace('<p id="erroreScopo"></p>', '<p class="erroreModifica">Scopo non deve superare 200 caratteri</p>', $paginaHTML);
                $errori = true;
            }
            if($errori == false){
                $paginaHTML = file_get_contents('modifica_missione.html');
                $paginaHTML=str_replace('<p id="aftersend"></p>',$stringa2, $paginaHTML);
                $paginaHTML=str_replace('<p id="printinvia" class="scrittemodificamissione">Cliccando su Invia modifichi la missione con i valori che hai inserito</p>',$stringa3, $paginaHTML);
            }


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
