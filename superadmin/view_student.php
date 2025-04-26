<?php
include("config/db.php");
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
    <title>Tables</title>

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
                                <i class="fas fa-table"></i>View School</a>
                        </li>
                        <li>
                            <a href="add_banner.php">
                                <i class="fas fa-table"></i>Add Banner</a>
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
                        <li class="has-sub">
                            <a class="js-arrow" href="index.php">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>

                        </li>
                        <li class="active">
                            <a href="view_school.php">
                                <i class="fas fa-table"></i>View School</a>
                        </li>
                        <li>
                            <a href="add_banner.php">
                                <i class="fas fa-table"></i>Add Banner</a>
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
                            <form class="form-header" action="" method="POST">
                                <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for school id" />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">Janta S.Press</a>
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
                                                        <a href="#">Janta S.Press</a>
                                                    </h5>
                                                    <!-- <span class="email">johndoe@example.com</span> -->
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
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
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row m-t-30">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>School'd</th>
                                                <th>School Name</th>
                                                <th>Name</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Gender</th>
                                                <th>Roll Number</th>
                                                <th>Father name</th>
                                                <th>Contact</th>
                                                <th>Address</th>
                                                <th>Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "
                                            SELECT 
                                                students.id,
                                                students.school_id,
                                                students.photo,
                                                students.name,
                                                students.class,
                                                students.section,
                                                students.gender,
                                                students.roll_number,
                                                students.father_name,
                                                students.father_contact,
                                                students.address,
                                                add_school.school_name
                                            FROM 
                                                students
                                            LEFT JOIN 
                                                add_school 
                                            ON 
                                                students.school_id = add_school.school_id
                                            ";

                                            $data = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($data) > 0) {
                                                while ($res = mysqli_fetch_assoc($data)) {
                                            ?>
                                                    <tr>
                                                        <td><img src="../admin/Students_photo/<?= $res['photo'] ?>" height="80px" width="80px" alt="student photo"></td>
                                                        <td><?= $res['school_id'] ?></td>
                                                        <td><?= isset($res['school_name']) ? $res['school_name'] : 'N/A' ?></td>
                                                        <td><?= $res['name'] ?></td>
                                                        <td><?= $res['class'] ?></td>
                                                        <td><?= $res['section'] ?></td>
                                                        <td><?= $res['gender'] ?></td>
                                                        <td><?= $res['roll_number'] ?></td>
                                                        <td><?= $res['father_name'] ?></td>
                                                        <td><?= $res['father_contact'] ?></td>
                                                        <td><?= $res['address'] ?></td>
                                                        <td><a href="delete_student.php?id=<?= $res['id'] ?>" style="color: red;">Delete</a></td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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