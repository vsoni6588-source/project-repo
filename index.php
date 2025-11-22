<?php
$conn = new mysqli("localhost", "root", "", "expense_tracker");
session_start();
$user_id = $_SESSION['user_id'];

// READ ALL EXPENSES
$result = $conn->query("SELECT * FROM expenses WHERE user_id = '$user_id' ORDER BY id DESC");

// DELETE EXPENSE
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM expenses WHERE id=$id");
    header("Location: index.php");
    exit();
}

// SUMMARY CALCULATIONS
$totalRow = $conn->query("SELECT SUM(amount) AS total FROM expenses WHERE user_id = '$user_id'")->fetch_assoc();
$total = $totalRow['total'] ?? 0;

$countRow = $conn->query("SELECT COUNT(*) AS cnt FROM expenses WHERE user_id = '$user_id'")->fetch_assoc();
$count = $countRow['cnt'] ?? 0;

// NEW: Recent Expense Amount
$recentRow = $conn->query("SELECT amount FROM expenses WHERE user_id='$user_id' ORDER BY id DESC LIMIT 1")->fetch_assoc();
$recent_amount = $recentRow['amount'] ?? 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker - CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- HEADER -->
<div class="header-card" >
    <div class="admin-box">
        <img src="admin.png" class="admin-logo">
        <span class="admin-name">
            <?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'ADMIN' ?>
        </span>
    </div>
    <a href="logout.php" class="logout-btn">Logout</a>

    <h1>💳 Expense Tracker System</h1>
    <p>Track your spending with style</p>
</div>

<!-- SUMMARY -->
<div class="summary-row">
    <div class="summary-card">
        <h3>Total Expenses</h3>
        <div class="summary-value">₹<?= number_format($total, 2) ?></div>
    </div>

    <div class="summary-card">
        <h3>Transactions</h3>
        <div class="summary-value"><?= $count ?></div>
    </div>

    <!-- REPLACED AVERAGE WITH RECENT AMOUNT -->
    <div class="summary-card">
        <h3>Recent Expense</h3>
        <div class="summary-value">₹<?= number_format($recent_amount, 2) ?></div>
    </div>
</div>

<!-- ADD BUTTON -->
<div style="text-align:center; margin-bottom:20px;">
    <a class="add-btn" href="add.php">➕ Add New Expense</a>
</div>

<!-- EXPENSE LIST -->
<h2 style="margin-left: 5%;">Your Expenses</h2>

<div class="expense-list">
<?php while ($row = $result->fetch_assoc()) { ?>
    <div class="expense-item">
        <div class="expense-left">
            <h3><?= $row['description'] ?></h3>
            <small><?= date("M d, Y", strtotime($row['date'])) ?></small><br>
            <span class="tag"><?= $row['category'] ?></span>
        </div>

        <strong class="amount">-₹<?= number_format($row['amount'], 2) ?></strong>

        <div class="action-btns">
            <a class="edit-btn" href="edit.php?id=<?= $row['id'] ?>">✏</a>
            <a class="delete-btn" href="?delete=<?= $row['id'] ?>">🗑</a>
        </div>
    </div>
<?php } ?>
</div>

</body>
</html>
