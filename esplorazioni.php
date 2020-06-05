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
    $luogo_missione = ucfirst(strtolower($_GET['Nome_del_pianeta']));
    $missioni = $oggettoConnessione->getMissioni_perLuogo($luogo_missione);
    $paginaHTML = str_replace("<actualFilterHere/>","<span id=\"filtro_attuale\">$luogo_missione</span>",$paginaHTML);
  }
  else
  {
    if(isset($_GET['submitAnnullaFiltro']))
    {
      $luogo_missione = "";
      $missioni = $oggettoConnessione->getMissioni();
      $paginaHTML = str_replace("<actualFilterHere/>","<span>Nessun filtro</span>",$paginaHTML);
    }
    else {
       if(isset($_POST['filtro']))
       {
         if($_POST['filtro'] == "")
         {
           $missioni = $oggettoConnessione->getMissioni();
           $paginaHTML = str_replace("<actualFilterHere/>","<span>Nessun filtro</span>",$paginaHTML);
         }
         else {
           $missioni = $oggettoConnessione->getMissioni_perLuogo($_POST['filtro']);
           $luogo_missione = $_POST['filtro'];
           $paginaHTML = str_replace("<actualFilterHere/>","<span>$luogo_missione</span>",$paginaHTML);
         }
       }
       else {
         $missioni = $oggettoConnessione->getMissioni();
         $paginaHTML = str_replace("<actualFilterHere/>","<span>Nessun filtro</span>",$paginaHTML);
       }
    }
  }
  if($missioni == null){
    $paginaHTML = str_replace("<p id='planetNotFound'/>","<strong id=\"errorPlanetNotFound\">Non ci sono missioni attive o programmate presso la destinazione inserita. Controllare il pianeta inserito.</strong>",$paginaHTML);
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
          }
          else {
            $icon = '<img class="starImg" src="images/estar.png" alt="icona dei preferiti non trovata" title="metti la missione tra i tuoi preferiti cliccando qui"/>';
            $azione = "ADD";
          }
        }
        else
        {
          $icon = '<img class="starImg" src="images/estar.png" alt="icona dei preferiti non trovata" title="metti la missione tra i tuoi preferiti cliccando qui"/>';
          $azione = "ADD";
        }
      }
      else {
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
      $stringa_missioni .= '<div class="mission-box" id="missionbox' . $counter . '">' .
      "<h2>Nome della missione: " . $valore['nome'] . "</h2>" .
      '<form class="missionform' . $no_disp . '" id="missionForm' . $counter . '" action="esplorazioni.php" method="post">
      <fieldset>
      <input type="hidden" name="idForPosition" value="missionbox' . $counter . '">
      <input type="hidden" name="Azione" value="' . $azione . '"/>
      <input type="hidden" name="filtro" value="' . $luogo_missione . '"/>
      <input type="hidden" name="Nome_missione" value="' . $valore['nome'] . '"/>
      <button class="button_prefe" type="submit" name="submitPrefe" onsubmit="subm();">'
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
    $paginaHTML = str_replace("<missionsHere/>",$stringa_missioni,$paginaHTML);
    echo($paginaHTML);
  }
}else
{
  echo("connessione fallita");
}

?>
