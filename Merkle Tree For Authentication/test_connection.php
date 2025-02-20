<?php
require_once 'config/database.php';

if ($conn) {
    echo "Database connection successful!\n";
    
    $result = mysqli_query($conn, "SHOW DATABASES LIKE 'graphical_auth'");
    if (mysqli_num_rows($result) > 0) {
        echo "Graphical auth database exists!\n";
    } else {
        echo "Database 'graphical_auth' not found.\n";
    }
} else {
    echo "Database connection failed: " . mysqli_connect_error();
}
?>
