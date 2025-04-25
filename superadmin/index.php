<!-- php code here -->
<?php
session_start();
include("config/db.php");
if (!isset($_SESSION['adminemail'])) {
    header('Location:login.php');
}


// registered user
$fetchTotalStudents = "SELECT * FROM students";
$studentData = mysqli_query($conn, $fetchTotalStudents);

// registered users
$fetchSchools = "SELECT * FROM add_school";
$schoolsData = mysqli_query($conn, $fetchSchools);

// registered employee
$fetchEmployee = "SELECT * FROM employee";
$employeeData = mysqli_query($conn, $fetchEmployee);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <h2>JANTA PRESS</h2>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                        </li>

                        <li>
                            <a href="view_school.php">
                                <i class="fas fa-table"></i>View Schools</a>
                        </li>
                        <li>
                            <a href="view_student.php">
                                <i class="far fa-check-square"></i>View Student</a>
                        </li>
                        <li>
                            <a href="generate_id_card.php">
                                <i class="far fa-check-square"></i>Generate School Id</a>
                        </li>
                        <li>
                            <a href="generate_emp_id.php">
                                <i class="far fa-check-square"></i>Generate Employee Id</a>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <h2>JANTA PRESS</h2>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="view_school.php">
                                <i class="fas fa-table"></i>View Schools</a>
                        </li>
                        <li>
                            <a href="view_student.php">
                                <i class="far fa-check-square"></i>View Student</a>
                        </li>
                        <li>
                            <a href="generate_id_card.php">
                                <i class="far fa-check-square"></i>Generate School Id</a>
                        </li>
                        <li>
                            <a href="generate_emp_id.php">
                                <i class="far fa-check-square"></i>Generate Employee Id</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-button">
                                <div class="noti-wrap">
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content ">
                                            <a class="js-acc-btn" href="#">john doe</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">john doe</a>
                                                    </h5>
                                                    <span class="email">johndoe@example.com</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="#">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div style="padding: 10px; background-color: #f7f7f7; border-bottom: 1px solid #ddd; margin-bottom: 20px;">
                    <label for="schoolIdInput" style="margin-right: 10px; font-weight: bold;">School ID (Students):</label>
                    <input type="text" id="schoolIdInput" placeholder="Enter Student School ID" style="padding: 5px; border: 1px solid #ccc; border-radius: 3px; margin-right: 20px;">

                    <label for="classSelect" style="margin-right: 10px; font-weight: bold;">Class:</label>
                    <select id="classSelect" style="padding: 5px; border: 1px solid #ccc; border-radius: 3px; margin-right: 20px;">
                        <option value="" selected>Select Class</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>

                    <label for="sectionSelect" style="margin-right: 10px; font-weight: bold;">Section:</label>
                    <select id="sectionSelect" style="padding: 5px; border: 1px solid #ccc; border-radius: 3px; margin-right: 20px;">
                        <option value="" selected>Select Section</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>
                    </select>

                    <button onclick="submitForm()" style="padding: 7px 15px; border: none; border-radius: 3px; background-color: #007bff; color: white; font-weight: bold; cursor: pointer;">
                        Submit
                    </button>
                </div>

                <!-- Staff id card search -->
                <div style="padding: 10px; background-color: #f7f7f7; border-bottom: 1px solid #ddd; margin-bottom: 20px;">
                    <label for="schoolIdInput" style="margin-right: 10px; font-weight: bold;">School ID (Staff):</label>
                    <input type="text" id="schoolIdInputEmp" placeholder="Enter Staff School ID" style="padding: 5px; border: 1px solid #ccc; border-radius: 3px; margin-right: 20px;">

                    <button onclick="submitFormEmp()" style="padding: 7px 15px; border: none; border-radius: 3px; background-color: #007bff; color: white; font-weight: bold; cursor: pointer;">
                        Submit
                    </button>
                </div>
                <div style="padding: 10px; background-color: #f7f7f7; border-bottom: 1px solid #ddd; margin-bottom: 20px;">
                    <label for="schoolIdInput" style="margin-right: 10px; font-weight: bold;">Delete Templete (Student):</label>
                    <input type="text" id="schoolIdStdDel" placeholder="Enter School ID" style="padding: 5px; border: 1px solid #ccc; border-radius: 3px; margin-right: 20px;">

                    <button onclick="deleteStdTemplete()" id style="padding: 7px 15px; border: none; border-radius: 3px; background-color: #007bff; color: white; font-weight: bold; cursor: pointer;">
                        Delete
                    </button>
                </div>
                <div style="padding: 10px; background-color: #f7f7f7; border-bottom: 1px solid #ddd; margin-bottom: 20px;">
                    <label for="schoolIdInput" style="margin-right: 10px; font-weight: bold;">Delete Templete (Staff):</label>
                    <input type="text" id="schoolIdEmpDel" placeholder="Enter School ID" style="padding: 5px; border: 1px solid #ccc; border-radius: 3px; margin-right: 20px;">

                    <button onclick="deleteEmpTemplete()" style="padding: 7px 15px; border: none; border-radius: 3px; background-color: #007bff; color: white; font-weight: bold; cursor: pointer;">
                        Delete
                    </button>
                </div>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                    <button class="au-btn au-btn-icon au-btn--blue">
                                        <i class="zmdi zmdi-plus"></i><a href="add_school.php" style="color: #fff;">add school</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= mysqli_num_rows($studentData) ?></h2>
                                                <span>total registered Students</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart1"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-shopping-cart"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= mysqli_num_rows($schoolsData) ?></h2>
                                                <span>total registered School</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2><?= mysqli_num_rows($employeeData) ?></h2>
                                                <span>total registered employee</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            <canvas id="widgetChart4"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function submitForm() {
                    const schoolId = document.getElementById("schoolIdInput").value;
                    const selectedClass = document.getElementById("classSelect").value;
                    const selectedSection = document.getElementById("sectionSelect").value;

                    window.location.href = `show_id.php?school_id=${schoolId}&class=${selectedClass}&section=${selectedSection}`;
                }

                function submitFormEmp() {
                    const schoolId = document.getElementById("schoolIdInputEmp").value;

                    window.location.href = `show_emp_id.php?school_id=${schoolId}`;
                }

                function deleteStdTemplete() {
                    const schoolId = document.getElementById("schoolIdStdDel").value;

                    window.location.href = `deleteStdTemp.php?school_id=${schoolId}`;
                }

                function deleteEmpTemplete() {
                    const schoolId = document.getElementById("schoolIdEmpDel").value;

                    window.location.href = `deleteEmpTemp.php?school_id=${schoolId}`;
                }
            </script>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
<!-- end document-->