<?php
require_once 'config/database.php';

try {
    $database = new Database();
    $db = $database->connect();

    echo "Running migrations...\n";

    // Add or modify 'foto' in aspirasi
    try {
        $db->exec("ALTER TABLE aspirasi ADD COLUMN foto LONGTEXT NULL AFTER status");
        echo "Added 'foto' to aspirasi table.\n";
    } catch (PDOException $e) {
        $db->exec("ALTER TABLE aspirasi MODIFY COLUMN foto LONGTEXT NULL");
        echo "Modified 'foto' to LONGTEXT in aspirasi table.\n";
    }

    // Add or modify 'foto' in feedback
    try {
        $db->exec("ALTER TABLE feedback ADD COLUMN foto LONGTEXT NULL AFTER tanggal_feedback");
        echo "Added 'foto' to feedback table.\n";
    } catch (PDOException $e) {
        $db->exec("ALTER TABLE feedback MODIFY COLUMN foto LONGTEXT NULL");
        echo "Modified 'foto' to LONGTEXT in feedback table.\n";
    }

    echo "Migration completed successfully!";
}
catch (PDOException $e) {
    echo "Migration error: " . $e->getMessage();
}
?>
