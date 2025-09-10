<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/../config/db.php';

// Handle search functionality
$search_query = '';
$search_field = 'all';
$where_clause = '';
$params = [];
$param_types = '';

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search_query = trim($_GET['search']);
    $search_field = isset($_GET['search_field']) ? $_GET['search_field'] : 'all';
    
    if ($search_field === 'all') {
        $where_clause = "WHERE (name LIKE ? OR email LIKE ? OR phone LIKE ? OR guirdian_name LIKE ? OR qualification LIKE ? OR district LIKE ? OR state LIKE ?)";
        $search_term = '%' . $search_query . '%';
        $params = array_fill(0, 7, $search_term);
        $param_types = str_repeat('s', 7);
    } else {
        $where_clause = "WHERE $search_field LIKE ?";
        $params = ['%' . $search_query . '%'];
        $param_types = 's';
    }
}

// Export to CSV if requested
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="admissions.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Name', 'Email', 'Phone', 'Guardian', 'Qualification', 'District', 'State', 'Address', 'Submitted At']);

    // Build the export query with search filters
    $export_query = "SELECT * FROM admissions $where_clause ORDER BY submitted_at DESC";
    if (!empty($params)) {
        $stmt = $conn->prepare($export_query);
        $stmt->bind_param($param_types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $conn->query($export_query);
    }
    
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, [$row['name'], $row['email'], $row['phone'], $row['guirdian_name'], $row['qualification'], $row['district'], $row['state'], $row['address'], $row['submitted_at']]);
    }
    fclose($output);
    exit;
}

// Pagination settings
$records_per_page = 20;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $records_per_page;

// Get total count for pagination
$count_query = "SELECT COUNT(*) as total FROM admissions $where_clause";
if (!empty($params)) {
    $count_stmt = $conn->prepare($count_query);
    $count_stmt->bind_param($param_types, ...$params);
    $count_stmt->execute();
    $total_records = $count_stmt->get_result()->fetch_assoc()['total'];
} else {
    $total_records = $conn->query($count_query)->fetch_assoc()['total'];
}
$total_pages = ceil($total_records / $records_per_page);

