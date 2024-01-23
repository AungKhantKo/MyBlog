<?php 

    try {
        $server_name="localhost";
        $dbname = "myblog";
        $dbuser = "root";
        $dbpassword = "";

        // Data source Name
        $dsn = "mysql:host=$server_name;port=3308; dbname=$dbname";
        $conn = new PDO($dsn,$dbuser,$dbpassword);

        // OR (anotherway write)

        // $conn = new PDO("mysql:host=localhost;dbname=myblog","root","");

        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        // echo "Connection Sucess";    

    } catch (PDOException $e) {
        die ("Connection fail:". $e->getMessage());
    }

?>


<!-- 
1.MySQL Procedure
2. MySQL OOP
3. PDO (PHP Data Object) Now is using PDO because it fast and more secure than the first two

it have 3 step to connect MySQL
1. Connection with database
2. Run SQL Query
3. Closing database connection 
(D project mhr dot connection ma close buu)
 -->