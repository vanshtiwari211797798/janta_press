<?php
session_start();
include("DB.php"); // Include database connection
$schoolId = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';

$sql = "SELECT * FROM inventorys WHERE school_id='$schoolId'";
$result = $conn->query($sql);

echo "<h2>Inventory List</h2>";

echo "<a href='Dashboard.php' class='dashboard-btn' style='margin-right:20px'>Go to Dashboard</a>"; // Dashboard Button
echo "<a href='add_inventry.php' class='back-btn'>Back to Add Inventory</a>"; // Back Button

echo "<div class='table-container'>
        <table class='inventory-table'>
            <thead>
                <tr>
                    <th>S.r. No</th>
                    <th>School Id</th>
                    <th>Item Name</th>
                    <th>Item Code</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";

if ($result->num_rows > 0) {
    $sr = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $sr++ . "</td>
                <td>" . $row["school_id"] . "</td>
                <td>" . $row["item_name"] . "</td>
                <td>" . $row["item_code"] . "</td>
                <td>" . $row["quantity"] . "</td>
                <td>" . $row["price"] . "</td>
                <td>" . $row["description"] . "</td>
                <td>" . $row["date_added"] . "</td>
                <td><a href='edit_inventry.php?id=" . $row["id"] . "'>Edit</a> | <a href='delete_inventry.php?id=" . $row["id"] . "'>Delete</a></td>
              </tr>";
    }
    echo "</tbody></table></div>";
} else {
    echo "<p>No inventory records found.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory List</title>
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Basic body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        /* Button Styles */
        .dashboard-btn,
        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-decoration: none;
            text-align: center;
        }

        .dashboard-btn {
            background-color: #2196F3;
            color: white;
        }

        .dashboard-btn:hover {
            background-color: #1976D2;
        }

        .back-btn {
            background-color: #f44336;
            color: white;
        }

        .back-btn:hover {
            background-color: #e53935;
        }

        /* Table container styles */
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
        }

        .inventory-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            table-layout: fixed;
        }

        .inventory-table th,
        .inventory-table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .inventory-table th {
            background-color: #4CAF50;
            color: white;
        }

        .inventory-table td {
            background-color: #fff;
        }

        .inventory-table a {
            text-decoration: none;
            color: #007bff;
            padding: 5px;
        }

        .inventory-table a:hover {
            text-decoration: underline;
        }

        /* Responsive Table Styles */
        @media (max-width: 768px) {

            .inventory-table th,
            .inventory-table td {
                padding: 8px;
                font-size: 12px;
            }

            .inventory-table {
                font-size: 12px;
            }

            .dashboard-btn,
            .back-btn {
                font-size: 14px;
                padding: 8px 16px;
            }
        }

        @media (max-width: 480px) {

            .inventory-table th,
            .inventory-table td {
                font-size: 10px;
                padding: 6px;
            }

            .inventory-table {
                font-size: 10px;
            }

            .dashboard-btn,
            .back-btn {
                font-size: 12px;
                padding: 6px 12px;
            }
        }
    </style>
</head>

<body>

</body>

</html>