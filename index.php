<?php
    require_once("dbConnection.php");
    $oggettoConnessione=new DBAccess();
    $connessioneOK=$oggettoConnessione->openDBConnection();
    $paginaHTML = file_get_contents('home.html');
    $count=1;

    if($connessioneOK){
        $query="SELECT 'nome', 'data_inizio', 'stato' FROM Missioni OREDR BY 'data_inizio DESC LIMIT 3";
		$queryResult=mysqli_query($this->connection, $query);

		if(mysqli_num_rows($queryResult)==0){

            throw new Exception("risultato query vuoto", 1);
            ;

        }else{

            $result=array();
            while($row=mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            foreach($result as $array){
                str_replace("<h2>nome_missione</h2>", $array['nome'], $paginaHTML, $count);
                str_replace("<p>data_missione</p>", $array['data_inizio'], $paginaHTML, $count);
                str_replace("<p>stato_missione</p>", $array['stato'], $paginaHTML,$count);
            }
            echo 
        }
    }
    else
    {
        throw new Exception("connessione fallita come rizzo", 1);
        
    }

?>