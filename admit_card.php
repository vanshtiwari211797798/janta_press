<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admit Card</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }
        .admit-card {
            width: 800px;
            padding: 20px;
            background: white;
            border: 8px solid #1e3a8a;
            text-align: center;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 2px solid #1e3a8a;
        }
        .header img {
            width: 80px;
            height: auto;
        }
        .title {
            font-size: 22px;
            font-weight: bold;
            color: #1e3a8a;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }
        .details {
            width: 65%;
            text-align: left;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }
        .details-table th, .details-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .photo {
            width: 120px;
            height: 140px;
            border: 2px solid #000;
            background: #ccc;
            text-align: center;
            line-height: 140px;
            font-size: 14px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: none;
        }
        .footer {
            font-size: 14px;
            margin-top: 15px;
            font-weight: bold;
        }
        .signature {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .signature div {
            text-align: center;
        }
        .signature img {
            width: 100px;
            height: auto;
        }
        .download-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background: #1e3a8a;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .download-btn:hover {
            background: #162d6a;
        }
        @media print {
            body {
                background: none;
            }
            .admit-card {
                border: none;
                box-shadow: none;
            }
            .download-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

    <div class="admit-card" id="admitCard">
        <div class="header">
            <img src="school-logo.png" alt="School Logo">
            <div class="title">ADMIT CARD</div>
            <img src="qr-code.png" alt="QR Code">
        </div>
        
        <div class="container">
            <div class="details">
                <table class="details-table">
                    <tr>
                        <th>Student Name</th>
                        <td>John Doe</td>
                    </tr>
                    <tr>
                        <th>Roll Number</th>
                        <td>123456</td>
                    </tr>
                    <tr>
                        <th>Class</th>
                        <td>10th</td>
                    </tr>
                    <tr>
                        <th>Exam Date</th>
                        <td>15th June 2025</td>
                    </tr>
                    <tr>
                        <th>Exam Center</th>
                        <td>XYZ Public School, New Delhi</td>
                    </tr>
                </table>
            </div>

            <!-- Student Photo Section -->
            <div class="photo" id="photoContainer">
                <span>Student Photo</span>
                <img id="studentPhoto" src="">
            </div>
        </div>

        <div class="signature">
            <div>
                <p>Principal's Signature</p>
                <img src="signature.png" alt="Signature">
            </div>
        </div>

        <p class="footer">This is a computer-generated document and does not require a signature.</p>
    </div>

    <button class="download-btn" onclick="downloadAdmitCard()">Download Admit Card</button>

    <script>
        function downloadAdmitCard() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('p', 'mm', 'a4');

            html2canvas(document.querySelector("#admitCard"), { scale: 2 }).then(canvas => {
                const imgData = canvas.toDataURL("image/png");
                const imgWidth = 210; 
                const pageHeight = 297; 
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;

                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                doc.save("Admit_Card.pdf");
            });
        }
    </script>

</body>
</html>
