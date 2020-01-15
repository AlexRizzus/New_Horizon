<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('esplorazioni.html');

if($connessioneOK){
  if (isset($_GET['submit']))
  {
    $luogo_missione = $_GET['Nome_del_pianeta'];
    $missioni = $oggettoConnessione->getMissioni_perLuogo($luogo_missione);
  }
  else
  {
  $missioni = $oggettoConnessione->getMissioni();
  }
  if($missioni == null){
    echo("risultato query vuoto");
  } else {
      $stringa_missioni = "";
      foreach($missioni as $valore){
        $stringa_missioni .= '<div class="mission-box">' .
        "<h2>Nome della missione: " . $valore['nome'] . "</h2>" .
        "<p>Iniziata in data: " . $valore['data_inizio'] . "</p>" .
        "<p>Fine in data: " . $valore['data_fine'] . "</p>" .
        "<p>Stato: " . $valore['stato'] . "</p>" .
        "<p>Affiliazioni: " . $valore['affiliazioni'] . "</p>" .
        "<p>Luogo: " . $valore['destinazione'] . "</p>" .
        "<p>Scopo: " . $valore['scopo'] . "</p>" .
        "</div>";
      }
      echo str_replace("<missionsHere/>", $stringa_missioni, $paginaHTML);
    }
  }else
  {
    echo("connessione fallita");
  }

  ?>
