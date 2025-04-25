<?php
session_start();
include("DB.php");
$schoolId = $_SESSION['schoolId'];
$filter_class = $_GET['class'] ?? '';
$filter_section = $_GET['section'] ?? '';
$filter_name = $_GET['name'] ?? '';

$filter_sql = "SELECT * FROM students WHERE school_id='$schoolId'";
if ($filter_class) $filter_sql .= " AND class='$filter_class'";
if ($filter_section) $filter_sql .= " AND section='$filter_section'";
if ($filter_name) $filter_sql .= " AND name LIKE '%$filter_name%'";
$students = mysqli_query($conn, $filter_sql);
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 900px;
        margin: 30px auto;
        padding: 0 15px;
    }

    h2 {
        padding-bottom: 10px;
        text-align: center;
    }

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
        align-items: center;
    }

    .filter-form input,
    .filter-form button {
        padding: 6px;
        border-radius: 4px;
        border: 1px solid #ccc;
        flex: 1;
        min-width: 100px;
    }

    .filter-form button {
        background: #2E8B57;
        color: white;
        border: none;
        cursor: pointer;
        flex: 0 0 auto;
    }

    .attendance-form {
        max-width: 100%;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    .form-group input[type="date"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        cursor: pointer;
    }

    .student-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background: #f1f1f1;
        margin-bottom: 8px;
        border-radius: 6px;
        flex-wrap: wrap;
    }

    .student-info {
        flex: 1;
    }

    .attendance-select {
        flex: 0 0 40%;
        min-width: 150px;
    }

    .attendance-select select {
        width: 100%;
        padding: 6px;
        border-radius: 4px;
        border: 1px solid #ccc;
        cursor: pointer;
    }

    .submit-btn {
        text-align: center;
        margin-top: 20px;
    }

    .submit-btn button {
        padding: 10px 30px;
        background: #007bff;
        border: none;
        color: white;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .filter-form {
            flex-direction: column;
        }

        .student-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .attendance-select {
            width: 100%;
            margin-top: 8px;
        }
    }
</style>

<div class="container">
    <h2>Attendance Management</h2>
    <div style="margin-bottom: 20px;">
        <button onclick="window.location.href='Attendance-management.php'"
            style="padding: 6px 15px; background: #6c757d; color: white; border: none; border-radius: 4px; cursor: pointer;">
            ← Back
        </button>
    </div>
    <!-- Filter Section -->
    <form method="GET" class="filter-form">
        <input type="text" name="name" placeholder="Search Name" value="<?= $filter_name ?>" />
        <input type="text" name="class" placeholder="Class" value="<?= $filter_class ?>" />
        <input type="text" name="section" placeholder="Section" value="<?= $filter_section ?>" />
        <button type="submit">Filter</button>
    </form>

    <!-- Attendance Form -->
    <form action="mark_attendance.php" method="POST" class="attendance-form">
        <?php $today = date('Y-m-d'); ?>
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" required
                value="<?= $today ?>" min="<?= $today ?>" max="<?= $today ?>" />
        </div>

        <?php while ($row = mysqli_fetch_assoc($students)) { ?>
            <div class="student-row">
                <div class="student-info">
                    <?= htmlspecialchars($row['name']) ?><br />
                    <small>Class: <?= $row['class'] ?> | Section: <?= $row['section'] ?></small>
                </div>
                <div class="attendance-select">
                    <select name="attendance[<?= $row['id'] ?>]">
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>
                        <option value="Leave">Leave</option>
                    </select>
                </div>
            </div>
        <?php } ?>

        <div class="submit-btn">
            <button type="submit">Submit Attendance</button>
        </div>
    </form>
</div>