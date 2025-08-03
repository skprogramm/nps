<?php
session_start();
require_once __DIR__ . '/../config/db.php';

if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM admins WHERE username = ? LIMIT 1");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashedPassword);
        $stmt->fetch();
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_username'] = $username;
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Incorrect password';
        }
    } else {
        $error = 'Admin user not found';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | NPS Education</title>
    <!-- Tailwind CSS with Local Priority -->
    <link rel="stylesheet" href="../assets/css/tailwind.css" onerror="this.onerror=null; this.href='https://cdn.tailwindcss.com/';">
    <style>body{font-family:sans-serif}</style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-xl p-8 w-full max-w-sm">
        <h2 class="text-xl font-bold text-center text-red-600 mb-6">Admin Login</h2>
        <?php if ($error): ?>
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4 text-sm text-center"> <?= htmlspecialchars($error) ?> </div>
        <?php endif; ?>
        <form method="POST" class="space-y-4">
            <input type="text" name="username" placeholder="Username" required class="w-full border p-3 rounded">
            <input type="password" name="password" placeholder="Password" required class="w-full border p-3 rounded">
            <button type="submit" class="w-full bg-green-600 hover:bg-red-600 text-white font-semibold p-3 rounded">Login</button>
        </form>
    </div>
</body>
</html>
