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
          $queryResult=mysqli_query($oggettoConnessione->connection, $query);

          if(mysqli_num_rows($queryResult) == 0)
          {
            return null;
          }
          else{
            while($row = my_sqli_fetch_assoc($queryResult))
            {
              $arraySingolaMissione = array(
                'Nome' => $row['nome'],
                'Data di inizio' => $row['data_inizio'],
                'Data di fine' => $row['data_fine'],
                'Stato' => $row['stato'],
                'Affiliazioni' => $row['affiliazioni'],
                'Destinazione' => $row['destinazione'],
                'Scopo' => $row['scopo']
              );
              array_push($result, $arraySingolaMissione);
          }
          return $result;
        }
      }
    }
    ?>
