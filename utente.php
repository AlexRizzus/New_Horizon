<?php
  $paginaHTML = file_get_contents('utente.html');
  if(isset($_SESSION['livello']))
  {
    if( $_SESSION['livello'] == 'generico')
    {
      $elencopref = "";
      $query= "SELECT nome FROM Utenti_Missioni WHERE username = '" . $_SESSION['username'] ."'";
      $result_pref = mysqli_query($oggettoConnessione->connection, $query );
      $query= "SELECT nome FROM Utenti_Missioni WHERE username = '" . $_SESSION['username'] ."'";
      $result = mysqli_query($oggettoConnessione->connection, $query );
      echo($paginaHTML);
    }
    else {
      // non è un utente, ridireziona alla pagina admin
      header('Location: admin.php');
    }
  }
  else {
    // non è autenticato, ridireziona alla pagina login
    header('Location: login.php');
  }