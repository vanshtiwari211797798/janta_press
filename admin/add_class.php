<?php
session_start();
ob_start();
include("DB.php");

$schoolId = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';
$err = "";

// Form submission handling
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['school_id'])) {
        $err = "School ID is required";
    } elseif (empty($_POST['class'])) {
        $err = "Class Name is required";
    } else {
        $school_id = $_POST['school_id'];
        $class = strtoupper($_POST['class']);
        $sql = "INSERT INTO addclass (school_id, class) VALUES ('$school_id', '$class')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Class added successfully'); window.location.href=window.location.href;</script>";
        }
    }
}

// Fetching classes for the table
$classQuery = "SELECT * FROM addclass WHERE school_id = '$schoolId'";
$classResult = mysqli_query($conn, $classQuery);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add class</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f0f2f5;
        }

        .form-container {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            margin: 2rem auto 1rem;
        }

        .form-container h2 {
            margin-bottom: 1rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn {
            width: 100%;
            padding: 0.7rem;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            margin-bottom: 0.5rem;
        }

        .btn:hover {
            background: #0056b3;
        }

        .btn-back {
            background-color: #6c757d;
        }

        .btn-back:hover {
            background-color: #5a6268;
        }

        .error {
            color: red;
            text-align: center;
        }

        .table-container {
            width: 90%;
            max-width: 800px;
            margin: 1rem auto;
            overflow-x: auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 0.8rem;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        @media (max-width: 500px) {
            .form-container {
                padding: 1.5rem;
            }

            th,
            td {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>

    <div class="form-container">
        <p class="error"><?= isset($err) ? $err : '' ?></p>
        <h2>Add Class</h2>
        <form method="post">
            <div class="form-group">
                <label for="school_id">School ID</label>
                <input type="text" id="school_id" value="<?= $schoolId ?>" readonly name="school_id">
            </div>
            <div class="form-group">
                <label for="className">Class Name</label>
                <input type="text" id="className" name="class">
            </div>
            <button type="submit" class="btn">Add</button>
            <button type="button" class="btn btn-back" onclick="window.location.href='student-Management.php'">Back</button>
        </form>
    </div>

    <div class="table-container">
        <h3 style="text-align:center;">Class List</h3>
        <table>
            <thead>
                <tr>
                    <th>School id</th>
                    <th>Class Name</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // $i = 1;
                if (mysqli_num_rows($classResult) > 0) {
                    while ($row = mysqli_fetch_assoc($classResult)) {
                        echo "<tr>
                        <td>{$row['school_id']}</td>
                        <td>Class {$row['class']}</td>
                        <td><a href='delete_class.php?id={$row['id']}' style='color:red; text-decoration:none;'>Delete</a></td>
                      </tr>";
                        // $i++;
                    }
                } else {
                    echo "<tr><td colspan='2' style='text-align:center;'>No classes added yet.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>