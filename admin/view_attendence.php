<?php
session_start();
include("DB.php");
$schoolId = $_SESSION['schoolId'];

$filter_name = $_GET['name'] ?? '';
$filter_class = $_GET['class'] ?? '';
$filter_section = $_GET['section'] ?? '';
$student_id = $_GET['student_id'] ?? '';

$year = $_GET['year'] ?? date('Y');
$month = $_GET['month'] ?? date('m');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Handle CSV export
if (isset($_GET['export'])) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=attendance_report_' . $month . '_' . $year . '.csv');

    $output = fopen('php://output', 'w');

    // Write CSV headers
    fputcsv($output, array('Student ID', 'Name', 'Class', 'Section', 'Date', 'Status'));

    $export_sql = "SELECT s.id as student_id, s.name, s.class, s.section, a.date, a.status 
                  FROM students s
                  LEFT JOIN attendance a ON s.id = a.student_id
                  WHERE s.school_id='$schoolId' 
                  AND MONTH(a.date) = '$month' 
                  AND YEAR(a.date) = '$year'";

    if ($filter_name) $export_sql .= " AND s.name LIKE '%$filter_name%'";
    if ($filter_class) $export_sql .= " AND s.class='$filter_class'";
    if ($filter_section) $export_sql .= " AND s.section='$filter_section'";
    if ($student_id) $export_sql .= " AND s.id='$student_id'";

    $export_sql .= " ORDER BY s.name, a.date";

    $export_result = mysqli_query($conn, $export_sql);

    while ($row = mysqli_fetch_assoc($export_result)) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit();
}

// Navigation
if (isset($_GET['prev_month'])) {
    $month = $month == 1 ? 12 : $month - 1;
    $year = $month == 12 ? $year - 1 : $year;
} elseif (isset($_GET['next_month'])) {
    $month = $month == 12 ? 1 : $month + 1;
    $year = $month == 1 ? $year + 1 : $year;
}

