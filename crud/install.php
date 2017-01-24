<?php
require 'database.php';
require 'install_db.php';

Create::connectDB();
Create::checkIfDbExists('customer_purchase');
Create::closeDB();



try
{
$cont = Database::connect();
    // set the PDO error mode to exception
$cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
$sql = "CREATE TABLE  `purchase` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`date` DATE NOT NULL ,
`description` VARCHAR( 150 ) NOT NULL ,
`price` DECIMAL NOT NULL
) ENGINE = INNODB;";

    // use exec() because no results are returned
$cont->exec($sql);
echo "Table purchase created successfully";
}

catch
(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}

//$cont = null; nur sinnig wenn include oder require


    header('Location: index.php');
?>