<?php
session_start();
include("DB.php");
if (!isset($_GET['id'])) {
    header('Location:Student-ID.php');
} else {
    $school_id = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : ''; 
    $schoolInfo = "SELECT school_name FROM add_school WHERE school_id='$school_id'";
    $resSchool = mysqli_query($conn,$schoolInfo);
    $SchoolData = mysqli_fetch_assoc($resSchool);
    $schoolName = $SchoolData['school_name'];
    $id = $_GET['id'];
    $fetchStd_Detail = "SELECT * FROM students WHERE id='$id'";
    $data = mysqli_query($conn, $fetchStd_Detail);
    if (mysqli_num_rows($data) > 0) {
        $record = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School ID Card</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            flex-direction: column;
            border: 2px solid black;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: #e0f2f1;
            padding: 10px;
        }

        .id-card {
            width: 100%;
            max-width: 350px;
            background: #fff;
            border-radius: 15px;
            border: 2px solid black;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            padding-bottom: 20px;
        }

        .header {
            background: #6bcba5;
            height: 80px;
            display: flex;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            font-weight: bold;
        }

        .logo {
            background: white;
            color: #6bcba5;
            width: 60px;
            height: 60px;
            margin-top: 5px;
            display: flex;
            font-size: 14px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .content {
            padding: 15px;
        }

        .profile {
            width: 100px;
            height: 100px;
            border: 3px solid #6bcba5;
            border-radius: 10px;
            display: block;
            margin: 0 auto 15px;
        }

        .info {
            font-size: 14px;
            margin-top: 10px;
            text-align: left;
        }

        .info p {
            margin-bottom: 8px;
        }

        .footer {
            margin-top: 15px;
            text-align: right;
            font-size: 14px;
            font-weight: bold;
            color: #444;
            padding: 0 15px 10px;
        }

        .download-btn {
            margin-top: 15px;
            padding: 10px 20px;
            background: #6bcba5;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
        }

        @media (max-width: 500px) {
            .id-card {
                max-width: 300px;
            }

            .profile {
                width: 80px;
                height: 80px;
            }

            .info {
                font-size: 12px;
            }

            .footer {
                font-size: 12px;
            }

            .download-btn {
                font-size: 12px;
                padding: 8px 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="id-card" id="idCard">
            <div class="header">
                <div class="logo">LOGO</div>
                <?=$schoolName?>
            </div>
            <div class="content">
                <div class="details">
                    <img class="profile" src="Students_photo/<?=$record['photo']?>" alt="Student Photo">
                    <div class="info">
                        <p><strong>ID:</strong> <?=$record['roll_number']?></p>
                        <p><strong>Name:</strong> <?=$record['name']?></p>
                        <p><strong>Class:</strong> <?=$record['class']?> (<?=$record['section']?>)</p>
                        <p><strong>D.O.B:</strong> <?=$record['dob']?></p>
                        <p><strong>Father:</strong> <?=$record['father_name']?></p>
                        <p><strong>Mother:</strong> <?=$record['mother_name']?></p>
                        <p><strong>Address:</strong> <?=$record['address']?></p>
                        <p><strong>Phone:</strong> <?=$record['father_contact']?></p>
                    </div>
                </div>
            </div>
            <div class="footer">Principal</div>
        </div>
        <button class="download-btn" onclick="downloadPDF()">Download</button>
    </div>

    <script>
        function downloadPDF() {
            html2canvas(document.getElementById("idCard")).then(canvas => {
                const imgData = canvas.toDataURL("image/png");
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF("p", "mm", "a4");
                const imgWidth = 80;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                pdf.addImage(imgData, "PNG", 65, 30, imgWidth, imgHeight);
                pdf.save("ID_Card.pdf");
            });
        }
    </script>
</body>

</html>

<?php
    }
}
?>
