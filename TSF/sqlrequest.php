<?php
    $host="localhost";
    $port=3306;
    $socket="";
    $user="root";
    $password="Badu@123";
    $dbname="samplecustomers";
    
    try {
        $dbh = new PDO("mysql:host={$host};port={$port};dbname={$dbname}", $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }   

    $stmt = $dbh->query('SELECT * FROM customerdetails');
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
