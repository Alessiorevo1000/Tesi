<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <title>index</title>

</head>
<body>
<a href="Home_Section/index.php">1</a> 
<?php
 $dbconn = pg_connect("host=localhost12.postgres.database.azure.com dbname=localhost12 port=5432 user=postgres password=Password1");
 $query = 'select *
           from tipologia';
 $result = pg_query_params($dbconn, $query, array()); //Ci prendiamo la TABELLA risultante dalla query
 while ($tuple = pg_fetch_array($result, null, PGSQL_ASSOC)) { //Scorriamo tutte le righe della tabella e le convertiamo in array singoli...
   print_r($tuple);
 }

?>


</body>
</html>