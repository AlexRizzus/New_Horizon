<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('esplorazioni.html');

if($connessioneOK){

  if (isset($_POST['submit']))
  {
    $missione = $_POST['Nome_missione'];
    if(isset($_SESSION['username']))
    {
      if($_POST['Azione'] == "ADD")
      {
        // qua aggiungo la missione ai preferiti
        $oggettoConnessione->add_preferita($_SESSION['username'], $missione);
      }
      else {
        // rimuovo la missione dai preferiti
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
  if($missioni == null){
    echo("risultato query vuoto");
  } else {
      $stringa_missioni = "";
      if(isset($_SESSION['username']))
      {
        $missioni_preferite_utente = $oggettoConnessione->getMissioniPrefe($_SESSION['username']);
      }
      foreach($missioni as $valore){
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
          $no_disp = 'style="display: none;"';
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
        $stringa_missioni .= '<div class="mission-box">' .
        "<h2>Nome della missione: " . $valore['nome'] . "</h2>" .
        '<form>
          <input type="hidden" name="Azione" value=' . $azione . '/>
          <button type="submit" ' . $no_disp . '>
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
      echo str_replace("<missionsHere/>", $stringa_missioni, $paginaHTML);
    }
  }else
  {
    echo("connessione fallita");
  }

  ?>
