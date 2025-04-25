<?php
session_start();
include 'DB.php';
$schoolId = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $school_id = $_POST['school_id'];
    $item_code = $_POST['item_code'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "INSERT INTO inventorys (school_id, item_name, item_code, quantity, price, description)
            VALUES ('$school_id','$item_name', '$item_code', '$quantity', '$price', '$description')";

    if ($conn->query($sql) === TRUE) {

        echo "
            <script>
                alert('Inventry added successfully');
                window.location.href='inventry.php';
            </script>
        ";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inventory Item</title>
    <link rel="stylesheet" href="styles.css">
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

        /* Center the form */
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Form heading */
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        /* Form group styles */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 16px;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group textarea {
            resize: vertical;
        }

        /* Submit button styles */
        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        /* Back button styles */
        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
            text-decoration: none;
            text-align: center;
        }

        .back-btn:hover {
            background-color: #e53935;
        }

        /* Responsive styles for smaller screens */
        @media (max-width: 768px) {
            .form-container {
                padding: 15px;
            }

            .form-group label {
                font-size: 14px;
            }

            .form-group input,
            .form-group textarea {
                font-size: 14px;
            }

            .submit-btn {
                font-size: 14px;
                padding: 12px;
            }
        }

        @media (max-width: 480px) {
            .form-container {
                width: 90%;
            }

            .form-group input,
            .form-group textarea {
                font-size: 12px;
            }

            .submit-btn {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Add New Inventory Item</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="school_id">School Id</label>
                <input type="text" id="school_id" name="school_id" value="<?= $schoolId ?>" required readonly>
            </div>

            <div class="form-group">
                <label for="item_name">Item Name</label>
                <input type="text" id="item_name" name="item_name" required>
            </div>

            <div class="form-group">
                <label for="item_code">Item Code</label>
                <input type="text" id="item_code" name="item_code" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" cols="50"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Add Item" class="submit-btn">
            </div>
        </form>

        <!-- Back Button -->
        <a href="inventry.php" class="back-btn">Back</a>
        <a href="Dashboard.php" class="back-btn" style="background: green;">Dashboard</a>
    </div>
</body>

</html>