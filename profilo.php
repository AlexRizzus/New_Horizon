<?php
  require_once("dbConnection.php");
  $oggettoConnessione=new DBAccess();
  $connessioneOK=$oggettoConnessione->openDBConnection();

  if($_SESSION['livello'] == 'amministratore')
  {
    $paginaHTML = file_get_contents('admin.html');
    $paginaHTML = str_replace('<username/>',"<span class =''> Username: " . $_SESSION['username'] . "<span/>")
    $paginaHTML = str_replace('<email/>',"<span class =''> e-mail: " . $_SESSION['email'] . "<span/>")
    $paginaHTML = str_replace('<username/>',"<span class =''> Username: " . $_SESSION['sesso'] . "<span/>")
    $paginaHTML = str_replace('<username/>',"<span class =''> Username: " . $_SESSION['occupazione'] . "<span/>")
    echo($paginaHTML);
  }
  else
  {
    $paginaHTML = file_get_contents('utente.html');
    $paginaHTML = str_replace('<username/>',"<span class =''> Username: " . $_SESSION['username'] . "<span/>")
    $paginaHTML = str_replace('<email/>',"<span class =''> e-mail: " . $_SESSION['email'] . "<span/>")
    $paginaHTML = str_replace('<username/>',"<span class =''> Username: " . $_SESSION['sesso'] . "<span/>")
    $paginaHTML = str_replace('<username/>',"<span class =''> Username: " . $_SESSION['occupazione'] . "<span/>")
    echo($paginaHTML);
  }
