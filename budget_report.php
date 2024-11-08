<?php
// This file will connect to the database to store information and retrieve data when it is time to create a budget analysis report.

$host = 'localhost';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

    $pdo->exec("CREATE DATABASE IF NOT EXISTS purchases_db");
    echo "Database 'purchases_db' created successfully (if it didn't exist already).<br>";

    // Switch to the 'purchases_db' database
    $pdo->exec("USE purchases_db");
    // Add `purchase` table
    $createTableSql = "
    CREATE TABLE IF NOT EXISTS `purchase` (
      `item_id` INT(11) UNSIGNED NOT NULL,
      `item_name` VARCHAR(256) NOT NULL,
      `item_price` INT(11) UNSIGNED NOT NULL,
      `item_type` VARCHAR(256) NOT NULL,
      `link` VARCHAR(256) DEFAULT NULL COMMENT 'This category is optional.',
      PRIMARY KEY (`item_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ";

    $pdo->exec($createTableSql);
    echo "Table 'purchase' created successfully.<br>";

    $dbname = $pdo->query('SELECT database()')->fetchColumn();  
    echo "Connected to the database: " . $dbname; 

} catch (PDOException $e) {
    // Handle any exceptions (e.g., connection failure)
    echo "Error!: " . $e->getMessage() . "<br>";
    die();  // Exit the script if the connection fails
}




