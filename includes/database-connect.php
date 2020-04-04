<?php
/**
 * Connects to the database using PDO
 */

try {
    $connection = new PDO('sqlite:data/pdosqlite.db');
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $pdoe) {
    echo "<p>Connection failed: ".$pdoe->getMessage()."</p>";
}