<?php
$conn = new mysqli("localhost", "root", "", "expense_tracker");

if (isset($_POST['save'])) {
    $desc = $_POST['description'];
    $amt  = $_POST['amount'];
    $cat  = $_POST['category'];
    $date = $_POST['date'];

    session_start();
$user_id = $_SESSION['user_id'];

$conn->query("INSERT INTO expenses(description, amount, category, date, user_id)
              VALUES('$desc','$amt','$cat','$date', '$user_id')");


    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Expense</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="add-container">

    <div class="glass-card">
        <h2 class="form-title">➕ Add New Expense</h2>

        <form method="POST" class="fancy-form">
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" required>
            </div>

            <div class="form-group">
                <label>Amount (₹)</label>
                <input type="number" step="0.01" name="amount" required>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category" required>
                    <option value="">Select Category</option>
                    <option>Food</option>
                    <option>Shopping</option>
                    <option>Travel</option>
                    <option>Entertainment</option>
                    <option>Other</option>
                </select>
            </div>

            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" required>
            </div>

            <button class="save-btn" name="save">💾 Save Expense</button>
        </form>

        <a class="back-btn" href="index.php">⬅ Back to Dashboard</a>
    </div>

</div>

</body>
</html>