// Fetch admission records with search and pagination
$main_query = "SELECT * FROM admissions $where_clause ORDER BY submitted_at DESC LIMIT ? OFFSET ?";
if (!empty($params)) {
    $stmt = $conn->prepare($main_query);
    $all_params = array_merge($params, [$records_per_page, $offset]);
    $all_param_types = $param_types . 'ii';
    $stmt->bind_param($all_param_types, ...$all_params);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $stmt = $conn->prepare("SELECT * FROM admissions ORDER BY submitted_at DESC LIMIT ? OFFSET ?");
    $stmt->bind_param('ii', $records_per_page, $offset);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Admissions | NPS Admin</title>
    <!-- Tailwind CSS with Local Priority -->
    <link rel="stylesheet" href="/assets/css/tailwind.css" onerror="this.onerror=null; this.href='https://cdn.tailwindcss.com/';">
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
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">📋 Manage Admissions</h1>
            <div class="flex items-center space-x-3">
                <a href="dashboard.php" class="text-blue-600 hover:underline">
                    ← Back to Dashboard
                </a>
                <a href="?export=csv<?= !empty($search_query) ? '&search=' . urlencode($search_query) . '&search_field=' . urlencode($search_field) : '' ?>" 
                   class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    Export CSV
                </a>
            </div>
        </div>

        <!-- Search Form -->
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <form method="GET" class="flex flex-wrap items-center gap-4">
                <div class="flex-1 min-w-64">
                    <input type="text" 
                           name="search" 
                           value="<?= htmlspecialchars($search_query) ?>" 
                           placeholder="Search admissions..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <select name="search_field" 
                            class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" <?= $search_field === 'all' ? 'selected' : '' ?>>All Fields</option>
                        <option value="name" <?= $search_field === 'name' ? 'selected' : '' ?>>Name</option>
                        <option value="email" <?= $search_field === 'email' ? 'selected' : '' ?>>Email</option>
                        <option value="phone" <?= $search_field === 'phone' ? 'selected' : '' ?>>Phone</option>
                        <option value="guirdian_name" <?= $search_field === 'guirdian_name' ? 'selected' : '' ?>>Guardian</option>
                        <option value="qualification" <?= $search_field === 'qualification' ? 'selected' : '' ?>>Qualification</option>
                        <option value="district" <?= $search_field === 'district' ? 'selected' : '' ?>>District</option>
                        <option value="state" <?= $search_field === 'state' ? 'selected' : '' ?>>State</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        🔍 Search
                    </button>
                    <?php if (!empty($search_query)): ?>
                        <a href="manage-admissions.php" 
                           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            Clear
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Results Summary -->
        <div class="mb-4">
            <p class="text-gray-600">
                <?php if (!empty($search_query)): ?>
                    Showing <?= $total_records ?> result(s) for "<?= htmlspecialchars($search_query) ?>" 
                    <?php if ($search_field !== 'all'): ?>
                        in <?= ucfirst(str_replace('_', ' ', $search_field)) ?>
                    <?php endif; ?>
                <?php else: ?>
                    Showing all <?= $total_records ?> admission(s)
                <?php endif; ?>
                <?php if ($total_pages > 1): ?>
                    (Page <?= $page ?> of <?= $total_pages ?>)
                <?php endif; ?>
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto bg-white shadow rounded-lg">
                <thead class="bg-gray-200">
                    <tr class="text-left text-sm text-gray-600">
                        <th class="p-3">Name</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">Guardian</th>
                        <th class="p-3">Qualification</th>
                        <th class="p-3">District</th>
                        <th class="p-3">State</th>
                        <th class="p-3">Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="border-b text-sm hover:bg-gray-50">
                            <td class="p-3"><?= htmlspecialchars($row['name']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($row['email']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($row['phone']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($row['guirdian_name']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($row['qualification']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($row['district']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($row['state']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($row['submitted_at']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Controls -->
        <?php if ($total_pages > 1): ?>
            <div class="mt-6 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <!-- Previous Page -->
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?><?= !empty($search_query) ? '&search=' . urlencode($search_query) . '&search_field=' . urlencode($search_field) : '' ?>" 
                           class="px-3 py-2 bg-white border rounded hover:bg-gray-50">
                            ← Previous
                        </a>
                    <?php endif; ?>

                    <!-- Page Numbers -->
                    <?php 
                    $start_page = max(1, $page - 2);
                    $end_page = min($total_pages, $page + 2);
                    
                    // Show first page if we're not starting from it
                    if ($start_page > 1): ?>
                        <a href="?page=1<?= !empty($search_query) ? '&search=' . urlencode($search_query) . '&search_field=' . urlencode($search_field) : '' ?>" 
                           class="px-3 py-2 bg-white border rounded hover:bg-gray-50">1</a>
                        <?php if ($start_page > 2): ?>
                            <span class="px-3 py-2 text-gray-500">...</span>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Current range of pages -->
                    <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                        <a href="?page=<?= $i ?><?= !empty($search_query) ? '&search=' . urlencode($search_query) . '&search_field=' . urlencode($search_field) : '' ?>" 
                           class="px-3 py-2 border rounded <?= $i === $page ? 'bg-blue-500 text-white' : 'bg-white hover:bg-gray-50' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <!-- Show last page if we're not ending with it -->
                    <?php if ($end_page < $total_pages): ?>
                        <?php if ($end_page < $total_pages - 1): ?>
                            <span class="px-3 py-2 text-gray-500">...</span>
                        <?php endif; ?>
                        <a href="?page=<?= $total_pages ?><?= !empty($search_query) ? '&search=' . urlencode($search_query) . '&search_field=' . urlencode($search_field) : '' ?>" 
                           class="px-3 py-2 bg-white border rounded hover:bg-gray-50"><?= $total_pages ?></a>
                    <?php endif; ?>

                    <!-- Next Page -->
                    <?php if ($page < $total_pages): ?>
                        <a href="?page=<?= $page + 1 ?><?= !empty($search_query) ? '&search=' . urlencode($search_query) . '&search_field=' . urlencode($search_field) : '' ?>" 
                           class="px-3 py-2 bg-white border rounded hover:bg-gray-50">
                            Next →
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
