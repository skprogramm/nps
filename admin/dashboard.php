<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/../config/db.php';

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

</head>
<body class="bg-gray-100">
    <nav class="bg-white p-4 shadow flex justify-between items-center">
        <div class="font-bold text-red-600">NPS Admin</div>
        <div>
            Welcome, <?= htmlspecialchars($_SESSION['admin_username']) ?> |
            <a href="logout.php" class="text-blue-600 hover:underline">Logout</a>
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
    </main>
</body>
</html>
