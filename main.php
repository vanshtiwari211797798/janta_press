<link rel="stylesheet" href="style/styles.css">
<main>
    <div id="pictures" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button
                type="button"
                data-bs-target="#pictures"
                data-bs-slide-to="0"
                class="active"
                aria-current="true"
                aria-label="Slide 1"></button>
            <button
                type="button"
                data-bs-target="#pictures"
                data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button
                type="button"
                data-bs-target="#pictures"
                data-bs-slide-to="2"
                aria-label="Slide 3"></button>
            <button
                type="button"
                data-bs-target="#pictures"
                data-bs-slide-to="3"
                aria-label="Slide 4"></button>
            <button
                type="button"
                data-bs-target="#pictures"
                data-bs-slide-to="4"
                aria-label="Slide 5"></button>
            <button
                type="button"
                data-bs-target="#pictures"
                data-bs-slide-to="5"
                aria-label="Slide 6"></button>
            <button
                type="button"
                data-bs-target="#pictures"
                data-bs-slide-to="6"
                aria-label="Slide 7"></button>
            <button
                type="button"
                data-bs-target="#pictures"
                data-bs-slide-to="7"
                aria-label="Slide 8"></button>
            <button
                type="button"
                data-bs-target="#pictures"
                data-bs-slide-to="8"
                aria-label="Slide 9"></button>
        </div>
        <div class="carousel-inner">
            <?php
            include("admin/DB.php");
            $sql = "SELECT * FROM banners";
            $data = mysqli_query($conn, $sql);
            $i = 0; // counter

            while ($res = mysqli_fetch_assoc($data)) {
            ?>
                <div class="carousel-item <?php if ($i == 0) {
                                                echo 'active';
                                            } ?>">
                    <img
                        src="superadmin/banner/<?= $res['image'] ?>"
                        class="d-block w-100" />
                </div>
            <?php
                $i++; // increase counter
            }
            ?>
        </div>

        <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#pictures"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#pictures"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div
        class="container-fluid row m-0 row-cols-1 row-cols-md-2 row-cols-lg-3 my-5 py-4 text-light"
        style="background: #038847">
        <div class="col">
            <div
                id="event"
                class="carousel slide carousel-fade p-2 rounded-lg"
                data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button
                        type="button"
                        data-bs-target="#event"
                        data-bs-slide-to="0"
                        class="active"
                        aria-current="true"
                        aria-label="Slide 1"></button>
                    <button
                        type="button"
                        data-bs-target="#event"
                        data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button
                        type="button"
                        data-bs-target="#event"
                        data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/1.jpg" class="d-block w-100" />
                        <div class="carousel-caption">
                            <h4>CLASSROOM</h4>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/2.jpg" class="d-block w-100" />
                        <div class="carousel-caption">
                            <h4>Edutainment</h4>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="img/3.jpg" class="d-block w-100" />
                        <div class="carousel-caption">
                            <h4>PROGRAMS</h4>
                        </div>
                    </div>

                </div>
                <button
                    class="carousel-control-prev"
                    type="button"
                    data-bs-target="#event"
                    data-bs-slide="prev">
                    <span
                        class="carousel-control-prev-icon"
                        aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button
                    class="carousel-control-next"
                    type="button"
                    data-bs-target="#event"
                    data-bs-slide="next">
                    <span
                        class="carousel-control-next-icon"
                        aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col mt-4 mt-md-0">
            <h1>Service Before Self</h1>
            <p style="text-align: justify">
                "At the heart of Kidzee Sonda Deoria, Gorakhpur is the Kidzee learning experience which appreciates and understands the complexity and seriousness of educating children. We seek to develop each child’s unique abilities through a scientifically designed academic programme. Kidzee Sonda Deoria, Gorakhpur offers a unique schooling experience. The school looks after all the academic and physical needs of the children."
            </p>
        </div>
        <div class="col flex-grow-1 activity">
            <div class="row pt-3">
                <div class="col">
                    <h5 class="border-bottom border-light py-1">
                        <a href="activity.php"><img src="png/1.png" class="mr-1" /><span>Art 1st</span>
                        </a>
                    </h5>
                    <h5 class="border-bottom border-light py-1">
                        <a href="activity.php"><img src="png/2.png" class="mr-1" /><span>Book Project</span>
                        </a>
                    </h5>
                    <h5 class="border-bottom border-light py-1">
                        <a href="activity.php"><img src="png/3.png" class="mr-1" /><span>Edutainment</span>
                        </a>
                    </h5>
                    <h5 class="border-bottom border-light py-1">
                        <a href="activity.php"><img src="png/4.png" class="mr-1" /><span>Junoon</span>
                        </a>
                    </h5>
                    <h5 class="border-bottom border-light py-1">
                        <a href="activity.php"><img src="png/5.png" class="mr-1" /><span>Music & Arts</span>
                        </a>
                    </h5>
                </div>
                <div class="col">
                    <h5 class="border-bottom border-light py-1">
                        <a href="activity.php"><img src="png/6.png" class="mr-1" /><span>Co-curricular</span>
                        </a>
                    </h5>
                    <h5 class="border-bottom border-light py-1">
                        <a href="activity.php"><img src="png/7.png" class="mr-1" /><span>Olympiad</span>
                        </a>
                    </h5>
                    <h5 class="border-bottom border-light py-1">
                        <a href="activity.php"><img src="png/8.png" class="mr-1" /><span>Sports</span>
                        </a>
                    </h5>
                    <h5 class="border-bottom border-light py-1">
                        <a href="activity.php"><img src="png/9.png" class="mr-1" /><span>Online Quiz</span>
                        </a>
                    </h5>
                    <h5 class="border-bottom border-light py-2">
                        <a href="activity.php"><i class="fas fa-info-circle fs-4"></i><span class="ps-2">Show details</span>
                        </a>
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-center my-5">
        <h1>Features</h1>
        <div class="row">
            <!-- <div class="col-lg">
                    <a href="" class="card bg-success text-white p-1 my-3">
                        <img src="https://scontent.flko10-1.fna.fbcdn.net/v/t39.30808-6/457877352_910730917741583_7798493551021491494_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=833d8c&_nc_ohc=bM6NVyOT52sQ7kNvgHkcnWy&_nc_zt=23&_nc_ht=scontent.flko10-1.fna&_nc_gid=AYj9XW7lkZ-HWqIMNr63Hgr&oh=00_AYAZTLlkCFbE__9n5ZoigxieaQ4To9U1Y2kL5lAp3Bflvg&oe=678FDF8C" class="card-img" style="height: 50%; width: 100%; object-fit: cover;" />
                        <div class="card-img-overlay">
                            <h4 class="py-2 card-title btn-title">Practical Labs</h4>
                        </div>
                    </a>
                </div> -->
            <div class="col-lg">
                <a
                    href="infrastructure.php"
                    class="card bg-success text-white p-1 my-3">
                    <img src="img/1.jpg" class="card-img" />
                    <div class="card-img-overlay">
                        <h4 class="py-2 card-title btn-title">Infrastructure</h4>
                    </div>
                </a>
            </div>
            <div class="col-lg">
                <a href="" class="card bg-success text-white p-1 my-3">
                    <img src="img/2.jpg" class="card-img" />
                    <div class="card-img-overlay">
                        <h4 class="py-2 card-title btn-title">Investiture Ceremony</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid my-5 px-5">
        <div class="row">
            <div class="col-md-3 text-center px-5 px-md-0 mb-4 mb-md-0">
                <img
                    src="https://scontent.flko10-1.fna.fbcdn.net/v/t39.30808-6/455341244_898079135673428_7790023149913625657_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=833d8c&_nc_ohc=G2D4Xac9E8kQ7kNvgGtiJ1p&_nc_zt=23&_nc_ht=scontent.flko10-1.fna&_nc_gid=AUvaXEsW2dOTH2xeNkGYXp7&oh=00_AYAatU99lI9z0myxbm1twzWrvjS3VeQ4CvXlXh22O4NOow&oe=678FCE60"
                    class="img-thumbnail"
                    style="width: 90%; aspect-ratio: 671 / 550" />
            </div>
            <div class="col-md mr-4">
                <h1 class="text-center">Testimonials</h1>
                <p style="text-align: justify" class="px-5 my-5">
                    "The secret of change is to focus all of your energy, not on
                    fighting the old, but on building the new." — Socrates. Keeping
                    pace with the fast changing world is a new challenge. Besides the
                    three R’s – Reading, Writing & Arithmetic, 21st century skills -
                    the 4 C’s - Creativity, Critical thinking, Communication, and
                    Collaboration have become necessary. The world around us is
                    changing at a very fast pace, creating disruptive changes and
                    making things obsolete.
                </p>

            </div>
        </div>
    </div>
</main>