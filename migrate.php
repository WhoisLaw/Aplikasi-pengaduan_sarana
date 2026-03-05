<?php
require_once 'config/database.php';

try {
    $database = new Database();
    $db = $database->connect();

    echo "Running migrations...\n";

    // Add 'foto' to aspirasi
    $db->exec("ALTER TABLE aspirasi ADD COLUMN foto VARCHAR(255) NULL AFTER status");
    echo "Added 'foto' to aspirasi table.\n";

    // Add 'foto' to feedback
    $db->exec("ALTER TABLE feedback ADD COLUMN foto VARCHAR(255) NULL AFTER tanggal_feedback");
    echo "Added 'foto' to feedback table.\n";

    echo "Migration completed successfully!";
}
catch (PDOException $e) {
    if (strpos($e->getMessage(), "Duplicate column name") !== false) {
        echo "Columns already exist. Skipping.";
    }
    else {
        echo "Migration failed: " . $e->getMessage();
    }
}
?>
