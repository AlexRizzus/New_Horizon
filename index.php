<?php
    require_once("dbConnection.php");
    $oggettoConnessione=new DBAccess();
    $connessioneOK=$oggettoConnessione->openDBConnection();
    $paginaHTML = file_get_contents('home.html');
    $count=1;

    if($connessioneOK){
        $query="SELECT nome, data_inizio, stato FROM Missioni ORDER BY data_inizio DESC LIMIT 3";
		$queryResult=mysqli_query($oggettoConnessione->connection, $query);

		if(mysqli_num_rows($queryResult)==0){

            echo("risultato query vuoto");

        }else{

            $result=array();
            while($row=mysqli_fetch_assoc($queryResult)){
                array_push($result, $row);
            }
            foreach($result as &$array){
                $paginaHTML = str_replace("nome_missione".$count,$array['nome'], $paginaHTML);
                $paginaHTML = str_replace("data_missione".$count, $array['data_inizio'], $paginaHTML);
                $paginaHTML = str_replace("stato_missione".$count, $array['stato'], $paginaHTML);
                $count = $count + 1;
            }
            echo $paginaHTML;
        }
    }
    else
    {
        echo("connesione non riuscita, prova a ricaricare la pagina!" );

    }

?>
