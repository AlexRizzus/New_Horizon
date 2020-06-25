<?php

class DBAccess{
  const HOST_DB = '';
  const USERNAME = 'dlazzaro';
  const PASSWORD = 'ke3Ohgeef0woir0o';
  const DATABASE_NAME = 'dlazzaro';

  public $connection = null;

  public function openDBconnection() {
    $this->connection = mysqli_connect(static::HOST_DB, static::USERNAME, static::PASSWORD, static::DATABASE_NAME);
    if(!$this->connection){
      return false;
    }
    else{
      return true;
    }
  }

  public function getMissioni_perLuogo($luogo_missione) {
    $query = "SELECT nome, data_inizio, data_fine, stato, affiliazioni, destinazione, scopo FROM Missioni WHERE destinazione = '$luogo_missione' ORDER BY data_inizio DESC";
    $queryResult=mysqli_query($this->connection, $query);

    if(mysqli_num_rows($queryResult) == 0)
    {
      return null;
    }
    else{
      $result=array();
      while($row = mysqli_fetch_assoc($queryResult))
      {
        $arraySingolaMissione = array(
          'nome' => $row['nome'],
          'data_inizio' => $row['data_inizio'],
          'data_fine' => $row['data_fine'],
          'stato' => $row['stato'],
          'affiliazioni' => $row['affiliazioni'],
          'destinazione' => $row['destinazione'],
          'scopo' => $row['scopo']
        );
        array_push($result, $arraySingolaMissione);
      }
    }
    return $result;
  }
  public function getMissioni_perNome($nome_missione) {
    $query = "SELECT nome, data_inizio, data_fine, stato, affiliazioni, destinazione, scopo FROM Missioni WHERE nome = '$nome_missione'";
    $queryResult=mysqli_query($this->connection, $query);
    if(mysqli_num_rows($queryResult) == 0)
    {
      echo("Errore query missioni per nome");
      return null;
    }
    else{
      $result=array();
      while($row = mysqli_fetch_assoc($queryResult))
      {
        $arraySingolaMissione = array(
          'nome' => $row['nome'],
          'data_inizio' => $row['data_inizio'],
          'data_fine' => $row['data_fine'],
          'stato' => $row['stato'],
          'affiliazioni' => $row['affiliazioni'],
          'destinazione' => $row['destinazione'],
          'scopo' => $row['scopo']
        );
        array_push($result, $arraySingolaMissione);
      }
    }
    return $result;
  }
  public function add_mission($nome, $data_inizio, $data_fine, $stato, $affiliazioni, $destinazione, $scopo)
  {
    $query = "INSERT INTO Missioni VALUES ('$nome', '$data_inizio', '$data_fine', '$stato', '$affiliazioni', '$destinazione', '$scopo')";
    $queryResult=mysqli_query($this->connection, $query);
  }
  public function add_preferita($username,$missione)
  {
    $query = "INSERT INTO Utenti_Missioni VALUES ('$username', '$missione')";
    $queryResult=mysqli_query($this->connection, $query);
  }

