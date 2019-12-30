<?php
  require_once("dbConnection.php");
  $oggettoConnessione=new DBAccess();
  $connessioneOK=$oggettoConnessione->openDBConnection();
  $paginaHTML = file_get_contents('registrazione.html');
  function checkInput($username,$email,$password) {
      $error = "";

      if (strlen($username) < 3)
      {
          $error = "<span class='error'>Nome troppo corto</span>";
      }
      else if (strlen($username) > 30){
          $error = "<span class='error'>Nome troppo lungo</span>";
      }
      if (strlen($password) < 3)
      {
          $error = "<span class='error'>Password troppo corta</span>";
      }
      if(!strstr("@",$email))
      {
        $error = "<span class='error'> email non valida</span>";
      }
      return $error;

  }
if (isset($_POST['submit'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      if ($_POST['sesso'] == 'Maschio')
      {
        $sesso = 'M';
      }
      else {
        $sesso = 'F';
      }
      $occupazione = ['occupazione'];
      $errori = checkInput($username,$email,$password);
      if(!($errori == "")){
        if (strstr($errori,"Nome"))
        {
          $paginaHTML = str_replace("<erroreUsername/>",$errori, $paginaHTML);
        }
        if(strstr($errori,"Password"))
        {
          $paginaHTML = str_replace("<errorePassword/>",$errori, $paginaHTML);
        }
        if(strstr($errori,"email"))
        {
          $paginaHTML = str_replace("<erroreEmail/>",$errori, $paginaHTML);
        }
        $errori = "";
        echo($paginaHTML);
      }
      else{
      $query= "SELECT username FROM Utenti WHERE username = '" . $username . "'" ;
      echo($query);
      $result = mysqli_query($oggettoConnessione->connection, $query);
      if(mysqli_num_rows($result) == 0)
      {
        $query= "INSERT INTO Utenti VALUES ('" . $username . "' , '" . $password . "' , '" . $sesso ."' , '" . $email ."' , '" . $occpuazione ."' , 'generico')" ;
        $result = mysqli_query($oggettoConnessione->connection, $query);
        echo($query);
        if($result)
        {
         $paginaHTML = str_replace("<successo/>","<span>Congratulazioni! sei registrato.</span>", $paginaHTML);
        }
        else {
          $paginaHTML = str_replace("<successo/>","<span class='error'>Sembra ci sia stato qualche problema, prova a ricompilare il form.</span>", $paginaHTML);
        }
      }
      else
      {
        $paginaHTML = str_replace("<erroreUsername/>","<span class='error'>Questo username esiste già</span>", $paginaHTML);
      }
      echo($paginaHTML);
    }
    }
    else {
      {
        echo($paginaHTML);
      }
    }
 ?>
