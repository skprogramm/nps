<?php
// Database Setup Script for NPS Education
require_once __DIR__ . '/config/db.php';

echo "<h1>NPS Education Database Setup</h1>";

// Read SQL file
$sql = file_get_contents(__DIR__ . '/database/schema.sql');
if ($sql === false) {
    die("Error reading schema.sql file");
}

// Split SQL into individual statements
$statements = array_filter(array_map('trim', explode(';', $sql)));

echo "<h2>Executing Database Setup...</h2>";
echo "<pre>";

$success = true;
foreach ($statements as $statement) {
    if (empty($statement)) continue;
    
    echo "Executing: " . substr($statement, 0, 100) . "...\n";
    
    if ($conn->query($statement) === TRUE) {
        echo "✓ Success\n\n";
    } else {
        echo "✗ Error: " . $conn->error . "\n\n";
        $success = false;
    }
}

if ($success) {
    echo "</pre>";
    echo "<h2 style='color: green;'>✓ Database setup completed successfully!</h2>";
    echo "<p>Default admin credentials:</p>";
    echo "<ul>";
    echo "<li><strong>Username:</strong> admin</li>";
    echo "<li><strong>Password:</strong> admin123</li>";
    echo "</ul>";
    echo "<p><a href='admin/login.php'>Login to Admin Panel</a></p>";
    echo "<p><a href='pages/index.php'>Visit Website</a></p>";
} else {
    echo "</pre>";
    echo "<h2 style='color: red;'>✗ Database setup failed!</h2>";
    echo "<p>Please check the errors above and try again.</p>";
}

$conn->close();
?>
