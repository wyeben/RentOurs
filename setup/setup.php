<?php



try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}

try {
    $sql = file_get_contents('setup/schema.sql');
    $pdo->exec($sql);
    echo "Database schema created successfully!";
} catch (PDOException $e) {
    die("Error executing SQL script: " . $e->getMessage());
}

?>
