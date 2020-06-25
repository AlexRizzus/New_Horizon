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
      if(!preg_match("/^([a-zA-Z0-9_.+-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9])*$/",$email))
      {
        $error = "<span class='error'> email non valida</span>";
      }
      return $error;

  }

if($connessioneOK)
{
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
        $occupazione = $_POST['occupazione'];
        $errori = checkInput($username,$email,$password);
        if(!($errori == "")){
          if (strstr($errori,"Nome"))
          {
            $paginaHTML = str_replace('<div id="username-error"> </div>',$errori, $paginaHTML);
          }
          if(strstr($errori,"Password"))
          {
            $paginaHTML = str_replace('<div id="password-error"> </div>',$errori, $paginaHTML);
          }
          if(strstr($errori,"email"))
          {
            $paginaHTML = str_replace('<div id="email-error"> </div>',$errori, $paginaHTML);
          }
          $errori = "";
          echo($paginaHTML);
        }
        else{
        $query= "SELECT username FROM Utenti WHERE username = '" . $username . "'" ;
        $result = mysqli_query($oggettoConnessione->connection, $query);
        if(mysqli_num_rows($result) == 0)
        {
          $query= "INSERT INTO Utenti VALUES ('" . $username . "' , '" . $password . "' , '" . $sesso ."' , '" . $email ."' , '" . $occupazione ."' , 'generico')" ;
          $result = mysqli_query($oggettoConnessione->connection, $query);
          if($result)
          {
           $paginaHTML = str_replace('<div id="successo"> </div>',"<span id='reg_succ'>Congratulazioni! sei registrato.</span>", $paginaHTML);
          }
          else {
            $paginaHTML = str_replace('<div id="successo"> </div>',"<span class='error'>Sembra ci sia stato qualche problema, prova a ricompilare il form.</span>", $paginaHTML);
          }
        }
        else
        {
          $paginaHTML = str_replace('<div id="successo"> </div>',"<span class='error'>Questo username esiste gi&agrave;</span>", $paginaHTML);
        }
        echo($paginaHTML);
        }
      }
      else {
          echo($paginaHTML);
      }
}
 ?>
