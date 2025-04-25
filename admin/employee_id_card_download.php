<?php
session_start();
include("DB.php");
if (!isset($_GET['id'])) {
    header('Location:Id-Generate.php');
} else {
    $school_id = isset($_SESSION['schoolId']) ? $_SESSION['schoolId'] : ''; 
    $schoolInfo = "SELECT school_name FROM add_school WHERE school_id='$school_id'";
    $resSchool = mysqli_query($conn,$schoolInfo);
    $SchoolData = mysqli_fetch_assoc($resSchool);
    $schoolName = $SchoolData['school_name'];
    $id=$_GET['id'];
    $fetchStd_Detail = "SELECT * FROM employee WHERE id='$id'";
    $data = mysqli_query($conn, $fetchStd_Detail);
    if (mysqli_num_rows($data) > 0) {
        $record = mysqli_fetch_assoc($data);
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Employee ID Card</title>
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
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                    background: #f0f4f8;
                    padding: 20px;
                }

                .id-card {
                    width: 100%;
                    max-width: 380px;
                    background: #fff;
                    border-radius: 15px;
                    border: 3px solid #007bff;
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                    text-align: center;
                    padding-bottom: 20px;
                }

                .header {
                    background: #007bff;
                    height: 90px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 22px;
                    font-weight: bold;
                    border-top-left-radius: 15px;
                    border-top-right-radius: 15px;
                }

                .logo {
                    width: 60px;
                    height: 60px;
                    background: white;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 50%;
                    margin-bottom: 5px;
                    font-size: 14px;
                    font-weight: bold;
                    color: #007bff;
                }

                .content {
                    padding: 20px;
                }

                .profile {
                    width: 110px;
                    height: 110px;
                    border: 3px solid #007bff;
                    border-radius: 10px;
                    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
                    display: block;
                    margin: 0 auto 15px;
                }

                .info {
                    font-size: 14px;
                    text-align: left;
                    background: #e9f2ff;
                    padding: 15px;
                    border-radius: 10px;
                    box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
                }

                .info p {
                    margin-bottom: 10px;
                }

                .footer {
                    margin-top: 15px;
                    font-size: 14px;
                    font-weight: bold;
                    color: #333;
                }

                .download-btn {
                    margin-top: 15px;
                    padding: 12px 25px;
                    background: #007bff;
                    color: white;
                    border: none;
                    cursor: pointer;
                    font-size: 14px;
                    border-radius: 5px;
                    transition: 0.3s;
                }

                .download-btn:hover {
                    background: #0056b3;
                }

                @media (max-width: 500px) {
                    .id-card {
                        max-width: 320px;
                    }

                    .profile {
                        width: 90px;
                        height: 90px;
                    }

                    .info {
                        font-size: 12px;
                    }

                    .footer {
                        font-size: 12px;
                    }

                    .download-btn {
                        font-size: 12px;
                        padding: 10px 20px;
                    }
                }
            </style>
        </head>

        <body>
            <div class="container">
                <div class="id-card" id="idCard">
                    <div class="header">
                        <div class="logo">LOGO</div>
                        <?=isset($schoolName) ? $schoolName : ''?>
                    </div>
                    <div class="content">
                        <img class="profile" src="employee_photo/<?= $record['photo'] ?>" alt="Employee Photo">
                        <div class="info">
                            <p><strong>ID:</strong> <?= $record['rfid'] ?></p>
                            <p><strong>Name:</strong> <?= $record['emp_name'] ?></p>
                            <p><strong>Gender:</strong> <?= $record['gender'] ?></p>
                            <p><strong>D.O.B:</strong> <?= $record['dob'] ?></p>
                            <p><strong>Address:</strong> <?= $record['address'] ?></p>
                            <p><strong>Phone:</strong> <?= $record['contact'] ?></p>
                        </div>
                    </div>
                    <div class="footer">Principal</div>
                </div>
                <button class="download-btn" onclick="downloadPDF()">Download PDF</button>
            </div>

            <script>
                function downloadPDF() {
                    html2canvas(document.getElementById("idCard")).then(canvas => {
                        const imgData = canvas.toDataURL("image/png");
                        const {
                            jsPDF
                        } = window.jspdf;
                        const pdf = new jsPDF("p", "mm", "a4");
                        const imgWidth = 90;
                        const imgHeight = (canvas.height * imgWidth) / canvas.width;
                        pdf.addImage(imgData, "PNG", 60, 30, imgWidth, imgHeight);
                        pdf.save("Employee_ID_Card.pdf");
                    });
                }
            </script>
        </body>

        </html>
<?php
    }
}
?>