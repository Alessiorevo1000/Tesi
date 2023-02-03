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

// Initialize connection variables.
$host = 'localhost12.postgres.database.azure.com';
$database = 'localhost12';
$user ='postgres@localhost12';
$password = 'Password1';

// Initialize connection object.
$connection = pg_connect("host=localhost12.postgres.database.azure.com port=5432 dbname=postgres user=postgres@localhost12 password=Password1 sslmode=require")
            or die("Failed to create connection to database: ". pg_last_error(). "<br/>");

print "Successfully created connection to database. <br/>";

// Perform some SQL queries over the connection.
$query = "SELECT * from tipologia";
$result_set = pg_query($connection, $query) 
    or die("Encountered an error when executing given sql statement: ". pg_last_error(). "<br/>");
while ($row = pg_fetch_row($result_set))
{
    print "Data row = ($row[0]). <br/>";
}

// Free result_set
pg_free_result($result_set);

// Closing connection
pg_close($connection);


header("location: ../../Home_Section/index.php");



?>


</body>
</html>