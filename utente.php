<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
  $paginaHTML = file_get_contents('utente.html');
  session_start();
  if(isset($_SESSION['livello']))
  {
    if( $_SESSION['livello'] == 'generico')
    {
      $elencopref = "";
      $query= "SELECT nome FROM Utenti_Missioni WHERE username = '" . $_SESSION['username'] ."'";
      $result_pref = mysqli_query($oggettoConnessione->connection, $query );
      $paginaHTML = str_replace("<username/>",$_SESSION['username'] ,$paginaHTML);
      $paginaHTML = str_replace("<email/>",$_SESSION['email'],$paginaHTML);
      $paginaHTML = str_replace("<tabellapreferiti/>","<div id='contentMission'><missions/> </div>",$paginaHTML);
      $missioni = $oggettoConnessione->getMissioniPrefe($_SESSION['username']);
      foreach($missioni as $valore){
        $stringa_missioni = "";
        $data_ini = "N/A";
        $data_fin = "N/A";
        if($valore['data_inizio'] != null)
        {
          $data_ini = $valore['data_inizio'];
        }
        if($valore['data_fine'] != null)
        {
          $data_fin = $valore['data_fine'];
        }
        $stringa_missioni .= '<div class="mission-box">' .
        "<h2>Nome della missione: " . $valore['missione'] . "</h2>" .
        "<p>Iniziata in data: " . $data_ini . "</p>" .
        "<p>Fine in data: " . $data_fin . "</p>" .
        "<p>Stato: " . $valore['stato'] . "</p>" .
        "<p>Affiliazioni: " . $valore['affiliazioni'] . "</p>" .
        "<p>Luogo: " . $valore['destinazione'] . "</p>" .
        "<p>Scopo: " . $valore['scopo'] . "</p>" .
        "</div>";
    }
        $paginaHTML = str_replace("<missions/>",$stringa_missioni,$paginaHTML);
        echo($paginaHTML);
    }
    else {
      // non &egrave; un utente, ridireziona alla pagina admin
      header('Location: admin.php');
    }
  }
  else {
    // non &egrave; autenticato, ridireziona alla pagina login
    header('Location: login.php');
  }