// Get student details
$students_sql = "SELECT * FROM students WHERE school_id='$schoolId'";
if ($student_id) $students_sql .= " AND id='$student_id'";
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

    .multiple-entry {
        background: repeating-linear-gradient(45deg,
                #90ee90,
                #90ee90 10px,
                #f08080 10px,
                #f08080 20px);
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

    .multiple-entry-box {
        background: repeating-linear-gradient(45deg,
                #90ee90,
                #90ee90 10px,
                #f08080 10px,
                #f08080 20px);
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

    .attendance-details {
        margin-top: 30px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: #f9f9f9;
    }

    .attendance-details h4 {
        margin-top: 0;
        color: #2E8B57;
    }

    .attendance-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .attendance-table th,
    .attendance-table td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .attendance-table th {
        background-color: #f4f4f4;
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
        <input type="hidden" name="student_id" value="<?= $student_id ?>" />
        <select name="month">
            <?php for ($m = 1; $m <= 12; $m++): ?>
                <option value="<?= $m ?>" <?= $m == $month ? 'selected' : '' ?>>
                    <?= date('F', mktime(0, 0, 0, $m, 10)) ?>
                </option>
            <?php endfor; ?>
        </select>
        <select name="year">
            <?php for ($y = date('Y') - 5; $y <= date('Y') + 1; $y++): ?>
                <option value="<?= $y ?>" <?= $y == $year ? 'selected' : '' ?>><?= $y ?></option>
            <?php endfor; ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <!-- Export Buttons -->
    <div class="export-buttons">
        <a href="?export=1&month=<?= $month ?>&year=<?= $year ?>&name=<?= $filter_name ?>&class=<?= $filter_class ?>&section=<?= $filter_section ?>&student_id=<?= $student_id ?>">
            Export Monthly Report (CSV)
        </a><br><br>
        <!-- <a href="?export_daily=1&month=<?= $month ?>&year=<?= $year ?>&name=<?= $filter_name ?>&class=<?= $filter_class ?>&section=<?= $filter_section ?>&student_id=<?= $student_id ?>">
            Export Daily Sheet (CSV)
        </a> -->
    </div>

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
        <div class="legend-item">
            <div class="legend-box multiple-entry-box"></div> Multiple Entries
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="navigation-buttons">
        <a href="?month=<?= $month == 1 ? 12 : $month - 1 ?>&year=<?= $month == 1 ? $year - 1 : $year ?>&student_id=<?= $student_id ?>&name=<?= $filter_name ?>&class=<?= $filter_class ?>&section=<?= $filter_section ?>">
            <button type="button">Previous Month</button>
        </a>
        <span style="font-weight: bold; align-self: center;"><?= date('F Y', strtotime("$year-$month-01")) ?></span>
        <a href="?month=<?= $month == 12 ? 1 : $month + 1 ?>&year=<?= $month == 12 ? $year + 1 : $year ?>&student_id=<?= $student_id ?>&name=<?= $filter_name ?>&class=<?= $filter_class ?>&section=<?= $filter_section ?>">
            <button type="button">Next Month</button>
        </a>
    </div>

    <?php while ($student = mysqli_fetch_assoc($students)):
        // Get attendance summary for this student
        $summary_sql = "SELECT 
                        SUM(CASE WHEN status = 'Present' THEN 1 ELSE 0 END) as present_days,
                        SUM(CASE WHEN status = 'Absent' THEN 1 ELSE 0 END) as absent_days,
                        SUM(CASE WHEN status = 'Leave' THEN 1 ELSE 0 END) as leave_days,
                        COUNT(DISTINCT date) as total_days
                        FROM attendance 
                        WHERE student_id = '{$student['id']}'
                        AND MONTH(date) = '$month' 
                        AND YEAR(date) = '$year'";
        $summary_result = mysqli_query($conn, $summary_sql);
        $summary = mysqli_fetch_assoc($summary_result);
    ?>
        <div class="summary-card">
            <h3><?= htmlspecialchars($student['name']) ?> (Class: <?= $student['class'] ?>, Section: <?= $student['section'] ?>)</h3>

            <div class="summary-grid">
                <div class="summary-item">
                    <h4>Present Days</h4>
                    <p><?= $summary['present_days'] ?? 0 ?></p>
                </div>
                <div class="summary-item">
                    <h4>Absent Days</h4>
                    <p><?= $summary['absent_days'] ?? 0 ?></p>
                </div>
                <div class="summary-item">
                    <h4>Leave Days</h4>
                    <p><?= $summary['leave_days'] ?? 0 ?></p>
                </div>
                <div class="summary-item">
                    <h4>Total Days Recorded</h4>
                    <p><?= $summary['total_days'] ?? 0 ?></p>
                </div>
                <div class="summary-item">
                    <h4>Attendance Percentage</h4>
                    <p><?= $summary['total_days'] > 0 ? round(($summary['present_days'] / $summary['total_days']) * 100, 2) : 0 ?>%</p>
                </div>
            </div>
        </div>

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
                            $att_sql = "SELECT status FROM attendance WHERE student_id='{$student['id']}' AND date='$date'";
                            $att_res = mysqli_query($conn, $att_sql);

                            $statuses = [];
                            while ($att = mysqli_fetch_assoc($att_res)) {
                                $statuses[] = $att['status'];
                            }

                            $class = 'no-data';
                            $title = "$date - No Data";

                            if (count($statuses) > 0) {
                                if (count($statuses) > 1) {
                                    $class = 'multiple-entry';
                                    $title = "$date - Multiple entries: " . implode(", ", $statuses);
                                } else {
                                    $status = $statuses[0];
                                    $title = "$date - $status";
                                    if ($status == 'Present') $class = 'present';
                                    elseif ($status == 'Absent') $class = 'absent';
                                    elseif ($status == 'Leave') $class = 'leave';
                                }
                            }

                            echo "<td class='$class' title='$title'></td>";
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Detailed Attendance Records -->
        <div class="attendance-details">
            <h4>Detailed Attendance Records</h4>
            <table class="attendance-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Marked At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $start_date = "$year-$month-01";
                    $end_date = "$year-$month-$daysInMonth";

                    $detail_sql = "SELECT date, status, created_at FROM attendance 
                                  WHERE student_id='{$student['id']}' 
                                  AND date BETWEEN '$start_date' AND '$end_date'
                                  ORDER BY date, created_at";
                    $detail_res = mysqli_query($conn, $detail_sql);

                    if (mysqli_num_rows($detail_res) > 0) {
                        while ($record = mysqli_fetch_assoc($detail_res)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($record['date']) . "</td>";
                            echo "<td>" . htmlspecialchars($record['status']) . "</td>";
                            echo "<td>" . htmlspecialchars($record['created_at']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No attendance records found for this month</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    <?php endwhile; ?>
</div>

