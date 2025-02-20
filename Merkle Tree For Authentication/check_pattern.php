<?php
require_once 'config/database.php';

echo "<h2>Stored Patterns:</h2>";
echo "<p>This tool shows you the stored patterns in the database.</p>";

$sql = "SELECT email, pattern FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Email</th><th>Pattern (Image IDs)</th><th>Images Selected</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        $pattern = json_decode($row['pattern']);
        $images = array_map(function($id) {
            return substr($id, 1) . '.png'; // Convert s01 to 01.png
        }, $pattern);
        
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['pattern']) . "</td>";
        echo "<td>" . implode(", ", $images) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No patterns stored yet";
}

$conn->close();
?>
