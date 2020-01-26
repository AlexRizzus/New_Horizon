<?php
  require_once("dbConnection.php");
  $oggettoConnessione=new DBAccess();
  $connessioneOK=$oggettoConnessione->openDBConnection();
  $paginaHTML = file_get_contents('login.html');
  session_start();
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
      return $error;

  }
  if($_SESSION['username'] != ''){
    header('Location: utente.php');
  }
  else{
  if(isset($_POST['submit'])){
      $username = $_POST['username'];
      $password = $_POST['password'];
      if(!($errori == "")){
        if (strstr($errori,"Nome"))
        {
          $paginaHTML = str_replace("<erroreUsername/>",$errori, $paginaHTML);
        }
        if(strstr($errori,"Password"))
        {
          $paginaHTML = str_replace("<errorePassword/>",$errori, $paginaHTML);
        }
        $errori = "";
        echo($paginaHTML);
      }
      else{
      $query= "SELECT username, e_mail, occupazione, psswd, livello FROM Utenti WHERE username = '" . $username . "' AND psswd = '" . $password . "'" ;
      $result = mysqli_query($oggettoConnessione->connection, $query );
      if(mysqli_num_rows($result) == 0)
      {
          $paginaHTML = str_replace('<div id="login-error"> </div>',"<span class='error'>username o password non corrette, riprova</span>", $paginaHTML);
          echo($paginaHTML);
      }
      else
      {
        $array = mysqli_fetch_assoc($result);
        session_destroy();
        session_start();
        $_SESSION['username'] = $array['username'];
        $_SESSION['email'] = $array['e_mail'];
        $_SESSION['sesso'] = $array['sesso'];
        $_SESSION['occupazione'] = $array['occupazione'];
        $_SESSION['livello'] = $array['livello'];
        if ($array['livello'] == 'amministratore') {
          header('Location: admin.php');
        }
        else {
          header('Location: utente.php');
        }
      }
    }
  }
    else{
      echo($paginaHTML);
    }
  }
 ?>
