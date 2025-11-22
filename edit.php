<?php
$conn = new mysqli("localhost", "root", "", "expense_tracker");

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM expenses WHERE id=$id")->fetch_assoc();

if (isset($_POST['update'])) {

    $desc = $_POST['description'];
    $amt  = $_POST['amount'];
    $cat  = $_POST['category'];
    $date = $_POST['date'];

    $conn->query("UPDATE expenses
                  SET description='$desc', amount='$amt', category='$cat', date='$date'
                  WHERE id=$id");

    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Expense</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-box">
    <h2>Edit Expense</h2>

    <form method="POST">

        <input type="text" name="description" value="<?= $data['description'] ?>" required>

        <input type="number" step="0.01" name="amount" value="<?= $data['amount'] ?>" required>

        <select name="category" required>
            <option <?= $data['category']=="Food"?"selected":"" ?>>Food</option>
            <option <?= $data['category']=="Shopping"?"selected":"" ?>>Shopping</option>
            <option <?= $data['category']=="Travel"?"selected":"" ?>>Travel</option>
            <option <?= $data['category']=="Entertainment"?"selected":"" ?>>Entertainment</option>
            <option <?= $data['category']=="Other"?"selected":"" ?>>Other</option>
        </select>

        <input type="date" name="date" value="<?= $data['date'] ?>" required>

        <button name="update">Update Expense</button>
    </form>

    <br>
    <a class="back-btn" href="index.php">⬅ Back</a>
</div>

</body>
</html>
