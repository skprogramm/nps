<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/config/db.php';

// Set response headers for JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get JSON input
$raw_input = file_get_contents('php://input');
$input = json_decode($raw_input, true);

// If no JSON input, try regular POST
if (!$input) {
    $input = $_POST;
}

// Validate required fields
$required_fields = ['name', 'email', 'phone'];
$errors = [];

foreach ($required_fields as $field) {
    if (empty($input[$field])) {
        $errors[] = ucfirst($field) . ' is required';
    }
}

// Validate email format
if (!empty($input['email']) && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Valid email is required';
}

// Validate phone format (10 digits)
if (!empty($input['phone']) && !preg_match('/^[0-9]{10}$/', $input['phone'])) {
    $errors[] = 'Valid 10-digit phone number is required';
}

// If there are validation errors, return them
if (!empty($errors)) {
    echo json_encode(['success' => false, 'errors' => $errors]);
    exit;
}

// Sanitize input data
$name = trim(htmlspecialchars($input['name']));
$email = trim(htmlspecialchars($input['email']));
$phone = trim(htmlspecialchars($input['phone']));
$address = trim(htmlspecialchars($input['address'] ?? ''));
$message = trim(htmlspecialchars($input['message'] ?? ''));

// Check if contacts table exists, if not create it
$table_check = $conn->query("SHOW TABLES LIKE 'contacts'");
if ($table_check->num_rows == 0) {
    $create_table = "CREATE TABLE contacts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        address TEXT,
        message TEXT,
        submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($create_table)) {
        echo json_encode(['success' => false, 'message' => 'Database error: Could not create contacts table']);
        exit;
    }
}

// Insert contact data into database
$stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, address, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param('sssss', $name, $email, $phone, $address, $message);

if ($stmt->execute()) {
    // Optional: Send notification email to admin
    $adminEmail = 'npseducation45@gmail.com';
    $subject = "New Contact Form Submission - $name";
    $emailMessage = "A new contact form has been submitted:\n\n";
    $emailMessage .= "Name: $name\n";
    $emailMessage .= "Email: $email\n";
    $emailMessage .= "Phone: $phone\n";
    $emailMessage .= "Address: $address\n";
    $emailMessage .= "Message: $message\n";
    $emailMessage .= "\nSubmitted at: " . date('Y-m-d H:i:s');
    
    $headers = "From: info@education.npsvission.in\r\n";
    $headers .= "Reply-To: $email\r\n";
    
    @mail($adminEmail, $subject, $emailMessage, $headers);
    
    echo json_encode([
        'success' => true, 
        'message' => 'Thank you for your message! We will contact you within 24 hours.'
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Database error. Please try again later.'
    ]);
}

$stmt->close();
$conn->close();
?>
