<?php
require_once("dbConnection.php");
$oggettoConnessione=new DBAccess();
$connessioneOK=$oggettoConnessione->openDBConnection();
$paginaHTML = file_get_contents('esplorazioni.html');
session_start();

global $luogo_missione;

if($connessioneOK){
  if (isset($_POST['submitPrefe']))
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
    if($_GET['Nome_del_pianeta'] !== "Cerca luogo…") {
      $error_invalid_filter = false;
      $luogo_missione = ucfirst(strtolower($_GET['Nome_del_pianeta']));
      $filtroAttStr = 'Filtro attuale: ' . $luogo_missione;
      $missioni = $oggettoConnessione->getMissioni_perLuogo($luogo_missione);
      $paginaHTML = str_replace("<span id='actualFilterHere'>nessun filtro</span>","<span id=\"filtro_attuale\">$luogo_missione</span>",$paginaHTML);
      $paginaHTML = str_replace('<p id="searchError">Errore, inserire un nume di un luogo da cercare!</p>','<p id="searchError"></p>',$paginaHTML);
    }
    else {
      $error_invalid_filter = true;
      $missioni = $oggettoConnessione->getMissioni();
      $paginaHTML = str_replace('<p id="searchError"></p>','<p id="searchError">Errore, inserire un nome di un luogo da cercare!</p>',$paginaHTML);
    }
  }
  else
  {
    if(isset($_GET['submitAnnullaFiltro']))
    {
      $filtroAttStr = 'Nessun filtro attualmente applicato';
      $missioni = $oggettoConnessione->getMissioni();
    }
    else {
       if(isset($_POST['filtro']))
       {
         if($_POST['filtro'] == "")
         {
           $missioni = $oggettoConnessione->getMissioni();
         }
         else {
           $missioni = $oggettoConnessione->getMissioni_perLuogo($_POST['filtro']);
           $luogo_missione = $_POST['filtro'];
           $filtroAttStr = 'Filtro attuale: ' . $luogo_missione;
         }
       }
       else {
         $missioni = $oggettoConnessione->getMissioni();
       }
    }
  }
  if(!isset($missioni)){
    if(!$error_invalid_filter === true) {
      $paginaHTML = str_replace("<p id='planetNotFound'></p>","<strong id=\"errorPlanetNotFound\">Non ci sono missioni attive o programmate presso la destinazione inserita. Controllare il pianeta inserito.</strong>",$paginaHTML);
    }
    echo($paginaHTML);
  } else {
    $stringa_missioni = "";
    $missioni_preferite_utente = null;
    if(isset($_SESSION['username']))
    {
      $missioni_preferite_utente = $oggettoConnessione->getNomiMissioniPreferite($_SESSION['username']);
    }
    $counter = 0;
    foreach($missioni as $valore){
      $counter++;
      if(isset($_SESSION['username']))
      {
        $no_disp = '';
        if(is_array($missioni_preferite_utente) === true)
        {
          if(in_array($valore['nome'],$missioni_preferite_utente))
          {
            $icon = '<img class="starImg" src="images/star.png" alt="icona dei preferiti non trovata" title="togli la missione tra i tuoi preferiti cliccando qui"/>';
            $azione = "REMOVE";
            $azioneStr = "Rimuovi missione dai preferiti";
          }
          else {
            $icon = '<img class="starImg" src="images/estar.png" alt="icona dei preferiti non trovata" title="metti la missione tra i tuoi preferiti cliccando qui"/>';
            $azione = "ADD";
            $azioneStr = "Aggiungi missione ai preferiti";
          }
        }
        else
        {
          $icon = '<img class="starImg" src="images/estar.png" alt="icona dei preferiti non trovata" title="metti la missione tra i tuoi preferiti cliccando qui"/>';
          $azione = "ADD";
          $azioneStr = "Aggiungi missione ai preferiti";
        }
      }
      else {
        $azioneStr = '';
        $azione = null;
        $icon = '';
        $no_disp = ' no_disp';
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
      if(!isset($filtroAttStr)) {
        $filtroAttStr = "";
      }
      $stringa_missioni .= '<div class="mission-box" id="missionbox' . $counter . '">' .
      "<h2>Nome della missione: " . $valore['nome'] . "</h2>" .
      '<form class="missionform' . $no_disp . '" id="missionForm' . $counter . '" action="esplorazioni.php" method="post" onsubmit="subm();">
      <fieldset id="fieldser'. $counter .'">
      <input title="' . $azioneStr . '" type="hidden" id="actionInp' . $counter . '" name="Azione" value="' . $azione . '"/>
      <input type="' .$filtroAttStr. '" type="hidden" id="filterInp' . $counter . '" name="filtro" value="' . $luogo_missione . '"/>
      <input title="Missione denominata ' . $valore['nome'] . '" type="hidden" id="nomeInp' . $counter . '" name="Nome_missione" value="' . $valore['nome'] . '"/>
      <button class="button_prefe" type="submit" title="' . $azioneStr . '" name="submitPrefe">'
      . $icon .
      '</button>
      </fieldset>
      </form>' .
      "<p>Iniziata in data: " . $data_ini . "</p>" .
      "<p>Fine in data: " . $data_fin . "</p>" .
      "<p>Stato: " . $valore['stato'] . "</p>" .
      "<p>Affiliazioni: " . $valore['affiliazioni'] . "</p>" .
      "<p>Luogo: " . $valore['destinazione'] . "</p>" .
      "<p>Scopo: " . $valore['scopo'] . "</p>" .
      "</div>";
    }
    $paginaHTML = str_replace("<div id='missionsHere'></div>",$stringa_missioni,$paginaHTML);
    echo($paginaHTML);
  }
}else
{
  echo("connessione fallita");
}

?>