  public function remove_preferita($username,$missione)
  {
    $query = "DELETE FROM Utenti_Missioni WHERE username = '$username' AND nome = '$missione'";
    $queryResult=mysqli_query($this->connection, $query);
  }
  public function remove_mission($missione)
  {
    $query = "DELETE FROM Missioni WHERE nome = '$missione'";
    $queryResult=mysqli_query($this->connection, $query);
  }
  public function getMissioniPrefe($username) {
    $query = "SELECT username, Utenti_Missioni.nome, data_inizio, data_fine, stato, affiliazioni, destinazione, scopo  FROM Utenti_Missioni INNER JOIN Missioni ON Missioni.nome=Utenti_Missioni.nome WHERE username = '$username'";
    $queryResult=mysqli_query($this->connection, $query);

    if(mysqli_num_rows($queryResult) == 0)
    {
      return null;
    }
    else{
      $result=array();
      while($row = mysqli_fetch_assoc($queryResult))
      {
        $arraySingolaEntry = array(
          'utente' => $row['username'],
          'missione' => $row['nome'],
          'data_inizio' => $row['data_inizio'],
          'data_fine' => $row['data_fine'],
          'stato' => $row['stato'],
          'affiliazioni' => $row['affiliazioni'],
          'destinazione' => $row['destinazione'],
          'scopo' => $row['scopo']
        );
        array_push($result, $arraySingolaEntry);
      }
    }
    return $result;
  }


public function getMissioni() {
  $query = "SELECT nome, data_inizio, data_fine, stato, affiliazioni, destinazione, scopo FROM Missioni ORDER BY data_inizio DESC";
  $queryResult=mysqli_query($this->connection, $query);

  if(mysqli_num_rows($queryResult) == 0)
  {
    echo("Errore query missioni");
    return null;
  }
  else{
    $result=array();
    while($row = mysqli_fetch_assoc($queryResult))
    {
      $arraySingolaMissione = array(
        'nome' => $row['nome'],
        'data_inizio' => $row['data_inizio'],
        'data_fine' => $row['data_fine'],
        'stato' => $row['stato'],
        'affiliazioni' => $row['affiliazioni'],
        'destinazione' => $row['destinazione'],
        'scopo' => $row['scopo']
      );
      array_push($result, $arraySingolaMissione);
    }
  }
  return $result;
}

public function getNomiMissioniPreferite($username) {
  $query = "SELECT username, nome FROM Utenti_Missioni WHERE username = '$username'";
  $queryResult=mysqli_query($this->connection, $query);

  if(mysqli_num_rows($queryResult) == 0)
  {
    return null;
  }
  else{
    $result=array();
    while($row = mysqli_fetch_assoc($queryResult))
    {
      $singolaEntry = $row['nome'];
      array_push($result, $singolaEntry);
    }
  }
  return $result;
}
public function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  $data = mysqli_real_escape_string($this->connection, $data);
  return $data;
}
public function modifica_nome($chiave, $valore){
  $query= "UPDATE Missioni set nome= '$valore' where nome = '$chiave'";
  $queryResult=mysqli_query($this->connection, $query);
}
public function modifica_data_inizio($chiave, $valore){
  $query= "UPDATE Missioni set data_inizio= '$valore' where nome = '$chiave'";
  $queryResult=mysqli_query($this->connection, $query);
}
public function modifica_data_fine($chiave, $valore){
  $query= "UPDATE Missioni set data_fine= '$valore' where nome = '$chiave'";
  $queryResult=mysqli_query($this->connection, $query);
}
public function modifica_stato($chiave, $valore){
  $query= "UPDATE Missioni set stato= '$valore' where nome = '$chiave'";
  $queryResult=mysqli_query($this->connection, $query);
}
public function modifica_affiliazioni($chiave, $valore){
  $query= "UPDATE Missioni set affiliazioni= '$valore' where nome = '$chiave'";
  $queryResult=mysqli_query($this->connection, $query);
}
public function modifica_destinazione($chiave, $valore){
  $query= "UPDATE Missioni set destinazione= '$valore' where nome = '$chiave'";
  $queryResult=mysqli_query($this->connection, $query);
}
public function modifica_scopo($chiave, $valore){
  $query= "UPDATE Missioni set scopo= '$valore' where nome = '$chiave'";
  $queryResult=mysqli_query($this->connection, $query);
}
public function add_message($username, $oggetto, $messaggio)
{
  $query = "INSERT INTO Messaggi_utenti VALUES ('','$username', '$oggetto', '$messaggio')";
  $queryResult=mysqli_query($this->connection, $query);
}
public function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
public function validateName($name){
  $query = "SELECT nome FROM Missioni ORDER BY data_inizio DESC";
  $queryResult=mysqli_query($this->connection, $query);
  $result=array();
    while($row = mysqli_fetch_assoc($queryResult))
    {
      $singolaEntry = $row['nome'];
      array_push($result, $singolaEntry);
    }
  foreach($result as $valore){
    if($name == $valore){
      return false;
    }
  }
  return true;

}
}
?>
