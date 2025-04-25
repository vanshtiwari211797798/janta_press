<?php
session_start();
include("admin/DB.php");
$school_id = isset($_SESSION['school_id']) ? $_SESSION['school_id'] : '';
$class = isset($_SESSION['class']) ? $_SESSION['class'] : '';
$roll_number = isset($_SESSION['roll_number']) ? $_SESSION['roll_number'] : '';
$section = isset($_SESSION['section']) ? $_SESSION['section'] : '';
$sql = "SELECT * FROM declared_tc WHERE school_id='$school_id' AND class='$class' AND section='$section' AND roll_number='$roll_number'";
$data = mysqli_query($conn, $sql);
if (mysqli_num_rows($data) > 0) {
    $res = mysqli_fetch_assoc($data);
} else {
    echo "Not Issue";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Certificate</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <!-- Google Translate Script -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                    pageLanguage: 'en',
                    includedLanguages: 'ne',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                },
                'google_translate_element'
            );
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script type="text/javascript">
        function setNepaliLanguage() {
            var select = document.querySelector("select.goog-te-combo");
            if (select) {
                select.value = "ne";
                select.dispatchEvent(new Event("change"));
            } else {
                setTimeout(setNepaliLanguage, 1000);
            }
        }
        setTimeout(setNepaliLanguage, 3000);
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            padding: 10px;
        }

        .certificate {
            width: 90%;
            max-width: 600px;
            padding: 15px;
            background: white;
            border: 5px solid #1e3a8a;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
            box-sizing: border-box;
        }

        .certificate h1 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .certificate h2 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .certificate p {
            font-size: 13px;
            line-height: 1.3;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 12px;
        }

        .details-table th,
        .details-table td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
            word-wrap: break-word;
        }

        .signature {
            margin-top: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .signature div {
            text-align: center;
            width: 100%;
        }

        .signature img {
            width: 50px;
            height: auto;
            margin-top: 5px;
        }

        .footer {
            font-size: 12px;
            margin-top: 8px;
        }

        @media print {
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                padding: 0;
            }

            .certificate {
                width: 794px;
                height: 1123px;
                border: none;
                box-shadow: none;
                margin: auto;
                page-break-before: always;
            }
        }
    </style>
</head>

<body>
    <div id="google_translate_element"></div>
    <div id="certificate" class="certificate">
        <h1>स्थानान्तरण प्रमाणपत्र</h1>
        <h2>Transfer Certificate</h2>
        <p>Certified that the student whose details are given below has been a student of this institution.</p>
        <table class="details-table">
            <tr>
                <th>School Name</th>
                <td><?= $res['school_name'] ?></td>
            </tr>
            <tr>
                <th>Student Name</th>
                <td><?= $res['name'] ?></td>
            </tr>
            <tr>
                <th>Class & Section</th>
                <td><?= $res['class'] ?>th - <?= $res['section'] ?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><?= $res['dob'] ?></td>
            </tr>
            <tr>
                <th>Roll Number</th>
                <td><?= $res['roll_number'] ?></td>
            </tr>
            <tr>
                <th>Father's Name</th>
                <td><?= $res['father_name'] ?></td>
            </tr>
            <tr>
                <th>Mother's Name</th>
                <td><?= $res['mother_name'] ?></td>
            </tr>
            <tr>
                <th>Issued Date</th>
                <td><?= $res['date_of_tc_issue'] ?></td>
            </tr>
            <tr>
                <th>Student Behaviour</th>
                <td><?= $res['behaviour'] ?></td>
            </tr>
        </table>
        <p class="footer">संस्था तपाईंको उज्जवल भविष्यको कामना गर्दछ।</p>
        <p class="footer"><strong>यो प्रमाणपत्र डिजिटल रूपमा जारी गरिएको छ।</strong></p>
        <div class="signature">
            <div>
                <p>Seal & Signature</p>
                <img src="admin/tc_seal_signature/<?= $res['seal_signature'] ?>" alt="School Seal">
            </div>
        </div>
    </div>
    <br>
    <button style="cursor: pointer;" class="download-btn" onclick="downloadPDF()">Download PDF</button>

    <script>
        function downloadPDF() {
            const certificate = document.getElementById("certificate");

            const options = {
                margin: 10,
                filename: "Transfer_Certificate.pdf",
                image: {
                    type: "jpeg",
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true
                },
                jsPDF: {
                    unit: "mm",
                    format: "a4",
                    orientation: "portrait"
                }
            };

            html2pdf().set(options).from(certificate).save();
        }
    </script>
</body>

</html>