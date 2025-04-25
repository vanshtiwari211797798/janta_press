<?php
session_start();
include("DB.php");
$schoolId = $_SESSION['schoolId'];

$filter_name = $_GET['name'] ?? '';
$filter_class = $_GET['class'] ?? '';
$filter_section = $_GET['section'] ?? '';

$year = $_GET['year'] ?? date('Y');
$month = $_GET['month'] ?? date('m');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Navigation
if (isset($_GET['prev_month'])) {
    $month = $month == 1 ? 12 : $month - 1;
    $year = $month == 12 ? $year - 1 : $year;
} elseif (isset($_GET['next_month'])) {
    $month = $month == 12 ? 1 : $month + 1;
    $year = $month == 1 ? $year + 1 : $year;
}

$students_sql = "SELECT * FROM students WHERE school_id='$schoolId'";
if ($filter_name) $students_sql .= " AND name LIKE '%$filter_name%'";
if ($filter_class) $students_sql .= " AND class='$filter_class'";
if ($filter_section) $students_sql .= " AND section='$filter_section'";
$students = mysqli_query($conn, $students_sql);
?>

<style>
    .calendar-wrapper {
        overflow-x: auto;
        margin-bottom: 40px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        background: #fff;
    }

    .calendar {
        border-collapse: collapse;
        width: 100%;
        min-width: 800px;
    }

    .calendar th,
    .calendar td {
        padding: 10px;
        text-align: center;
        border: 1px solid #e0e0e0;
        font-size: 14px;
        min-width: 35px;
        height: 60px;
        /* Set fixed height for each cell */
    }

    .calendar th {
        position: sticky;
        top: 0;
        background-color: #f4f4f4;
        z-index: 1;
    }

    .present {
        background-color: #90ee90;
    }

    .absent {
        background-color: #f08080;
    }

    .leave {
        background-color: #f9f871;
    }

    .no-data {
        background-color: #f0f0f0;
    }

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 20px;
        align-items: center;
    }

    .filter-form input,
    .filter-form select {
        padding: 8px;
        border-radius: 6px;
        border: 1px solid #ccc;
        min-width: 120px;
        font-size: 14px;
    }

    .filter-form button {
        padding: 8px 18px;
        background: #2E8B57;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
    }

    .legend {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        align-items: center;
        flex-wrap: wrap;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .legend-box {
        width: 20px;
        height: 20px;
        border-radius: 3px;
        border: 1px solid #ccc;
    }

    .present-box {
        background-color: #90ee90;
    }

    .absent-box {
        background-color: #f08080;
    }

    .leave-box {
        background-color: #f9f871;
    }

    .no-data-box {
        background-color: #f0f0f0;
    }

    .navigation-buttons {
        margin: 20px 0;
        display: flex;
        justify-content: space-between;
    }

    .navigation-buttons button {
        padding: 8px 15px;
        background: #2E8B57;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .filter-form {
            flex-direction: column;
        }

        .filter-form input,
        .filter-form select {
            width: 100%;
        }

        .calendar th,
        .calendar td {
            font-size: 12px;
            padding: 6px;
        }

        h3 {
            font-size: 16px;
        }
    }
</style>
<div style="margin: 30px;">
    <!-- Back Button -->
    <div style="margin-bottom: 20px;">
        <a href="Attendance-management.php">
            <button type="button" style="padding: 8px 18px; background: #2E8B57; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 14px;">Back</button>
        </a>
    </div>

    <h2>View Attendance</h2>

    <!-- Filters -->
    <form method="GET" class="filter-form">
        <input type="text" name="name" placeholder="Search Name" value="<?= $filter_name ?>" />
        <input type="text" name="class" placeholder="Class" value="<?= $filter_class ?>" />
        <input type="text" name="section" placeholder="Section" value="<?= $filter_section ?>" />
        <select name="month">
            <?php for ($m = 1; $m <= 12; $m++): ?>
                <option value="<?= $m ?>" <?= $m == $month ? 'selected' : '' ?>>
                    <?= date('F', mktime(0, 0, 0, $m, 10)) ?>
                </option>
            <?php endfor; ?>
        </select>
        <select name="year">
            <?php for ($y = date('Y') - 5; $y <= date('Y'); $y++): ?>
                <option value="<?= $y ?>" <?= $y == $year ? 'selected' : '' ?>><?= $y ?></option>
            <?php endfor; ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <!-- Color Legend -->
    <div class="legend">
        <div class="legend-item">
            <div class="legend-box present-box"></div> Present
        </div>
        <div class="legend-item">
            <div class="legend-box absent-box"></div> Absent
        </div>
        <div class="legend-item">
            <div class="legend-box leave-box"></div> Leave
        </div>
        <div class="legend-item">
            <div class="legend-box no-data-box"></div> No Data
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="navigation-buttons">
        <a href="?month=<?= $month ?>&year=<?= $year ?>&prev_month=true">
            <button type="button">Previous Month</button>
        </a>
        <a href="?month=<?= $month ?>&year=<?= $year ?>&next_month=true">
            <button type="button">Next Month</button>
        </a>
    </div>

    <?php while ($student = mysqli_fetch_assoc($students)): ?>
        <h3><?= htmlspecialchars($student['name']) ?> (Class: <?= $student['class'] ?>, Section: <?= $student['section'] ?>)</h3>
        <div class="calendar-wrapper">
            <table class="calendar">
                <thead>
                    <tr>
                        <?php for ($d = 1; $d <= $daysInMonth; $d++): ?>
                            <th><?= $d ?></th>
                        <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        for ($d = 1; $d <= $daysInMonth; $d++) {
                            $date = date("Y-m-d", strtotime("$year-$month-$d"));
                            $att_sql = "SELECT status FROM attendance WHERE student_id='{$student['id']}' AND date='$date' LIMIT 1";
                            $att_res = mysqli_query($conn, $att_sql);
                            $status = mysqli_num_rows($att_res) ? mysqli_fetch_assoc($att_res)['status'] : 'No Data';
                            $class = 'no-data';
                            if ($status == 'Present') $class = 'present';
                            elseif ($status == 'Absent') $class = 'absent';
                            elseif ($status == 'Leave') $class = 'leave';
                            echo "<td class='$class' title='$date - $status'></td>";
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endwhile; ?>
</div>