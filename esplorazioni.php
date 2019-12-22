<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('esplorazioni.html');

if($connessioneOK){
  $missioni = $oggettoConnessione->getMissioni_perLuogo("Marte"); //parametro dal form
  if(mysqli_num_rows($queryResult)==0){
    echo("risultato query vuoto");
  }else{
    $stringa_missioni = "";
    foreach($result as $valore){
      $stringa_missioni .= "<div class="mission-box">" .
      "<h2>Nome della missione: " . $valore['Nome'] . "</h2>" .
      "<p>Iniziata in data: " . $valore['data_inizio'] . "</p>" .
      "<p>Fine in data: " . $valore['data_fine'] . "</p>" .
      "<p>Stato: " . $valore['stato'] . "</p>" .
      "<p>Affiliazioni: " . $valore['affiliazioni'] . "</p>" .
      "<p>Luogo: " . $valore['destinazione'] . "</p>" .
      "<p>Scopo: " . $valore['scopo'] . "</p>" .
      "</div>";
    }
    echo str_replace("<missionsHere/>", $stringaPersonaggi, $paginaHTML);
  }
  else
  {
    echo("connessione fallita come rizzo" );
  }

  ?>
