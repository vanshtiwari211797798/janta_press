<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>ID Card Designer (Staff)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 20px;
            margin: 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 24px;
            color: #333;
        }

        .toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
            margin-bottom: 30px;
            justify-content: center;
        }

        .toolbar input,
        .toolbar select,
        .toolbar button {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            min-width: 180px;
        }

        .toolbar input[type="color"] {
            padding: 0;
            width: 50px;
        }

        .toolbar button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }

        .toolbar button:hover {
            background-color: #388e3c;
        }

        .toolbar label {
            font-weight: 500;
            margin-right: 6px;
        }

        .idCard-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .idCard-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .idCard-title {
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        #idCardFront,
        #idCardBack {
            width: 320px;
            height: 200px;
            border: 2px solid #333;
            position: relative;
            background-size: cover;
            background-position: center;
            background-color: white;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .draggable {
            cursor: move;
            position: absolute;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 14px;
            z-index: 100;
            min-width: 30px;
        }

        .image-container {
            position: absolute;
            z-index: 90;
            background-color: rgba(255, 255, 255, 0.5);
            overflow: hidden;
        }

        .uploaded-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            pointer-events: none;
        }

        .ui-resizable-handle {
            width: 10px;
            height: 10px;
            background: #4CAF50;
            border: 1px solid #fff;
            z-index: 91;
        }

        .ui-resizable-se {
            right: 0;
            bottom: 0;
        }

        .tab-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tab-button {
            padding: 10px 20px;
            background-color: #f1f1f1;
            border: none;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .tab-button.active {
            background-color: #4CAF50;
            color: white;
        }

        .text-element {
            white-space: nowrap;
            display: flex;
        }

        .align-left {
            justify-content: flex-start;
            text-align: left;
        }

        .align-center {
            justify-content: center;
            text-align: center;
        }

        .align-right {
            justify-content: flex-end;
            text-align: right;
        }


        .tab-button:first-child {
            border-radius: 6px 0 0 6px;
        }

        .tab-button:last-child {
            border-radius: 0 6px 6px 0;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        @media (max-width: 600px) {

            #idCardFront,
            #idCardBack {
                width: 90%;
                aspect-ratio: 85 / 54;
            }

            .toolbar input,
            .toolbar select,
            .toolbar button {
                min-width: 100%;
            }
        }
    </style>
</head>

<body>
    <h2>ID Card Designer (Staff)</h2>

    <div class="tab-buttons">
        <button class="tab-button active" onclick="openTab('front')">Front Side</button>
        <button class="tab-button" onclick="openTab('back')">Back Side</button>
    </div>

    <div id="front-tab" class="tab-content active">
        <div class="toolbar" id="front-toolbar">
            <select name="" id="textInputFront">
                <option value="">Select Value</option>
                <option value="school_id">School Id</option>
                <option value="emp_name">Name</option>
                <option value="husband_or_father">Father/Husbend Name</option>
                <option value="gender">Gender</option>
                <option value="rfid">RFID</option>
                <option value="roll_number">Roll Number</option>
                <option value="citizenship_number">Citizenship Number</option>
                <option value="contact">Mobile/Phone</option>
                <option value="address">Address</option>
                <option value="designation">Designation</option>
                <option value="category">Category</option>
                <option value="blood_grp">Blood Group</option>
                <option value="dob">DOB</option>
                <option value="pan_number">Pan Number</option>
                <option value="shaatrall_number">Shaatrall Number</option>
                <option value="emp_n_name">Name (Nepali)</option>
                <option value="gender_n">Gender (Nepali)</option>
                <option value="husbend_father_n">Father/Husbend (Nepali)</option>
                <option value="contact_n">Contact (Nepali)</option>
                <option value="address_n">Address (Nepali)</option>
                <option value="desiginition_n">Desiginition (Nepali)</option>
                <option value="citizenship_number_n">Citizenship Number (Nepali)</option>
                <option value="shaatrall_number_n">Shaatrall Number (Nepali)</option>
                <option value="pan_number_n">Pan Number (Nepali)</option>
            </select>
            <button onclick="addTextToCard('front')">Add Text</button>

            <label>Font Size:</label>
            <input type="number" id="fontSizeFront" value="16" min="10" max="50" />

            <label>Font Color:</label>
            <input type="color" id="fontColorFront" value="#000000" />

            <label>Font Family:</label>
            <select id="fontFamilyFront">
                <option value="Arial, sans-serif">Arial (English)</option>
                <option value="Preeti">Preeti (Nepali)</option>
                <option value="Kantipur">Kantipur (Nepali)</option>
                <option value="Sagarmatha">Sagarmatha (Nepali)</option>
                <option value="Mangal, sans-serif">Mangal (Hindi)</option>
            </select>

            <label><input type="checkbox" id="boldFront" /> Bold</label>
            <label><input type="checkbox" id="italicFront" /> Italic</label>
            <label>Text Alignment:</label>
            <select id="textAlignFront">
                <option value="">Select Allignment</option>
                <!-- <option value="left">Left</option> -->
                <option value="center">Center</option>
                <!-- <option value="right">Right</option> -->
            </select>
            <label>Upload Image:</label>
            <input type="file" id="imageUploadFront" accept="image/*" />

            <label>Upload Background:</label>
            <input type="file" id="templateUploadFront" accept="image/*" />
        </div>

        <div class="idCard-wrapper">
            <div class="idCard-title">Front Side</div>
            <div id="idCardFront"></div>
        </div>
    </div>

    <div id="back-tab" class="tab-content">
        <div class="toolbar" id="back-toolbar">
            <select name="" id="textInputBack">
                <option value="">Select Value</option>
                <option value="school_id">School Id</option>
                <option value="emp_name">Name</option>
                <option value="husband_or_father">Father/Husbend Name</option>
                <option value="gender">Gender</option>
                <option value="rfid">RFID</option>
                <option value="roll_number">Roll Number</option>
                <option value="citizenship_number">Citizenship Number</option>
                <option value="contact">Mobile/Phone</option>
                <option value="address">Address</option>
                <option value="designation">Designation</option>
                <option value="category">Category</option>
                <option value="blood_grp">Blood Group</option>
                <option value="dob">DOB</option>
                <option value="pan_number">Pan Number</option>
                <option value="shaatrall_number">Shaatrall Number</option>
                <option value="emp_n_name">Name (Nepali)</option>
                <option value="gender_n">Gender (Nepali)</option>
                <option value="husbend_father_n">Father/Husbend (Nepali)</option>
                <option value="contact_n">Contact (Nepali)</option>
                <option value="address_n">Address (Nepali)</option>
                <option value="desiginition_n">Desiginition (Nepali)</option>
                <option value="citizenship_number_n">Citizenship Number (Nepali)</option>
                <option value="shaatrall_number_n">Shaatrall Number (Nepali)</option>
                <option value="pan_number_n">Pan Number (Nepali)</option>
            </select>
            <button onclick="addTextToCard('back')">Add Text</button>

            <label>Font Size:</label>
            <input type="number" id="fontSizeBack" value="16" min="10" max="50" />

            <label>Font Color:</label>
            <input type="color" id="fontColorBack" value="#000000" />

            <label>Font Family:</label>
            <select id="fontFamilyBack">
                <option value="Arial, sans-serif">Arial (English)</option>
                <option value="Preeti">Preeti (Nepali)</option>
                <option value="Kantipur">Kantipur (Nepali)</option>
                <option value="Sagarmatha">Sagarmatha (Nepali)</option>
                <option value="Mangal, sans-serif">Mangal (Hindi)</option>
            </select>

            <label><input type="checkbox" id="boldBack" /> Bold</label>
            <label><input type="checkbox" id="italicBack" /> Italic</label>
            <label>Text Alignment:</label>
            <select id="textAlignBack">
                <option value="">Select Allignment</option>
                <!-- <option value="left">Left</option> -->
                <option value="center">Center</option>
                <!-- <option value="right">Right</option> -->
            </select>

            <label>Upload Image:</label>
            <input type="file" id="imageUploadBack" accept="image/*" />

            <label>Upload Background:</label>
            <input type="file" id="templateUploadBack" accept="image/*" />
        </div>

        <div class="idCard-wrapper">
            <div class="idCard-title">Back Side</div>
            <div id="idCardBack"></div>
        </div>
    </div>

    <div class="toolbar">
        <label>Width (mm):</label>
        <input type="number" id="cardWidthMm" value="86" />

        <label>Height (mm):</label>
        <input type="number" id="cardHeightMm" value="54" />

        <button onclick="resizeCard()">Set Size</button>
        <button onclick="previewTemplate()">Preview</button>

        <label><input type="checkbox" id="lockAspect" checked /> Lock Aspect Ratio</label>

        <label>School ID:</label>
        <input type="number" id="schoolId" placeholder="School ID" required />

        <button onclick="saveTemplate()">Save Template</button>
    </div>

    <script>
        // Track elements separately for front and back
        const cardElements = {
            front: {
                counter: 0,
                nextPosition: 20
            },
            back: {
                counter: 0,
                nextPosition: 20
            }
        };

        const mmToPx = mm => mm * 3.78;
        let currentTab = 'front';

        function openTab(tabName) {
            currentTab = tabName;
            document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-button').forEach(button => button.classList.remove('active'));
            document.getElementById(tabName + '-tab').classList.add('active');
            event.currentTarget.classList.add('active');
        }

        function addTextToCard(side) {
            const prefix = side === 'front' ? 'Front' : 'Back';
            const counter = ++cardElements[side].counter;
            const inputText = $(`#textInput${prefix}`).val();
            const fontSize = $(`#fontSize${prefix}`).val();
            const fontColor = $(`#fontColor${prefix}`).val();
            const fontFamily = $(`#fontFamily${prefix}`).val();
            const isBold = $(`#bold${prefix}`).is(':checked') ? 'bold' : 'normal';
            const isItalic = $(`#italic${prefix}`).is(':checked') ? 'italic' : 'normal';
            const textAlign = $(`#textAlign${prefix}`).val();

            if (!inputText) return;

            const newText = $(`<div class="draggable text-element align-${textAlign}"
                id="text_${side}_${counter}"
                style="font-size: ${fontSize}px;
                       color: ${fontColor};
                       font-family: ${fontFamily};
                       font-weight: ${isBold};
                       font-style: ${isItalic};
                       position: absolute;
                       padding: 2px;">
                ${inputText}
            </div>`);

            $(`#idCard${prefix}`).append(newText);

            // Calculate text width
            const tempSpan = $('<span>').text(inputText).css({
                'font-family': fontFamily,
                'font-size': fontSize + 'px',
                'font-weight': isBold,
                'font-style': isItalic,
                'visibility': 'hidden',
                'white-space': 'nowrap'
            }).appendTo('body');

            const textWidth = tempSpan.outerWidth() + 4;
            const textHeight = tempSpan.outerHeight() + 4;
            tempSpan.remove();

            // Set position based on alignment
            let leftPosition = 20;
            const cardWidth = parseFloat($(`#idCard${prefix}`).width());

            if (textAlign === 'center') {
                leftPosition = Math.max(0, (cardWidth - textWidth) / 2);
            }

            newText.css({
                top: 20 + 'px',
                left: leftPosition + 'px',
                width: textWidth + 'px',
                height: textHeight + 'px'
            });

            // Make draggable and resizable
            makeElementDraggableResizable(newText, side);

            // Add double-click to delete
            newText.on('dblclick', function() {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).remove();
                }
            });
        }

        function makeElementDraggableResizable(element, side) {
            const prefix = side === 'front' ? 'Front' : 'Back';
            const container = $(`#idCard${prefix}`);

            element.draggable({
                containment: container,
                stop: function() {
                    $(this).css({
                        width: $(this).outerWidth() + 'px',
                        height: $(this).outerHeight() + 'px'
                    });
                }
            })
        }

        function resizeCard() {
            const widthMm = parseFloat($('#cardWidthMm').val());
            const heightMm = parseFloat($('#cardHeightMm').val());
            const widthPx = mmToPx(widthMm);
            const heightPx = mmToPx(heightMm);

            $('#idCardFront, #idCardBack').css({
                width: widthPx + 'px',
                height: heightPx + 'px'
            });
        }

        function setupImageUpload(side) {
            const prefix = side === 'front' ? 'Front' : 'Back';

            $(`#templateUpload${prefix}`).off('change').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $(`#idCard${prefix}`).css('background-image', `url(${e.target.result})`);
                    };
                    reader.readAsDataURL(file);
                }
            });

            $(`#imageUpload${prefix}`).off('change').on('change', function() {
                const file = this.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.src = e.target.result;

                    img.onload = function() {
                        const aspectRatio = img.width / img.height;
                        const card = $(`#idCard${prefix}`);
                        const cardWidth = parseFloat(card.width());
                        const cardHeight = parseFloat(card.height());
                        const initialWidth = Math.min(100, cardWidth * 0.3);
                        const initialHeight = initialWidth / aspectRatio;

                        // Calculate initial position (center of card)
                        const initialTop = (cardHeight - initialHeight) / 2;
                        const initialLeft = (cardWidth - initialWidth) / 2;

                        const imageContainer = $(`<div class="image-container" data-side="${side}"></div>`)
                            .css({
                                position: 'absolute',
                                top: initialTop + 'px',
                                left: initialLeft + 'px',
                                width: initialWidth + 'px',
                                height: initialHeight + 'px',
                                overflow: 'hidden',
                                'min-width': '20px',
                                'min-height': '20px',
                                'z-index': '10'
                            });

                        const image = $(`<img class="uploaded-image" src="${e.target.result}">`)
                            .css({
                                width: '100%',
                                height: '100%',
                                objectFit: 'cover'
                            });

                        imageContainer.append(image);
                        card.append(imageContainer);

                        imageContainer.resizable({
                            handles: 'n, e, s, w, ne, se, sw, nw',
                            aspectRatio: $('#lockAspect').is(':checked') ? aspectRatio : false,
                            minWidth: 20,
                            minHeight: 20,
                            containment: `#idCard${prefix}`,
                            resize: function(event, ui) {
                                $(this).attr('data-width', ui.size.width);
                                $(this).attr('data-height', ui.size.height);
                            }
                        });

                        imageContainer.draggable({
                            containment: `#idCard${prefix}`,
                            cursor: 'move',
                            stack: '.image-container',
                            zIndex: 100,
                            scroll: false
                        });

                        imageContainer.on('dblclick', function() {
                            if (confirm('Are you sure you want to delete this image?')) {
                                $(this).remove();
                            }
                        });

                        $('#lockAspect').off('change').on('change', function() {
                            imageContainer.resizable("option", "aspectRatio",
                                $(this).is(':checked') ? aspectRatio : false);
                        });

                        // Style resize handles
                        imageContainer.find('.ui-resizable-handle').css({
                            'background-color': '#4CAF50',
                            'border': '1px solid #fff',
                            'width': '10px',
                            'height': '10px'
                        });
                    };
                };
                reader.readAsDataURL(file);
            });
        }

        function saveTemplate() {
            const schoolId = $('#schoolId').val();
            if (!schoolId) {
                alert('Please enter School ID');
                return;
            }

            const processSide = (side) => {
                const container = $(`#idCard${side === 'front' ? 'Front' : 'Back'}`);
                const bgImage = container.css('background-image');

                const elements = [];
                container.children().each(function() {
                    const $el = $(this);
                    const isText = $el.hasClass('text-element');

                    const position = {
                        left: parseFloat($el.css('left')) || 0,
                        top: parseFloat($el.css('top')) || 0,
                        width: $el.outerWidth(),
                        height: $el.outerHeight()
                    };

                    const element = {
                        type: isText ? 'text' : 'image',
                        content: isText ? $el.text().trim() : $el.find('img').attr('src'),
                        position: position
                    };

                    if (isText) {
                        element.styles = {
                            'font-family': $el.css('font-family'),
                            'font-size': $el.css('font-size'),
                            'color': $el.css('color'),
                            'font-weight': $el.css('font-weight'),
                            'font-style': $el.css('font-style'),
                            'text-align': $el.hasClass('align-left') ? 'left' : $el.hasClass('align-center') ? 'center' : ''
                        };
                    }

                    elements.push(element);
                });

                return {
                    background: bgImage === 'none' ? 'none' : bgImage,
                    elements: elements
                };
            };

            const templateData = {
                school_id: schoolId,
                width: $('#cardWidthMm').val(),
                height: $('#cardHeightMm').val(),
                front: processSide('front'),
                back: processSide('back')
            };

            console.log('Template Data to Save:', JSON.stringify(templateData, null, 2));

            $.ajax({
                url: 'save_template_emp.php',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    school_id: schoolId,
                    template_data: templateData
                }),
                success: function(response) {
                    console.log("Response:", response);
                    if (response.status === 'success') {
                        alert('Template saved successfully!');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                    alert('Error saving template. Check console for details.');
                }
            });
        }

        function previewTemplate() {
            const schoolId = $('#schoolId').val();
            if (!schoolId) {
                alert('Please enter School ID');
                return;
            }

            // Clear current elements
            $('#idCardFront').empty().css('background-image', 'none');
            $('#idCardBack').empty().css('background-image', 'none');

            // Load the template
            $.getJSON(`get-idcard.php?id=${schoolId}`, function(data) {
                if (data) {
                    // Set card dimensions
                    $('#cardWidthMm').val(data.width);
                    $('#cardHeightMm').val(data.height);
                    resizeCard();

                    // Load both sides
                    ['front', 'back'].forEach(side => {
                        const sideData = data[side];
                        const container = $(`#idCard${side === 'front' ? 'Front' : 'Back'}`);

                        // Set background
                        if (sideData.background && sideData.background !== 'none') {
                            // Ensure the background URL is properly formatted
                            let bgUrl = sideData.background;
                            if (!bgUrl.startsWith('url(')) {
                                bgUrl = `url(${bgUrl})`;
                            }
                            container.css('background-image', bgUrl);
                        }

                        // Add elements
                        if (sideData.elements && sideData.elements.length > 0) {
                            sideData.elements.forEach(element => {
                                if (element.type === 'text') {
                                    const textEl = $(`<div class="draggable text-element align-${element.styles['text-align'] || 'left'}">${element.content}</div>`)
                                        .css(element.styles)
                                        .css({
                                            position: 'absolute',
                                            left: element.position.left + 'px',
                                            top: element.position.top + 'px',
                                            width: element.position.width + 'px',
                                            height: element.position.height + 'px',
                                            padding: '2px'
                                        });

                                    container.append(textEl);
                                    makeElementDraggableResizable(textEl, side);

                                    textEl.on('dblclick', function() {
                                        if (confirm('Are you sure you want to delete this element?')) {
                                            $(this).remove();
                                        }
                                    });

                                } else if (element.type === 'image') {
                                    // Create image container
                                    const imgContainer = $(`<div class="image-container" data-side="${side}"></div>`)
                                        .css({
                                            position: 'absolute',
                                            left: element.position.left + 'px',
                                            top: element.position.top + 'px',
                                            width: element.position.width + 'px',
                                            height: element.position.height + 'px',
                                            overflow: 'hidden'
                                        });

                                    // Create the image element
                                    const img = new Image();
                                    img.onload = function() {
                                        const imgElement = $(`<img class="uploaded-image">`)
                                            .attr('src', element.content);
                                        imgContainer.append(imgElement);
                                    };
                                    img.src = element.content;

                                    container.append(imgContainer);
                                    makeElementDraggableResizable(imgContainer, side);

                                    imgContainer.on('dblclick', function() {
                                        if (confirm('Are you sure you want to delete this image?')) {
                                            $(this).remove();
                                        }
                                    });
                                }
                            });
                        }
                    });
                    alert('Template loaded successfully! You can now edit it.');
                } else {
                    alert('No template found for this School ID');
                }
            }).fail(function() {
                alert('Error loading template. Please check the School ID and try again.');
            });
        }

        // Load template if ID is present in URL
        function loadTemplate() {
            const urlParams = new URLSearchParams(window.location.search);
            const templateId = urlParams.get('id');

            if (templateId) {
                $.getJSON(`get-idcard.php?id=${templateId}`, function(data) {
                    if (data) {
                        // Set school ID
                        $('#schoolId').val(data.school_id);

                        // Set card dimensions
                        $('#cardWidthMm').val(data.width);
                        $('#cardHeightMm').val(data.height);
                        resizeCard();

                        // Load both sides
                        ['front', 'back'].forEach(side => {
                            const sideData = data[side];
                            const container = $(`#idCard${side === 'front' ? 'Front' : 'Back'}`);

                            // Clear existing elements
                            container.empty();

                            // Set background
                            if (sideData.background && sideData.background !== 'none') {
                                container.css('background-image', sideData.background);
                            }

                            // Add elements
                            if (sideData.elements && sideData.elements.length > 0) {
                                sideData.elements.forEach(element => {
                                    if (element.type === 'text') {
                                        const textEl = $(`<div class="draggable text-element">${element.content}</div>`)
                                            .css(element.styles)
                                            .css({
                                                position: 'absolute',
                                                left: element.position.left + 'px',
                                                top: element.position.top + 'px',
                                                width: element.position.width + 'px',
                                                height: element.position.height + 'px',
                                                padding: '2px'
                                            });

                                        container.append(textEl);
                                        makeElementDraggableResizable(textEl, side);

                                        // Add double-click to delete
                                        textEl.on('dblclick', function() {
                                            if (confirm('Are you sure you want to delete this element?')) {
                                                $(this).remove();
                                            }
                                        });

                                    } else if (element.type === 'image') {
                                        const imgContainer = $(`<div class="image-container" data-side="${side}"></div>`)
                                            .css({
                                                position: 'absolute',
                                                left: element.position.left + 'px',
                                                top: element.position.top + 'px',
                                                width: element.position.width + 'px',
                                                height: element.position.height + 'px',
                                                overflow: 'hidden'
                                            });

                                        const img = $(`<img class="uploaded-image" src="${element.content}">`);
                                        imgContainer.append(img);
                                        container.append(imgContainer);

                                        makeElementDraggableResizable(imgContainer, side);

                                        // Add double-click to delete
                                        imgContainer.on('dblclick', function() {
                                            if (confirm('Are you sure you want to delete this image?')) {
                                                $(this).remove();
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                }).fail(function() {
                    console.error("Failed to load template");
                });
            }
        }

        $(document).ready(function() {
            setupImageUpload('front');
            setupImageUpload('back');
            resizeCard();
            loadTemplate();
        });
    </script>
</body>

</html>