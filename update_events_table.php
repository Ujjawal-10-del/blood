<?php
// Database connection settings
$host = 'localhost';
$db   = 'bbdms';
$user = 'root';
$pass = '';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "ALTER TABLE tblevents 
        ADD COLUMN IF NOT EXISTS venue VARCHAR(255) DEFAULT NULL,
        ADD COLUMN IF NOT EXISTS organizer VARCHAR(255) DEFAULT NULL,
        ADD COLUMN IF NOT EXISTS contact VARCHAR(255) DEFAULT NULL,
        ADD COLUMN IF NOT EXISTS time VARCHAR(100) DEFAULT NULL;";
    $dbh->exec($sql);
    echo "Table 'tblevents' updated with venue, organizer, contact, and time columns!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?> 