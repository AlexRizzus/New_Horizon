<?php
  require_once("dbConnection.php");
  $oggettoConnessione=new DBAccess();
  $connessioneOK=$oggettoConnessione->openDBConnection();
  function checkInput($username) {
      $error = "";

      if (strlen($username) < 3)
      {
          $error = "[Nome troppo corto]";
      }
      else if (strlen($username) > 30){
          $error = "[Nome troppo lungo]";
      }
  }

      $username = $_POST['username'];
      $password = $_POST['password'];
      $query= "SELECT username, psswd FROM Utenti WHERE username = '" . $username . "' AND psswd = '" . $password . "'" ;
      echo($query);
      $result = mysqli_query($oggettoConnessione->connection, $query );
      if(mysqli_num_rows($result) == 0)
      {
        echo("hai sbagliato");
      }
      else
      {
        header('Location: utente.php');
      }
      echo("sono arrivato alla fine");
 ?>
