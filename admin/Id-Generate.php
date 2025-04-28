<?php
include("DB.php");
session_start();
include("DB.php");

$schoolId = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';
// Base query
$sql = "SELECT * FROM employee WHERE school_id='$schoolId'";

// Check if designation is set and not empty
$designation = isset($_GET['designation']) ? $_GET['designation'] : '';
if (!empty($school_id)) {
    $sql .= " AND school_id LIKE '%$schoolId%'";
}
if (!empty($designation)) {
    // Use exact match instead of LIKE to prevent unwanted matches
    $sql .= " AND designation = '$designation'";
}

// Execute query
$data = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .main {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #004d40;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .form-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-actions {
            margin-top: 20px;
        }

        .form-actions button {
            padding: 10px 20px;
            border: none;
            background-color: #004d40;
            color: white;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        .form-actions button:hover {
            background-color: #00796b;
        }

        table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #3b5998;
            color: white;
        }

        th,
        td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 6px;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <div id="nav">
        <a href='Dashboard.php'><img id="logo" src="janta_logo.jpeg" alt=""></a>
        <a href="index.php">
            <h2 id="logout">Logout</h2>
        </a>
    </div>

    <div id="main">
        <div class="main">
            <div class="container">
                <h2>Employee Management</h2>
                <form method="get">

                    <div class="form-group">
                        <label for="school_id">School Id</label>
                        <input type="text" id="school_id" style="padding: 10px 4px;" name="school_id" placeholder="Enter School Id" value="<?= htmlspecialchars($schoolId) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="designation">Designation</label>
                        <!-- designation -->
                        <input type="text" id="designation" style="padding: 10px 4px;" name="designation" placeholder="Enter Designation" value="<?= htmlspecialchars($designation) ?>">

                    </div>
                    <div class="form-actions">
                        <button type="submit">Filter</button>
                    </div>
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Id</th>
                        <th>School Id</th>
                        <th>Image</th>
                        <th>Signature</th>
                        <th>Employee Name</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>RFID</th>
                        <th>Designation</th>
                        <th>Modify</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($data) > 0) {
                        $srNo = 1;
                        while ($res = mysqli_fetch_assoc($data)) {
                    ?>
                            <tr>
                                <td><?= $srNo++ ?></td>
                                <td><?= $res['id'] ?></td>
                                <td><?= $res['school_id'] ?></td>
                                <td><img src="employee_photo/<?= $res['photo'] ?>" height="50px" width="50px" alt=""></td>
                                <td><img src="signature/<?= $res['signature'] ?>" height="40px" width="100px" alt=""></td>
                                <td><?= $res['emp_name'] ?></td>
                                <td><?= $res['gender'] ?></td>
                                <td><?= $res['contact'] ?></td>
                                <td><?= $res['rfid'] ?></td>
                                <td><?= $res['designation'] ?></td>
                                <td><a href="employee_update.php?id=<?= $res['id'] ?>" style="color: green;">Update</a></td>
                                <td><a href="delete-employee.php?id=<?= $res['id'] ?>" style="color: red;">Delete</a></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='9'>No employees found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>