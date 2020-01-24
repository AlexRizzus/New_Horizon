<?php
class DBAccess{
  const HOST_DB = 'localhost';
  const USERNAME = 'meowhorizon';
  const PASSWORD = '';
  const DATABASE_NAME = 'my_meowhorizon';

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
      echo("Errore query");
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

  public function add_preferita($username,$missione)
  {
    $query = "INSERT '$username', '$nome' INTO Utenti_Missioni";
  }

  public function remove_preferita($username,$missione)
  {
    $query = "DELETE FROM Utenti_Missioni WHERE username = '$username' AND nome = '$nome'";
  }

  public function getMissioniPrefe($username) {
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
        $arraySingolaEntry = array(
          'utente' => $row['username'],
          'missione' => $row['nome'],
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
    echo("Errore query");
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
}
?>
