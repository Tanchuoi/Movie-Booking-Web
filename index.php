<?php include 'connect.php'; ?>
<?php
//Need this for the send email function 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
?>

<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <title>NitFlex</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <!-- CSS -->
    <link rel="stylesheet" href="index.css">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/7b511d7d97.js" crossorigin="anonymous"></script>
    <!-- Bootstrap Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <!-- Javascript -->
    <script src="index.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-black fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand px-5 text-white " href="."> <i class="fa-solid fa-clapperboard"
                        style="color: var(--main-color); margin-right: 12px;"></i>NitFlex</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end bg-black " tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title text-white " id="offcanvasNavbarLabel">
                            What's on NitFlex
                        </h5>
                        <button type="button" class="btn-close text-reset bg-white " data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                            <li class="nav-item px-5">
                                <a class="nav-link text-white " aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item px-5">
                                <a class="nav-link text-white " href="#jumpToMovies">Movies</a>
                            </li>
                            <li class="nav-item px-5">
                                <a class="nav-link text-white " href="#jumpToUpcomming">Upcoming</a>
                            </li>
                            <li class="nav-item px-5">
                                <a class="nav-link text-white" href="./login.php">
                                    <i class="fa-regular fa-user"></i>
                                </a>
                            </li>

                            <li class="nav-item px-5">
                                <a class="nav-link text-white" href="./logout.php">
                                    <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>
                                </a>
                            </li>

                            <?php
                            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                                echo "<li class='nav-item px-5'>
                                        <a class='nav-link text-white' href='./admin/dashboard.php'>
                                        <i class='fa-solid fa-house-user' style='color: #ffffff;'></i>
                                        </a>
                                    </li>";
                            }
                            ?>
                            <?php
                            if (isset($_SESSION['username'])) {
                                echo "<li class='nav-item px-5'>
                                        <a class='nav-link text-white '>
                                             <i> <b> " . $_SESSION['username'] . " </b> </i>
                                        </a>
                                    </li>";
                            } else {
                                echo "<li class='nav-item px-5 ms-5'>
                                        <a class='nav-link text-white' >
                                             <i> <b> Guest </b> </i>
                                        </a>
                                    </li>";
                            }
                            ?>
                        </ul>

                    </div>
                </div>
            </div>
        </nav>

    </header>
    <main>
        <div id="slider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#slider" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#slider" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/images/home1.jpg" class="d-block w-100" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Marvel Universe</h5>
                        <p>Venom: Let There Be Carnage</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/home2.jpg" class="d-block w-100" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Marvel Universe</h5>
                        <p>Avengers: Infinity War</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/images/home3.jpg" class="d-block w-100" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Marvel Universe</h5>
                        <p>Spider-Man Far from Home</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#slider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#slider" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="moviesSection bg-black">
            <div class="container">
                <h2 id="jumpToMovies" class="moviesSection-header text-white">OPENING THIS WEEK</h2>
                <form class="d-flex my-4" style="justify-content: space-between;">
                    <input class="form-control me-2 w-25" type="search" placeholder="Search" aria-label="Search"
                        id="searchInput" />
                    <button class="btn btn-outline-danger" type="button" id="refresh">
                        Refresh
                    </button>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            // Get references to the search input, clear button, category select, and film list container
                            var searchInput = document.getElementById("searchInput");
                            var refresh = document.getElementById("refresh");
                            var select = document.getElementById("category");
                            var filmList = document.getElementById("filmList");

                            // Function to fetch films based on search query
                            function fetchSearchFilmList() {
                                var searchQuery = searchInput.value.trim();
                                var xhr = new XMLHttpRequest();
                                var url = "filmList.php";
                                if (searchQuery) {
                                    url = "search_films.php?query=" + encodeURIComponent(searchQuery);
                                    select.value = "Select a category";
                                }
                                xhr.open("GET", url, true);
                                xhr.onreadystatechange = function () {
                                    if (xhr.readyState == 4 && xhr.status == 200) {
                                        filmList.innerHTML = xhr.responseText;
                                    }
                                };
                                xhr.send();
                            }

                            // Function to fetch films based on category selection
                            function fetchCateFilmList() {
                                var category = select.value.trim();
                                var xhr = new XMLHttpRequest();
                                var url = "filmList.php";
                                if (category) {
                                    url = "get_films_by_category.php?category=" + encodeURIComponent(category);
                                    searchInput.value = "";
                                }
                                xhr.open("GET", url, true);
                                xhr.onreadystatechange = function () {
                                    if (xhr.readyState == 4 && xhr.status == 200) {
                                        filmList.innerHTML = xhr.responseText;
                                    }
                                };
                                xhr.send();
                            }

                            // Add event listeners to search input and category select
                            searchInput.addEventListener("input", fetchSearchFilmList);
                            select.addEventListener("change", fetchCateFilmList);

                            // Add event listener to clear button
                            refresh.addEventListener("click", function () {
                                searchInput.value = "";
                                select.value = "Select a category";
                                fetchSearchFilmList(); // Call fetchFilmList to reset to full film list
                            })
                            // Fetch initial film list when the page loads
                            fetchSearchFilmList();
                            fetchCateFilmList(); // Fetch full film list based on initial category selection
                        });
                    </script>
                    <select class="form-control w-25" id="category" style="margin-left: auto;">
                        <option>Select a category</option>
                        <?php
                        $sql = "SELECT * FROM categories";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($option = $result->fetch_assoc()) {
                                echo '<option value="' . $option['cat_name'] . '"> ' . $option['cat_name'] . '</option>';
                            }
                        } else
                            echo "none";
                        ?>
                    </select>
                </form>

                <div id="filmList">
                    <?php include 'filmList.php' ?>;
                </div>
                <div class="container">
                    <h2 id="jumpToUpcomming" class="moviesSection-header text-white">UPCOMMING</h2>
                    <div class="carousel">
                        <div id="upcomingSlider" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $sql_upcoming = "SELECT * FROM film WHERE film_releasedate > CURDATE()";
                                $result_upcoming = $conn->query($sql_upcoming);
                                $film_count = 0;
                                if ($result_upcoming->num_rows > 0) {
                                    while ($row = $result_upcoming->fetch_assoc()) {
                                        if ($film_count % 3 == 0) {
                                            echo '<div class="carousel-item';
                                            if ($film_count == 0)
                                                echo ' active';
                                            echo '">';
                                            echo '<div class="row">';
                                        }
                                        echo '<div class="col-lg-4">';
                                        echo '<a href="" class="cardBtn"></a>';
                                        echo '<div class="card bg-transparent">';
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['film_image']) . '" class="card-img-top" alt="Film Image" />';
                                        echo '<div class="card-body">';
                                        echo '<h5 class="card-title text-white"> ' . $row['film_title'] . ' </h5>';
                                        $filmtitle = $row['film_title'];
                                        $sql_category = "SELECT c.* FROM categories c JOIN film_category fc ON c.cat_id = fc.cat_id
                                                                            JOIN film f ON fc.film_id = f.film_id WHERE f.film_title = '$filmtitle'";
                                        $result_category = $conn->query($sql_category);
                                        echo '<p class="card-text text-white">';
                                        if ($result_category->num_rows > 0) {
                                            while ($cat = $result_category->fetch_assoc()) {
                                                echo $cat['cat_name'];
                                                if ($result_category->num_rows > 1) {
                                                    echo ' ';
                                                }
                                            }
                                        }
                                        echo '</p>';
                                        echo '</div>';
                                        echo '</div>';
                                        echo '</div>';
                                        if ($film_count % 3 == 2) {
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                        $film_count++;
                                    }
                                    if ($film_count % 3 != 0) {
                                        echo '</div>';
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#upcomingSlider"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#upcomingSlider"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <footer>
        <div class="newsletterSection bg-black pt-5">
            <div class="container text-center ">
                <h4 class="newsletterHeading text-white p-3  ">
                    Subscribe To Get <br>
                    Newsletter
                </h4>
                <form class="d-flex justify-content-center" method="post">
                    <input class="form-control-lg" name="email" type="email" placeholder="Enter Your Email "
                        aria-label="email" required>
                    <button name="submit" class="btn btn-outline-danger p-2 ms-2 " type="submit  ">Subscribe</button>
                </form>
                <?php

                if (isset($_POST['submit'])) {
                    $mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'DHTTGaming@gmail.com';
                    $mail->Password = 'hiqi nkhp kmup arzf';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('DHTTGaming@gmail.com');

                    $mail->addAddress($_POST['email']);

                    $mail->isHTML(true);

                    $mail->Subject = 'Message from Nitflex';
                    $mail->Body = 'Thank you for subscribing to our newsletter!';

                    $mail->send();

                    echo '<script>alert("Thank you for subscribing to our newsletter!")</script>';
                }
                ?>
            </div>

            <div class="copyrightSection">
                <div class="container">
                    <div class="copyrightTag text-white ">
                        <i class="fa-solid fa-clapperboard"
                            style="color: var(--main-color); margin-right: 12px;"></i>Movies
                    </div>

                    <div class="socialList">
                        <a href="" class="facebookLink"><img src="assets/icons/facebook-app-symbol.png" alt=""></a>
                        <a href="" class="tiktokLink"><img src="assets/icons/tik-tok.png" alt=""></a>
                        <a href="" class="instagramLink"><img src="assets/icons/instagram.png" alt=""></a>
                        <a href="" class="youtubeLink"><img src="assets/icons/youtube.png" alt=""></a>

                    </div>
                </div>
            </div>





            <div class="container text-center text-white p-3 ">
                <p>© 2024 NitFlex. All Rights Reserved.</p>
            </div>
        </div>
        <div>
            <?php
            include 'film_modal.php';
            ?>
        </div>
    </footer>





    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>