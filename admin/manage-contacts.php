<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/../config/db.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
        submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        read_status TINYINT(1) DEFAULT 0
    )";
    
    if (!$conn->query($create_table)) {
        $error_message = 'Database error: Could not create contacts table - ' . $conn->error;
    } else {
        $success_message = 'Contacts table created successfully!';
    }
}

// Handle message deletion
if (isset($_POST['delete_message'])) {
    $messageId = intval($_POST['message_id']);
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->bind_param('i', $messageId);
    if ($stmt->execute()) {
        $success_message = "Message deleted successfully!";
    } else {
        $error_message = "Error deleting message.";
    }
    $stmt->close();
}

// Handle mark as read/unread
if (isset($_POST['toggle_read'])) {
    $messageId = intval($_POST['message_id']);
    $isRead = $_POST['is_read'] === '1' ? 0 : 1; // Toggle status
    
    // Check if read_status column exists, if not add it
    $column_check = $conn->query("SHOW COLUMNS FROM contacts LIKE 'read_status'");
    if ($column_check->num_rows == 0) {
        $conn->query("ALTER TABLE contacts ADD COLUMN read_status TINYINT(1) DEFAULT 0");
    }
    
    $stmt = $conn->prepare("UPDATE contacts SET read_status = ? WHERE id = ?");
    $stmt->bind_param('ii', $isRead, $messageId);
    $stmt->execute();
    $stmt->close();
}

// Pagination settings
$records_per_page = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $records_per_page;

// Ensure read_status column exists
$column_check = $conn->query("SHOW COLUMNS FROM contacts LIKE 'read_status'");
if ($column_check->num_rows == 0) {
    $conn->query("ALTER TABLE contacts ADD COLUMN read_status TINYINT(1) DEFAULT 0");
}

// Get total count for pagination
$total_result = $conn->query("SELECT COUNT(*) as total FROM contacts");
if (!$total_result) {
    $error_message = 'Database error: Could not count contacts - ' . $conn->error;
    $total_records = 0;
    $total_pages = 0;
} else {
    $total_records = $total_result->fetch_assoc()['total'];
    $total_pages = ceil($total_records / $records_per_page);
}

// Fetch contact messages with pagination
$query = "SELECT c.*, 
          COALESCE(c.read_status, 0) as read_status 
          FROM contacts c 
          ORDER BY c.submitted_at DESC 
          LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
if (!$stmt) {
    $error_message = 'Database error: Could not prepare query - ' . $conn->error;
    $contacts = [];
} else {
    $stmt->bind_param('ii', $records_per_page, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
    $contacts = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Contact Messages | NPS Education Admin</title>
    <!-- Tailwind CSS with Local Priority -->
    <link rel="stylesheet" href="../assets/css/tailwind.css" onerror="this.onerror=null; this.href='https://cdn.tailwindcss.com/';">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <nav class="bg-white p-4 shadow flex justify-between items-center">
        <div class="font-bold text-red-600">NPS Admin</div>
        <div class="flex items-center space-x-4">
            <a href="dashboard.php" class="text-blue-600 hover:underline">
                <i class="fas fa-arrow-left mr-1"></i>Back to Dashboard
            </a>
            <span>Welcome, <?= htmlspecialchars($_SESSION['admin_username']) ?></span>
            <a href="logout.php" class="text-blue-600 hover:underline">Logout</a>
        </div>
    </nav>

    <main class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">📧 Contact Messages</h1>
            <div class="text-sm text-gray-600">
                Total: <?= $total_records ?> messages
            </div>
        </div>

        <?php if (isset($success_message)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($success_message) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php endif; ?>

        <?php if (empty($contacts)): ?>
            <div class="bg-white p-8 rounded-lg shadow text-center">
                <i class="fas fa-inbox text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-600">No contact messages found.</p>
            </div>
        <?php else: ?>
            <div class="grid gap-4">
                <?php foreach ($contacts as $contact): ?>
                    <div class="bg-white rounded-lg shadow-sm border <?= $contact['read_status'] ? 'border-gray-200' : 'border-blue-200 bg-blue-50' ?> p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center space-x-3">
                                <?php if (!$contact['read_status']): ?>
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs">New</span>
                                <?php endif; ?>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    <?= htmlspecialchars($contact['name']) ?>
                                </h3>
                            </div>
                            <div class="flex items-center space-x-2">
                                <form method="POST" class="inline">
                                    <input type="hidden" name="message_id" value="<?= $contact['id'] ?>">
                                    <input type="hidden" name="is_read" value="<?= $contact['read_status'] ?>">
                                    <button type="submit" name="toggle_read" 
                                            class="text-sm px-3 py-1 rounded <?= $contact['read_status'] ? 'bg-gray-200 text-gray-700 hover:bg-gray-300' : 'bg-blue-500 text-white hover:bg-blue-600' ?>">
                                        <i class="fas <?= $contact['read_status'] ? 'fa-eye-slash' : 'fa-eye' ?> mr-1"></i>
                                        <?= $contact['read_status'] ? 'Mark Unread' : 'Mark Read' ?>
                                    </button>
                                </form>
                                <form method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                    <input type="hidden" name="message_id" value="<?= $contact['id'] ?>">
                                    <button type="submit" name="delete_message" class="text-sm px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                        <i class="fas fa-trash mr-1"></i>Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="grid md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <p class="text-sm text-gray-600">Email:</p>
                                <p class="font-medium">
                                    <a href="mailto:<?= htmlspecialchars($contact['email']) ?>" class="text-blue-600 hover:underline">
                                        <?= htmlspecialchars($contact['email']) ?>
                                    </a>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Phone:</p>
                                <p class="font-medium">
                                    <a href="tel:<?= htmlspecialchars($contact['phone']) ?>" class="text-blue-600 hover:underline">
                                        <?= htmlspecialchars($contact['phone']) ?>
                                    </a>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Submitted:</p>
                                <p class="font-medium"><?= date('M j, Y g:i A', strtotime($contact['submitted_at'])) ?></p>
                            </div>
                        </div>

                        <?php if (!empty($contact['address'])): ?>
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-1">Address:</p>
                                <p class="text-gray-800"><?= htmlspecialchars($contact['address']) ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($contact['message'])): ?>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Message:</p>
                                <div class="bg-gray-50 p-3 rounded border">
                                    <p class="text-gray-800 whitespace-pre-wrap"><?= htmlspecialchars($contact['message']) ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
                <div class="mt-8 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?= $page - 1 ?>" class="px-3 py-2 bg-white border rounded hover:bg-gray-50">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        <?php endif; ?>

                        <?php for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++): ?>
                            <a href="?page=<?= $i ?>" 
                               class="px-3 py-2 border rounded <?= $i === $page ? 'bg-blue-500 text-white' : 'bg-white hover:bg-gray-50' ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="?page=<?= $page + 1 ?>" class="px-3 py-2 bg-white border rounded hover:bg-gray-50">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        <?php endif; ?>
                    </nav>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </main>

    <script>
        // Auto-hide success/error messages after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>
