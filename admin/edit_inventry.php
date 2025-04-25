<?php
include 'DB.php';

$id = $_GET['id'];
$sql = "SELECT * FROM inventorys WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No item found!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST['item_name'];
    $item_code = $_POST['item_code'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "UPDATE inventorys SET item_name='$item_name', item_code='$item_code', quantity='$quantity', price='$price', description='$description' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        header("Location: index.php");
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
    <title>Edit Inventory Item</title>
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
        .back-btn,
        .dashboard-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            margin-bottom: 20px;
            text-decoration: none;
            text-align: center;
            margin-right: 10px;
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

        /* Form container */
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Form input styles */
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

            .back-btn,
            .dashboard-btn {
                font-size: 14px;
                padding: 8px 16px;
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

            .back-btn,
            .dashboard-btn {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>



    <!-- Form Container for Editing Inventory -->
    <div class="form-container">
        <h2>Edit Inventory Item</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="school_id">School Id</label>
                <input type="text" id="school_id" name="school_id" value="<?php echo $row['school_id']; ?>" required readonly>
            </div>

            <div class="form-group">
                <label for="item_name">Item Name</label>
                <input type="text" id="item_name" name="item_name" value="<?php echo $row['item_name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="item_code">Item Code</label>
                <input type="text" id="item_code" name="item_code" value="<?php echo $row['item_code']; ?>" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" value="<?php echo $row['price']; ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" cols="50"><?php echo $row['description']; ?></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Update Item" class="submit-btn">
            </div>
        </form>
         <!-- Back Button -->
         <a href="inventry.php" class="back-btn">Back</a>
        <a href="Dashboard.php" class="back-btn" style="background: green;">Dashboard</a>
    </div>

</body>
</html>
