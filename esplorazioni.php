<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('esplorazioni.html');
session_start();

if($connessioneOK){

  if (isset($_POST['submitPrefe']))
  {
    $missione = $_POST['Nome_missione'];
    if(isset($_SESSION['username']))
    {
      if($_POST['Azione'] == "ADD")
      {
        // qua aggiungo la missione ai preferiti
        echo("ADD");
        $oggettoConnessione->add_preferita($_SESSION['username'], $missione);
      }
      else {
        // rimuovo la missione dai preferiti
        echo("REMOVE");
        $oggettoConnessione->remove_preferita($_SESSION['username'], $missione);
      }
    }
  }

  if (isset($_GET['submit']))
  {
    $luogo_missione = ucfirst(strtolower($_GET['Nome_del_pianeta']));
    $missioni = $oggettoConnessione->getMissioni_perLuogo($luogo_missione);
  }
  else
  {
  $missioni = $oggettoConnessione->getMissioni();
  }
  $counter = 13;
  if($missioni == null){
    echo("risultato query vuoto");
  } else {
      $stringa_missioni = "";
      if(isset($_SESSION['username']))
      {
        $missioni_preferite_utente = $oggettoConnessione->getMissioniPrefe($_SESSION['username']);
      }
      foreach($missioni as $valore){
        $counter = $counter + 1;
        if(isset($_SESSION['username']))
        {
          $no_disp = '';
          if(in_array($valore['nome'],$missioni_preferite_utente['nome']))
          {
            $icon = 'src="images/star.png"';
            $azione = "REMOVE";
          }
          else {
            $icon = 'src="images/estar.png"';
            $azione = "ADD";
          }
        }
        else {
          $icon = '';
          $no_disp = 'class="no_disp"';
        }
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
        $stringa_missioni .= '<div class="mission-box" tabindex="' . $counter . '">' .
        "<h2>Nome della missione: " . $valore['nome'] . "</h2>" .
        '<form action="esplorazioni.php" method="post">
          <input type="hidden" name="Azione" value=' . $azione . '/>
          <button type="submit" name="submitPrefe" ' . $no_disp . '>
            <img ' . $icon . ' alt="icona dei preferiti non trovata" title="icona dei preferiti"/>
          </button>
        </form>' .
        "<p>Iniziata in data: " . $data_ini . "</p>" .
        "<p>Fine in data: " . $data_fin . "</p>" .
        "<p>Stato: " . $valore['stato'] . "</p>" .
        "<p>Affiliazioni: " . $valore['affiliazioni'] . "</p>" .
        "<p>Luogo: " . $valore['destinazione'] . "</p>" .
        "<p>Scopo: " . $valore['scopo'] . "</p>" .
        "</div>";
      }
      $stringa_loghi = "<img src=\"images/twitter.png\" class=\"footer-icon\" tabindex=\"$counter+1\" alt=\"twitter logo\"/>" .
       "<img src=\"images/facebook.png\" class=\"footer-icon\" tabindex=\"$counter+2\" alt=\"facebook logo\"/>" .
       "<img src=\"images/instagram.png\" class=\"footer-icon\" tabindex=\"$counter+3\" alt=\"instagram logo\"/>";
      $paginaHTML = str_replace("<imagesHere/>", $stringa_loghi, $paginaHTML);
      echo str_replace("<missionsHere/>",$stringa_missioni,$paginaHTML);
    }
  }else
  {
    echo("connessione fallita");
  }

  ?>
