<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/../config/db.php';

// Handle password change
$passwordChangeMessage = '';
$passwordChangeError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    // Validate inputs
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        $passwordChangeError = 'All fields are required.';
    } elseif ($newPassword !== $confirmPassword) {
        $passwordChangeError = 'New passwords do not match.';
    } elseif (strlen($newPassword) < 6) {
        $passwordChangeError = 'Password must be at least 6 characters long.';
    } else {
        // Verify current password
        $stmt = $conn->prepare("SELECT password FROM admins WHERE id = ?");
        $stmt->bind_param('i', $_SESSION['admin_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();
        
        if ($admin && password_verify($currentPassword, $admin['password'])) {
            // Update password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateStmt = $conn->prepare("UPDATE admins SET password = ? WHERE id = ?");
            $updateStmt->bind_param('si', $hashedNewPassword, $_SESSION['admin_id']);
            
            if ($updateStmt->execute()) {
                $passwordChangeMessage = 'Password changed successfully!';
            } else {
                $passwordChangeError = 'Failed to update password. Please try again.';
            }
        } else {
            $passwordChangeError = 'Current password is incorrect.';
        }
    }
}

// Fetch counts
$result = $conn->query("SELECT COUNT(*) AS total FROM admissions");
$data = $result->fetch_assoc();
$totalAdmissions = $data['total'];

// Fetch contact messages count
$contactResult = $conn->query("SELECT COUNT(*) AS total FROM contacts");
if ($contactResult) {
    $contactData = $contactResult->fetch_assoc();
    $totalContacts = $contactData['total'];
} else {
    $totalContacts = 0;
}

// Fetch franchise applications count
$franchiseResult = $conn->query("SELECT COUNT(*) AS total FROM franchises");
if ($franchiseResult) {
    $franchiseData = $franchiseResult->fetch_assoc();
    $totalFranchises = $franchiseData['total'];
} else {
    $totalFranchises = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | NPS Education</title>
    
    <!-- Tailwind CSS with Local Priority -->
    <link rel="stylesheet" href="../assets/css/tailwind.css" onerror="this.onerror=null; this.href='https://cdn.tailwindcss.com/';">
    <style>
        .toggle-btn {
          display: flex;
          align-items: center;
          gap: 6px;
          padding: 6px 12px;
          background-color: #fff;
          border: 1px solid #ccc;
          border-radius: 6px;
          cursor: pointer;
          font-family: Arial, sans-serif;
          color: #333;
          transition: background-color 0.2s, border-color 0.2s;
        }
        .toggle-btn:hover {
          background-color: #f0f0f0;
          border-color: #999;
        }
        .toggle-btn svg {
          width: 20px;
          height: 20px;
          fill: currentColor;
        }
    </style>
</head>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Toggle Button</title>

</head>
<body>



</body>
</html>

<body class="bg-gray-100">
<nav class="bg-white p-4 shadow flex justify-between items-center">
    <div class="font-bold text-red-600">NPS Admin</div>
    <div class="relative">
        <div class="flex items-center">
            <span class="mr-2">Welcome, <?= htmlspecialchars($_SESSION['admin_username']) ?></span>
            <div class="relative">
            <button id="user-menu-button" type="button" class="toggle-btn">
                <!-- User Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                </svg>

                <!-- Down Arrow -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 
                           0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 
                           0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
                
                <div id="user-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 z-50 hidden">
                    <div class="py-1">
                        <button onclick="togglePasswordForm(); closeUserMenu();" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m0 0a2 2 0 012 2 12 12 0 01-12 12A12 12 0 017 9a2 2 0 012-2m0 0V7a2 2 0 012-2 12 12 0 0112 12 2 2 0 01-2 2M9 7a2 2 0 00-2 2v10a2 2 0 002 2 10 10 0 0010-10V9a2 2 0 00-2-2M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2M9 7a2 2 0 012 2h2a2 2 0 012-2" />
                            </svg>
                            Change Password
                        </button>
                        <hr class="border-gray-200">
                        <a href="logout.php" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

    <main class="p-6">
        <h1 class="text-2xl font-bold mb-6">📊 Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="text-4xl font-bold text-green-600"><?= $totalAdmissions ?></div>
                <p class="mt-2 text-gray-700">Total Applications</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="text-4xl font-bold text-blue-600"><?= $totalContacts ?></div>
                <p class="mt-2 text-gray-700">Contact Messages</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <div class="text-4xl font-bold text-orange-600"><?= $totalFranchises ?></div>
                <p class="mt-2 text-gray-700">Franchise Applications</p>
            </div>
            <a href="manage-admissions.php" class="bg-white p-6 rounded-lg shadow hover:bg-blue-50 text-center">
                <div class="text-xl font-semibold text-blue-600">Manage Admissions</div>
                <p class="text-gray-600 text-sm">View submitted student forms</p>
            </a>
            <a href="manage-contacts.php" class="bg-white p-6 rounded-lg shadow hover:bg-blue-50 text-center">
                <div class="text-xl font-semibold text-purple-600">Manage Contacts</div>
                <p class="text-gray-600 text-sm">View contact form messages</p>
            </a>
            <a href="manage-courses.php" class="bg-white p-6 rounded-lg shadow hover:bg-blue-50 text-center">
                <div class="text-xl font-semibold text-blue-600">Manage Courses</div>
                <p class="text-gray-600 text-sm">Add, edit or remove offered courses</p>
            </a>
            <a href="manage-franchises.php" class="bg-white p-6 rounded-lg shadow hover:bg-orange-50 text-center">
                <div class="text-xl font-semibold text-orange-600">Manage Franchises</div>
                <p class="text-gray-600 text-sm">View franchise applications</p>
            </a>
        </div>
        
        <!-- Change Password Form (initially hidden) -->
        <div id="password-form" class="mt-8 bg-white p-6 rounded-lg shadow" style="display: none;">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Change Password</h2>
            
            <?php if ($passwordChangeMessage): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <?= htmlspecialchars($passwordChangeMessage) ?>
                </div>
            <?php endif; ?>
            
            <?php if ($passwordChangeError): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <?= htmlspecialchars($passwordChangeError) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="" class="space-y-4">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                    <input type="password" id="current_password" name="current_password" required 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" id="new_password" name="new_password" required minlength="6"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-sm text-gray-500 mt-1">Password must be at least 6 characters long</p>
                </div>
                
                <div>
                    <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required minlength="6"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                
                <div class="flex gap-4">
                    <button type="submit" name="change_password" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Change Password
                    </button>
                    <button type="button" onclick="togglePasswordForm()" 
                            class="bg-gray-600 text-white px-6 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </main>
    
<script>
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');

    userMenuButton.addEventListener('click', function(e) {
        e.stopPropagation();
        userMenu.classList.toggle('hidden');
    });
    
    function closeUserMenu() {
        userMenu.classList.add('hidden');
    }

    // Close the dropdown if clicked outside
    document.addEventListener('click', function(e) {
        if (!userMenu.contains(e.target) && !userMenuButton.contains(e.target)) {
            closeUserMenu();
        }
    });

    function togglePasswordForm() {
        const form = document.getElementById('password-form');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
            form.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } else {
            form.style.display = 'none';
            document.getElementById('current_password').value = '';
            document.getElementById('new_password').value = '';
            document.getElementById('confirm_password').value = '';
        }
    }

    // Auto-show password form if there was a form submission
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])): ?>
    document.addEventListener('DOMContentLoaded', function() {
        togglePasswordForm();
    });
    <?php endif; ?>

    // Password confirmation validation
    document.getElementById('confirm_password').addEventListener('input', function() {
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = this.value;
        if (newPassword !== confirmPassword) {
            this.setCustomValidity('Passwords do not match');
        } else {
            this.setCustomValidity('');
        }
    });
</script>
</body>
</html>
