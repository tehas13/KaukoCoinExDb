<?php

//fetch.php

include('database_connection.php');

if(isset($_POST["year"]))
{
    $query = "
 SELECT * FROM btcall 
 WHERE year = '".$_POST["year"]."' 
 ORDER BY id ASC
 ";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output[] = array(
            'year'   => $row["year"],
            'price'  => floatval($row["price"])
        );
    }
    echo json_encode($output);
}

?>
