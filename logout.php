<?php
  require_once("dbConnection.php");
  $oggettoConnessione=new DBAccess();
  $connessioneOK=$oggettoConnessione->openDBConnection();
  $paginaHTML = file_get_contents('login.html');
  if(isset($_POST['logout']))
  {
    session_start();
    header('Location: login.php');
    session_unset();

  }
  ?>
