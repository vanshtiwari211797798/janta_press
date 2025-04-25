<?php
session_start();
include("DB.php");

if (isset($_POST['upload'])) {
    if ($_FILES['csv_file']['name']) {
        $filename = $_FILES['csv_file']['tmp_name'];
        $file = fopen($filename, "r");
        
        // Initialize counters
        $total_rows = 0;
        $imported_rows = 0;
        $skipped_rows = 0;
        $errors = [];

        // Skip header row (first row)
        $headers = fgetcsv($file);
        $total_rows++;

        while (($row = fgetcsv($file)) !== FALSE) {
            $total_rows++;
            
            // Skip empty rows or rows with all empty values
            if ($row === NULL || count(array_filter($row, 'strlen')) === 0) {
                $skipped_rows++;
                continue;
            }

            // Pad the row array to ensure we have at least 20 elements
            $row = array_pad($row, 20, '');
            
            // Trim all values
            $trimmed_row = array_map('trim', $row);
            
            // Check if this row has any real data
            if (count(array_filter($trimmed_row, 'strlen')) === 0) {
                $skipped_rows++;
                continue;
            }

            // ADJUSTED COLUMN MAPPING:
            // Since your first column is empty, we'll shift all columns by 1
            $school_id = mysqli_real_escape_string($conn, $trimmed_row[1]);  // Now getting from column 2
            $name = mysqli_real_escape_string($conn, $trimmed_row[2]);      // Now getting from column 3
            
            // Only process rows that have both school_id and name
            if (!empty($school_id) && !empty($name)) {
                $class = mysqli_real_escape_string($conn, $trimmed_row[3]);
                $section = mysqli_real_escape_string($conn, $trimmed_row[4]);
                $category = mysqli_real_escape_string($conn, $trimmed_row[5]);
                $gender = mysqli_real_escape_string($conn, $trimmed_row[6]);
                $dob = mysqli_real_escape_string($conn, $trimmed_row[7]);
                $roll_number = mysqli_real_escape_string($conn, $trimmed_row[8]);
                $father_name = mysqli_real_escape_string($conn, $trimmed_row[9]);
                $father_contact = mysqli_real_escape_string($conn, $trimmed_row[10]);
                $mother_name = mysqli_real_escape_string($conn, $trimmed_row[11]);
                $mother_contact = mysqli_real_escape_string($conn, $trimmed_row[12]);
                $blood_grp = mysqli_real_escape_string($conn, $trimmed_row[13]);
                $city = mysqli_real_escape_string($conn, $trimmed_row[14]);
                $address = mysqli_real_escape_string($conn, $trimmed_row[15]);
                // $photo = mysqli_real_escape_string($conn, $trimmed_row[16]);
                $rf_id = mysqli_real_escape_string($conn, $trimmed_row[16]);
                $sms = mysqli_real_escape_string($conn, $trimmed_row[17]);
                $android_password = mysqli_real_escape_string($conn, $trimmed_row[18]);
                $remark = mysqli_real_escape_string($conn, $trimmed_row[19] ?? ''); // Extra column if exists

                $sql = "INSERT INTO students (
                    school_id, name, class, section, category, gender, dob, roll_number,
                    father_name, father_contact, mother_name, mother_contact, blood_grp,
                    city, address, rf_id, sms, android_password, remark
                ) VALUES (
                    '$school_id', '$name', '$class', '$section', '$category', '$gender', '$dob', '$roll_number',
                    '$father_name', '$father_contact', '$mother_name', '$mother_contact', '$blood_grp',
                    '$city', '$address', '$rf_id', '$sms', '$android_password', '$remark'
                )";

                if (mysqli_query($conn, $sql)) {
                    $imported_rows++;
                } else {
                    $errors[] = "Error importing row $total_rows: " . mysqli_error($conn);
                    $skipped_rows++;
                }
            } else {
                $skipped_rows++;
                // Only show error for rows that have some data but missing required fields
                if (count(array_filter($trimmed_row, 'strlen')) > 0) {
                    $errors[] = "Skipped row $total_rows: Missing school_id or name (Data: " . implode(", ", $trimmed_row) . ")";
                }
            }
        }

        fclose($file);
        
        // Prepare result message
        $message = "<div class='import-results'>";
        $message .= "<h3>CSV Import Results</h3>";
        $message .= "<p><strong>Total rows processed:</strong> $total_rows</p>";
        $message .= "<p><strong>Successfully imported:</strong> <span style='color:green'>$imported_rows</span></p>";
        $message .= "<p><strong>Skipped rows:</strong> $skipped_rows</p>";
        
        if (!empty($errors)) {
            $message .= "<div class='error-section'>";
            $message .= "<h4>Errors/Warnings:</h4>";
            $message .= "<div class='error-list'><ul>";
            foreach (array_slice($errors, 0, 20) as $error) {
                $message .= "<li>$error</li>";
            }
            if (count($errors) > 20) {
                $message .= "<li>... and " . (count($errors) - 20) . " more errors</li>";
            }
            $message .= "</ul></div></div>";
        }
        
        $message .= "</div>";
        
        echo $message;
    } else {
        echo "<p class='error'>Please select a CSV file.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERT CSV</title>
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
            max-width: 800px;
            margin: 0 auto;
        }

        .container h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #004d40;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-actions {
            margin-top: 20px;
            text-align: center;
        }

        .form-actions button {
            padding: 10px 20px;
            border: none;
            background-color: #004d40;
            color: white;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .form-actions button:hover {
            background-color: #00796b;
        }

        .import-results {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            background-color: #f8f9fa;
        }

        .error-list {
            max-height: 200px;
            overflow-y: auto;
            background-color: #fff8f8;
            padding: 10px;
            border: 1px solid #ffdddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div id="main">
        <div id="left-slider">
            <div class="sidebar">
                <h2>Menu</h2>
                <a href="Dashboard.php" class="w3-bar-item w3-button">Dashboard</a>
                <a href="student-Management.php" class="w3-bar-item w3-button">Student</a>
                <a href="Employee-Management.php" class="w3-bar-item w3-button">Staff</a>
                <a href="Holiday-Management.php" class="w3-bar-item w3-button">Holiday</a>
                <a href="Leave-management.php" class="w3-bar-item w3-button">Leave</a>
                <a href="Attendance-management.php" class="w3-bar-item w3-button">Attendance</a>
                <a href="student-sms.php" class="w3-bar-item w3-button">SMS</a>
                <a href="school-general-info.php" class="w3-bar-item w3-button">School Info</a>
                <a href="Dashboard.php" class="w3-bar-item w3-button">Log Out</a>
            </div>
        </div>
        <div class="main">
            <div class="container">
                <h2>Import Students from CSV</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="csv_file">Select CSV File:</label>
                        <input type="file" name="csv_file" id="csv_file" accept=".csv" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="upload">Import CSV</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>