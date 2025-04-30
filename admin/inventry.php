<?php
session_start();
include("DB.php");
$schoolId = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';

$sql = "SELECT * FROM inventorys WHERE school_id='$schoolId'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory List</title>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
            padding: 15px;
            line-height: 1.4;
        }
        
        h2 {
            text-align: center;
            margin: 15px 0;
            color: #4CAF50;
        }
        
        /* Button Styles */
        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .dashboard-btn, .back-btn {
            display: inline-block;
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            flex: 1;
            min-width: 120px;
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
        
        /* Table Styles */
        .table-container {
            overflow-x: auto;
            margin-top: 15px;
            -webkit-overflow-scrolling: touch;
        }
        
        .inventory-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        
        .inventory-table th, 
        .inventory-table td {
            padding: 8px 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        
        .inventory-table th {
            background-color: #4CAF50;
            color: white;
            position: sticky;
            top: 0;
        }
        
        .inventory-table td {
            background-color: #fff;
        }
        
        .inventory-table a {
            text-decoration: none;
            color: #007bff;
            padding: 2px 5px;
            white-space: nowrap;
        }
        
        .inventory-table a:hover {
            text-decoration: underline;
        }
        
        /* Print Area (Hidden on Screen) */
        #printArea {
            display: none;
        }
        
        /* Print Styles */
        @page {
            size: A4;
            margin: 10mm;
        }
        
        @media print {
            body * {
                visibility: hidden;
            }
            
            .print-container, 
            .print-container * {
                visibility: visible;
            }
            
            .print-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
            }
            
            .no-print {
                display: none;
            }
        }
        
        .print-content {
            width: 190mm;
            min-height: 277mm;
            margin: 0 auto;
            padding: 10mm;
            background: white;
            box-sizing: border-box;
        }
        
        .print-heading {
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid #000;
        }
        
        .print-heading h1 {
            font-size: 22px;
            color: #000;
        }
        
        .print-header {
            text-align: center;
            margin-bottom: 10px;
        }
        
        .print-header h2 {
            font-size: 18px;
            color: #333;
            margin-bottom: 5px;
        }
        
        .print-header p {
            font-size: 12px;
        }
        
        .print-details {
            margin: 15px 0;
        }
        
        .print-details table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        
        .print-details th, 
        .print-details td {
            border: 1px solid #ddd;
            padding: 6px 8px;
            text-align: left;
        }
        
        .print-details th {
            background-color: #f2f2f2;
            width: 30%;
        }
        
        .print-footer {
            margin-top: 15px;
            text-align: center;
            font-size: 10px;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }
        
        .digital-signature {
            font-style: italic;
            color: #666;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .inventory-table {
                font-size: 14px;
            }
            
            .inventory-table th, 
            .inventory-table td {
                padding: 6px 8px;
            }
        }
        
        @media (max-width: 480px) {
            .button-group {
                flex-direction: column;
            }
            
            .dashboard-btn, 
            .back-btn {
                width: 100%;
            }
            
            .inventory-table {
                font-size: 12px;
            }
            
            .inventory-table th, 
            .inventory-table td {
                padding: 4px 6px;
            }
            
            .inventory-table a {
                display: block;
                padding: 2px 0;
            }
        }
    </style>
</head>
<body>
    <h2>Inventory List</h2>
    
    <div class="button-group">
        <a href="Dashboard.php" class="dashboard-btn">Go to Dashboard</a>
        <a href="add_inventry.php" class="back-btn">Back to Add Inventory</a>
    </div>
    
    <div class="table-container">
        <table class="inventory-table">
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
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                <?php
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
                                <td>
                                    <a href='edit_inventry.php?id=" . $row["id"] . "'>Edit</a> 
                                    <span>|</span>
                                    <a href='delete_inventry.php?id=" . $row["id"] . "'>Delete</a>
                                </td>
                                <td><a href='javascript:void(0);' onclick='printInventory(" . json_encode($row) . ")'>Download</a></td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10' style='text-align:center;'>No inventory records found.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    
    <!-- Hidden Print Area -->
    <div id="printArea">
        <div class="print-container">
            <div class="print-content">
                <div class="print-heading">
                    <h1>JANTA S.PRESS</h1>
                </div>
                
                <div class="print-header">
                    <h2>INVENTORY DETAILS</h2>
                    <p>School ID: <span id="print-school-id"></span></p>
                </div>
                
                <div class="print-details">
                    <table>
                        <tr>
                            <th>Item Name</th>
                            <td id="print-item-name"></td>
                        </tr>
                        <tr>
                            <th>Item Code</th>
                            <td id="print-item-code"></td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td id="print-quantity"></td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td id="print-price"></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td id="print-description"></td>
                        </tr>
                        <tr>
                            <th>Date Added</th>
                            <td id="print-date-added"></td>
                        </tr>
                    </table>
                </div>
                
                <div class="print-footer">
                    <p class="digital-signature">This is a digitally issued document. Signature is not required.</p>
                    <p>Printed on: <span id="print-date"></span></p>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function printInventory(inventory) {
            // Populate print area
            document.getElementById('print-school-id').textContent = inventory.school_id;
            document.getElementById('print-item-name').textContent = inventory.item_name;
            document.getElementById('print-item-code').textContent = inventory.item_code;
            document.getElementById('print-quantity').textContent = inventory.quantity;
            document.getElementById('print-price').textContent = inventory.price;
            document.getElementById('print-description').textContent = inventory.description;
            document.getElementById('print-date-added').textContent = inventory.date_added;
            
            // Set current date
            const today = new Date();
            document.getElementById('print-date').textContent = today.toLocaleDateString() + ' ' + today.toLocaleTimeString();
            
            // Trigger print
            const printArea = document.getElementById('printArea');
            printArea.style.display = 'block';
            
            setTimeout(() => {
                window.print();
                printArea.style.display = 'none';
            }, 100);
        }
    </script>
</body>
</html>