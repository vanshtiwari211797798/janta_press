<?php
if (!isset($_GET['school_id'])) {
    header('Location:index.php');
}
include('phpqrcode/qrlib.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View ID Card</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 30px;
            margin: 0;
            text-align: center;
        }

        h2 {
            color: #343a40;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .id-card-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .id-card {
            position: relative;
            background-size: cover;
            background-position: center;
            transition: opacity 0.3s ease;
            overflow: hidden;
            border: 2px solid #333;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            width: 86mm;
            height: 54mm;
            max-width: 100%;
            margin-bottom: 10px;
            background-color: #fff;
        }

        .draggable {
            line-height: 1;
            white-space: nowrap;
            position: absolute;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            color: #333;
            cursor: move;
        }

        .image-container {
            position: absolute;

            background: rgba(255, 255, 255, 0.5);
            border-radius: 8px;
        }

        .uploaded-image {
            width: 100%;
            height: 100%;

            object-fit: contain;
            pointer-events: none;
        }

        .button-container {
            margin-top: 20px;
            text-align: center;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 8px;
            margin: 10px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:active {
            background-color: #004085;
        }

        .filter-container {
            margin-bottom: 20px;
            padding: 15px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }

        .filter-container label {
            margin-right: 10px;
            font-weight: bold;
        }

        .filter-container input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 60px;
            text-align: center;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .id-card-container {
                flex-direction: column;
                gap: 30px;
            }

            .id-card {
                width: 100%;
                height: auto;
            }

            h2 {
                font-size: 24px;
            }

            button {
                width: 100%;
                padding: 15px;
            }
        }


        @media print {
            .id-card {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .draggable {
                position: absolute !important;
                transform: none !important;
                -webkit-transform: none !important;
            }
        }
    </style>

    <!-- html2canvas for converting HTML to image -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <!-- jsPDF for creating PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body>

    <h2>View ID Card</h2>

    <div class="filter-container">
        <label>Print Range:</label>
        <input type="number" id="startRange" placeholder="From" min="1">
        <span>to</span>
        <input type="number" id="endRange" placeholder="To" min="1">
        <button onclick="renderSelectedStudents()">Apply</button>
    </div>

    <div id="allCardsContainer">
        <!-- All cards will be rendered here -->
    </div>

    <div class="button-container">
        <button onclick="downloadAllPDFs('front')">Download All Front PDFs</button>
        <button onclick="downloadAllPDFs('back')">Download All Back PDFs</button>
    </div>

    <script>
        const schoolId = '<?= $_GET['school_id'] ?>'; // Your school ID
        const stdClass = '<?= $_GET['class'] ?>';
        const stdSection = '<?= $_GET['section'] ?>';
        let students = [];
        let templateData = null;
        let filteredStudents = [];

        // Field mappings between template text and database fields
        const fieldMappings = {
            "vansh": "name",
            "Father Name": "father_name",
            "Class": "class",
            "See": "section",
            "Roll No.": "roll_no",
            "Mob No.": "mobile",
            "Add": "address",
            "shivam": "name"
        };

        async function fetchStudentData() {
            try {
                const response = await fetch(`get-student-data.php?school_id=${schoolId}&class=${stdClass}&section=${stdSection}`);
                const data = await response.json();
                return data.students || [];
            } catch (error) {
                console.error("Error fetching student data:", error);
                return [];
            }
        }

        async function fetchTemplateData() {
            try {
                const response = await fetch(`get-idcard.php?id=${schoolId}`);
                return await response.json();
            } catch (error) {
                console.error("Error fetching template data:", error);
                return null;
            }
        }

        function getStudentField(field, student) {
            // If field is direct property
            if (student[field] !== undefined && student[field] !== null && student[field] !== '') {
                return student[field];
            }

            // If field is nested (e.g., 'address.city')
            const parts = field.split('.');
            let value = student;
            for (const part of parts) {
                if (value[part] === undefined || value[part] === null || value[part] === '') {
                    return null; // Return null if any part is missing
                }
                value = value[part];
            }

            return value;
        }

        function createIdCard(student, side) {
            const cardDiv = document.createElement('div');
            cardDiv.className = 'id-card';
            cardDiv.id = `idCard_${side}_${student.id}`;

            // Add selection state (default: selected)
            cardDiv.dataset.selected = 'true';
            cardDiv.style.transition = 'opacity 0.3s ease';

            // Set card dimensions from template data
            const cardWidth = templateData.width || 86;
            const cardHeight = templateData.height || 54;
            const widthInPx = cardWidth * 3.78;
            const heightInPx = cardHeight * 3.78;

            cardDiv.style.width = widthInPx + 'px';
            cardDiv.style.height = heightInPx + 'px';

            // Process card background
            const background = templateData[side]?.background ? `url(${templateData[side].background})` : null;
            cardDiv.style.backgroundImage = background || 'none';
            cardDiv.style.backgroundSize = 'cover';
            cardDiv.style.backgroundRepeat = 'no-repeat';
            cardDiv.style.backgroundPosition = 'center';

            let imageCount = 0;

            templateData[side]?.elements?.forEach(element => {
                if (element.type === "text") {
                    const content = getStudentField(element.content, student);

                    // Skip if content is empty or undefined
                    if (!content) return;

                    const textDiv = document.createElement('div');
                    textDiv.className = 'draggable';
                    textDiv.textContent = content;

                    textDiv.style.position = 'absolute';
                    textDiv.style.top = (element.position.top + 2) + 'px';
                    textDiv.style.height = element.position.height + 'px';
                    textDiv.style.width = (element.position.width = 0) + 'px';
                    textDiv.style.fontFamily = element.styles['font-family'];
                    textDiv.style.fontSize = element.styles['font-size'];
                    textDiv.style.color = element.styles.color;
                    textDiv.style.fontWeight = element.styles['font-weight'];
                    textDiv.style.fontStyle = element.styles['font-style'];
                    textDiv.style.padding = '2px';

                    // Measure text width dynamically
                    const tempSpan = document.createElement('span');
                    tempSpan.style.fontFamily = textDiv.style.fontFamily;
                    tempSpan.style.fontSize = textDiv.style.fontSize;
                    tempSpan.style.fontWeight = textDiv.style.fontWeight;
                    tempSpan.style.fontStyle = textDiv.style.fontStyle;
                    tempSpan.style.visibility = 'hidden';
                    tempSpan.style.whiteSpace = 'nowrap';
                    tempSpan.textContent = content;
                    document.body.appendChild(tempSpan);
                    const textWidth = tempSpan.offsetWidth;
                    document.body.removeChild(tempSpan);

                    // Replace the text width measurement code with this:
                    if (element.styles['text-align'] === 'center') {
                        textDiv.style.width = element.position.width + 'px';
                        textDiv.style.left = element.position.left + 'px';
                        textDiv.style.textAlign = 'center';
                        textDiv.style.transform = 'none';
                    } else {
                        textDiv.style.width = element.position.width + 'px';
                        textDiv.style.left = element.position.left + 'px';
                        textDiv.style.transform = 'none';
                    }

                    cardDiv.appendChild(textDiv);
                } else if (element.type === "image") {
                    imageCount++;

                    // Only create image container if it's the first image and student has a photo
                    if (imageCount === 1) {
                        if (student.photo) {
                            const imgSrc = `../admin/Students_photo/${student.photo}`;

                            const imgContainer = document.createElement('div');
                            imgContainer.className = 'image-container';

                            imgContainer.style.position = 'absolute';
                            imgContainer.style.left = element.position.left + 'px';
                            imgContainer.style.top = element.position.top + 2 + 'px';
                            imgContainer.style.width = (element.position.width + 7) + 'px';
                            imgContainer.style.height = element.position.height + 'px';
                            imgContainer.style.overflow = 'hidden';
                            imgContainer.style.borderRadius = '5px';

                            const img = document.createElement('img');
                            img.className = 'uploaded-image';
                            img.src = imgSrc;

                            img.style.width = '100%';
                            img.style.height = '100%';
                            img.style.objectFit = 'cover';
                            img.style.borderRadius = '5px';

                            imgContainer.appendChild(img);
                            cardDiv.appendChild(imgContainer);
                        }
                    } else if (imageCount === 2) {
                        // For second image, create QR code with student ID
                        const qrCodeUrl = `qrcode.php?text=${student.id}&school_id=${student.school_id}&name=${student.name}&father=${student.father_name}&size=${element.position.width}x${element.position.height}`;

                        const qrContainer = document.createElement('div');
                        qrContainer.className = 'qr-container';

                        qrContainer.style.position = 'absolute';
                        qrContainer.style.left = element.position.left + 'px';
                        qrContainer.style.top = element.position.top + 'px';
                        qrContainer.style.width = (element.position.width + 5) + 'px';
                        qrContainer.style.height = element.position.height + 'px';
                        qrContainer.style.overflow = 'hidden';

                        const qrImg = document.createElement('img');
                        qrImg.className = 'qr-code';
                        qrImg.src = qrCodeUrl;

                        qrImg.style.width = '100%';
                        qrImg.style.height = '100%';
                        qrImg.style.objectFit = 'cover';

                        qrContainer.appendChild(qrImg);
                        cardDiv.appendChild(qrContainer);
                    } else {
                        // For other images (if any)
                        const imgSrc = element.content;

                        const imgContainer = document.createElement('div');
                        imgContainer.className = 'image-container';

                        imgContainer.style.position = 'absolute';
                        imgContainer.style.left = element.position.left + 3 + 'px';
                        imgContainer.style.top = element.position.top + 'px';
                        imgContainer.style.width = element.position.width + 'px';
                        imgContainer.style.height = element.position.height + 'px';
                        imgContainer.style.overflow = 'hidden';
                        imgContainer.style.borderRadius = '5px';

                        const img = document.createElement('img');
                        img.className = 'uploaded-image';
                        img.src = imgSrc;

                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '5px';

                        imgContainer.appendChild(img);
                        cardDiv.appendChild(imgContainer);
                    }
                }
            });

            // Add double click handler
            cardDiv.addEventListener('dblclick', function() {
                this.dataset.selected = this.dataset.selected === 'true' ? 'false' : 'true';
                this.style.opacity = this.dataset.selected === 'true' ? '1' : '0.5';
            });

            return cardDiv;
        }

        function renderStudents(studentsToRender) {
            const container = document.getElementById('allCardsContainer');
            container.innerHTML = '';

            const frontCardsContainer = document.createElement('div');
            frontCardsContainer.className = 'id-card-container';
            frontCardsContainer.id = 'frontCardsContainer';

            const backCardsContainer = document.createElement('div');
            backCardsContainer.className = 'id-card-container';
            backCardsContainer.id = 'backCardsContainer';

            container.appendChild(frontCardsContainer);
            container.appendChild(backCardsContainer);

            studentsToRender.forEach(student => {
                frontCardsContainer.appendChild(createIdCard(student, 'front'));
                backCardsContainer.appendChild(createIdCard(student, 'back'));
            });
        }

        function renderSelectedStudents() {
            const start = parseInt(document.getElementById('startRange').value) || 1;
            const end = parseInt(document.getElementById('endRange').value) || students.length;

            if (start > end) {
                alert('Start range cannot be greater than end range');
                return;
            }

            if (start < 1 || end > students.length) {
                alert(`Please enter range between 1 and ${students.length}`);
                return;
            }

            filteredStudents = students.slice(start - 1, end);
            renderStudents(filteredStudents);
        }




        async function initialize() {
            // Show loading state
            document.getElementById('allCardsContainer').innerHTML = '<div style="text-align:center;padding-top:50px">Loading...</div>';

            // Fetch data
            [students, templateData] = await Promise.all([
                fetchStudentData(),
                fetchTemplateData()
            ]);

            if (students.length === 0 || !templateData) {
                alert("Failed to load required data");
                return;
            }

            // Set default range values
            document.getElementById('startRange').value = 1;
            document.getElementById('endRange').value = students.length;
            document.getElementById('endRange').max = students.length;

            // Render all students initially
            filteredStudents = students;
            renderStudents(filteredStudents);
        }
        // working code of this
        async function downloadAllPDFs(side) {
            // Add this at the beginning of downloadAllPDFs function
            await document.fonts.ready;
            const {
                jsPDF
            } = window.jspdf;
            const cardContainer = document.getElementById(`${side}CardsContainer`);
            let allCards = Array.from(cardContainer.getElementsByClassName('id-card'));

            // Filter only selected cards
            let cards = allCards.filter(card => card.dataset.selected === 'true');

            if (cards.length === 0) {
                alert('No selected cards to download');
                return;
            }

            // Get card dimensions
            const firstCard = cards[0];
            const cardWidthMM = parseFloat(getComputedStyle(firstCard).width) * 0.264583;
            const cardHeightMM = parseFloat(getComputedStyle(firstCard).height) * 0.264583;

            // Define orientation
            let ort = cardHeightMM < cardWidthMM ? "portrait" : "landscape";
            let pageWidth = cardHeightMM < cardWidthMM ? 210 : 297;
            let pageHeight = cardHeightMM < cardWidthMM ? 297 : 210;
            let cols = cardHeightMM < cardWidthMM ? 2 : 5;
            let rows = cardHeightMM < cardWidthMM ? 5 : 2;

            const pdf = new jsPDF(ort, "mm", [pageWidth, pageHeight]);

            const colGap = 3;
            const rowGap = 2;

            const totalWidthUsed = (cols * cardWidthMM) + ((cols - 1) * colGap);
            const totalHeightUsed = (rows * cardHeightMM) + ((rows - 1) * rowGap);

            const startX = (pageWidth - totalWidthUsed) / 2;
            const startY = (pageHeight - totalHeightUsed) / 2;

            let currentPageCards = 0;
            const cardsPerPage = cols * rows;

            for (let i = 0; i < cards.length; i++) {
                if (currentPageCards >= cardsPerPage) {
                    pdf.addPage();
                    currentPageCards = 0;
                }

                let pos;
                if (cardHeightMM < cardWidthMM) {
                    if (side === 'front') {
                        const row = Math.floor(currentPageCards / cols);
                        const col = currentPageCards % cols;
                        pos = {
                            x: startX + col * (cardWidthMM + colGap),
                            y: startY + row * (cardHeightMM + rowGap)
                        };
                    } else {
                        const row = Math.floor(currentPageCards / cols);
                        const col = cols - 1 - (currentPageCards % cols);
                        pos = {
                            x: startX + col * (cardWidthMM + colGap),
                            y: startY + row * (cardHeightMM + rowGap)
                        };
                    }
                } else {
                    if (side === 'front') {
                        const col = Math.floor(currentPageCards / rows);
                        const row = currentPageCards % rows;
                        pos = {
                            x: startX + col * (cardWidthMM + colGap),
                            y: startY + row * (cardHeightMM + rowGap)
                        };
                    } else {
                        const col = Math.floor(currentPageCards / rows);
                        const row = currentPageCards % rows;
                        pos = {
                            x: startX + (cols - 1 - col) * (cardWidthMM + colGap),
                            y: startY + row * (cardHeightMM + rowGap)
                        };
                    }
                }

                const canvas = await html2canvas(cards[i], {
                    scale: 3,
                    backgroundColor: null,
                    useCORS: true,
                    logging: false,
                    letterRendering: true,
                    allowTaint: true
                });

                const imgData = canvas.toDataURL('image/png');
                pdf.addImage(imgData, 'PNG', pos.x, pos.y, cardWidthMM, cardHeightMM);

                currentPageCards++;
            }

            pdf.save(`Selected_${side}_ID_Cards.pdf`);
        }
        // Initialize when page loads
        $(document).ready(initialize);
    </script>

</body>

</html>