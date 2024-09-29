<?php include '../connect.php'; ?>

<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header('Location: ../index.php');  // Redirect to index.php
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- CSS -->
    <link rel="stylesheet" href="dashboard.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/7b511d7d97.js" crossorigin="anonymous"></script>





</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg fixed-top bg-white  ">
            <div class="container-fluid">
                <a class="navbar-brand ms-5" href="dashboard.php">Admin</a>

                <a href="../index.php"><i class="fa-solid fa-house-user"></i></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end bg-black " tabindex="-1" id="offcanvasNavbar"
                    aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            <a class="navbar-brand px-5" href=".">Admin</a>
                        </h5>
                        <button type="button" class="btn-close text-reset bg-white " data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                            <li class="nav-item px-5">
                                <a class="nav_link" id="dashboard" aria-current="page"
                                    style="font-weight: bold;">Dashboard</a>
                            </li>
                            <li class="nav-item px-5">
                                <a class="nav_link" id="categories">Categories</a>
                            </li>
                            <li class="nav-item px-5">
                                <a class="nav_link" id="movies">Movies</a>
                            </li>
                            <li class="nav-item px-5">
                                <a class="nav_link" id="users">Users</a>
                            </li>
                            <li class="nav-item px-5">
                                <a class="nav_link" href="../logout.php"><i class="fa-solid fa-right-from-bracket"
                                        style="  color: rgb(66, 135, 245);"></i></a>
                            </li>

                        </ul>

                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>


        <div class="container" id="dashboardContent" style="display: block">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title text-center ">CATEGORIES</h5>
                            <?php
                            $sql = "SELECT COUNT(*) FROM categories";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            echo '<p class="card-text text-center ">' . $row[0] . '</p>';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title text-center ">MOVIES</h5>
                            <?php
                            $sql = "SELECT COUNT(*) FROM film";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            echo '<p class="card-text text-center ">' . $row[0] . '</p>';
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card my-3">
                        <div class="card-body">
                            <?php
                            $sql = "SELECT COUNT(*) FROM booking";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            echo '<h5 class="card-title text-center ">BOOKINGS</h5>';
                            echo '<p class="card-text text-center ">' . $row[0] . '</p>';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card my-3">
                        <div class="card-body">
                            <h5 class="card-title text-center ">USERS</h5>
                            <?php
                            $sql = "SELECT COUNT(*) FROM user";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                            echo '<p class="card-text text-center ">' . $row[0] . '</p>';
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container" id="categoriesContent" style="display: none">
            <div class="row">
                <div class="col-lg-6">
                    <form action="" method="get">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" name="categoryInput" required>
                        </div>
                        <button name="addCategoryBtn" type="submit" class="btn btn-primary">Add</button>
                        <?php //Add category
                        if (isset($_GET['categoryInput']) && !empty(trim($_GET['categoryInput']))) {
                            $category = $_GET['categoryInput'];

                            $sqlCheck = 'select * from categories where cat_name = "' . $category . '"';
                            $resultCheck = mysqli_query($conn, $sqlCheck);

                            if (mysqli_num_rows($resultCheck) > 0) {
                                echo '<script>alert("Category already exists")</script>';
                            } else if (isset($_GET['addCategoryBtn'])) {
                                $sql = "INSERT INTO categories (cat_name) VALUES ('$category')";
                                if (mysqli_query($conn, $sql)) {
                                    echo '<script>alert("New category added successfully"); window.location.href="dashboard.php";</script>';
                                } else {
                                    echo '<script>alert("Error: ' . $sql . '<br>' . mysqli_error($conn) . '")</script>';
                                }
                            }
                        }
                        ?>
                    </form>
                </div>
                <div class="col-lg-6">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php //Display categories
                            $sql = "SELECT * FROM categories";
                            $result = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<form method="POST" action="">';
                                echo '<th>' . $row['cat_id'] . '</th>';
                                echo '<td>' . $row['cat_name'] . '</td>';
                                echo '<td>';
                                echo '<input type="hidden" name="idToDelete" value="' . $row['cat_id'] . '">';
                                echo '<button type="submit" class="btn btn-outline-danger">Delete</button>';
                                echo '</td>';
                                echo '</form>';
                                echo '</tr>';
                            }
                            if (isset($_POST['idToDelete'])) {
                                $idToDelete = $_POST['idToDelete'];

                                $sql1 = "DELETE FROM film_category WHERE cat_id = $idToDelete";
                                if (mysqli_query($conn, $sql1)) {
                                    $sql = "DELETE FROM categories WHERE cat_id = $idToDelete";
                                    if (mysqli_query($conn, $sql)) {
                                        echo '<script>alert("Category deleted successfully"); window.location.href="dashboard.php";</script>';
                                    } else {
                                        echo '<script>alert("Error deleting category: ' . $sql . '<br>' . mysqli_error($conn) . '")</script>';
                                    }
                                } else {
                                    echo '<script>alert("Error deleting film category: ' . $sql1 . '<br>' . mysqli_error($conn) . '")</script>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>

        <div class="container" id="moviesContent" style="display: none">
            <div class="row">
                <div class="col-lg-4">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="movie" class="form-label">Movie</label>
                            <input type="text" class="form-control" id="movie" name="movieInput" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <?php //Display categories in checkboxes
                            $sql = "SELECT * FROM categories";
                            $result = mysqli_query($conn, $sql);
                            $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

                            foreach ($categories as $category) {
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input" type="checkbox" id="category' . $category['cat_id'] . '" name="categoryInput[]" value="' . $category['cat_id'] . '">';
                                echo '<label class="form-check-label" for="category' . $category['cat_id'] . '">' . $category['cat_name'] . '</label>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" class="form-control" id="duration" name="durationInput" z>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="imageInput" required>
                        </div>
                        <div class="mb-3">
                            <label for="trailer" class="form-label">Trailer</label>
                            <input type="file" class="form-control" id="trailer" name="trailerInput" required>
                        </div>
                        <div class="mb-3">
                            <label for="director" class="form-label">Director</label>
                            <input type="text" class="form-control" id="director" name="directorInput" required>
                        </div>
                        <div class="mb-3">
                            <label for="stars" class="form-label">Stars</label>
                            <input type="text" class="form-control" id="stars" name="starsInput" required>
                        </div>
                        <div class="mb-3">
                            <label for="releaseDate" class="form-label
                                ">Release Date</label>
                            <input type="date" class="form-control" id="releaseDate" name="releaseDateInput" required>
                        </div>
                        <button name="addBtn" type="submit" class="btn btn-primary">Add</button>
                    </form>
                    <?php //Add movie
                    if (isset($_POST['addBtn'])) {
                        $movie = $_POST['movieInput'];
                        $duration = $_POST['durationInput'];
                        $image = addslashes(file_get_contents($_FILES['imageInput']['tmp_name']));

                        if (isset($_FILES['trailerInput']) && !empty($_FILES['trailerInput']['tmp_name'])) {
                            $file_tmp = $_FILES['trailerInput']['tmp_name'];
                            $file_type = $_FILES['trailerInput']['type'];

                            if ($file_type == "video/mp4") {
                                // Move the uploaded file to your desired location
                                $target_dir = "assets/videos/";
                                $target_file = $target_dir . basename($_FILES["trailerInput"]["name"]);
                                move_uploaded_file($file_tmp, $target_file);
                                $trailer = $target_file;
                            } else {
                                echo '<script>alert("Please upload a valid MP4 file.")</script>';
                                exit;
                            }
                        } else {
                            echo '<script>alert("Please upload a trailer.")</script>';
                            exit;
                        }

                        $director = $_POST['directorInput'];
                        $stars = $_POST['starsInput'];
                        $releaseDate = $_POST['releaseDateInput'];
                        $sql = "INSERT INTO film (film_title, film_duration, film_image, film_trailer, film_writer, film_stars, film_releasedate) VALUES ('$movie', '$duration', '$image', '$trailer', '$director', '$stars', '$releaseDate')";

                        if (mysqli_query($conn, $sql)) {
                            $lastId = mysqli_insert_id($conn);
                            $categories = $_POST['categoryInput'];

                            foreach ($categories as $category) {
                                $sql = "INSERT INTO film_category (film_id, cat_id) VALUES ($lastId, $category)";
                                if (!mysqli_query($conn, $sql)) {
                                    echo '<script>alert("Error: ' . $sql . '<br>' . mysqli_error($conn) . '")</script>';
                                }
                            }

                            echo '<script>alert("New movie added successfully"); window.location.href="dashboard.php";</script>';
                        } else {
                            echo '<script>alert("Error: ' . $sql . '<br>' . mysqli_error($conn) . '")</script>';
                        }

                    }

                    ?>

                </div>
                <div class="col-lg-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Movie</th>
                                <th>CoverImage</th>
                                <th>Director</th>
                                <th>ReleaseDate</th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php //Display movies
                            
                            $sql = 'SELECT f.film_id, f.film_title, c.cat_name, f.film_image, f.film_writer, f.film_releasedate
                            FROM categories c
                            JOIN film_category fc ON c.cat_id = fc.cat_id
                            JOIN film f ON fc.film_id = f.film_id
                            ORDER BY f.film_id';
                            $result = mysqli_query($conn, $sql);

                            $lastFilmId = null;
                            $categories = [];

                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($lastFilmId !== $row['film_id']) {
                                    if ($lastFilmId !== null) {
                                        echo '<td>' . implode(', ', $categories) . '</td>';
                                        echo '<td>';
                                        echo '<input type="hidden" name="idToDeleteMovie" value="' . $lastFilmId . '">';
                                        echo '<button type="submit" class="btn btn-outline-danger">Delete</button>';
                                        echo '</td>';
                                        echo '</form>';
                                        echo '</tr>';
                                    }

                                    $lastFilmId = $row['film_id'];
                                    $categories = [];

                                    echo '<tr>';
                                    echo '<form method="POST" action="">';
                                    echo '<th>' . $row['film_id'] . '</th>';
                                    echo '<td>' . $row['film_title'] . '</td>';
                                    $imageData = base64_encode($row['film_image']);
                                    echo '<td><img src="data:image/jpeg;base64,' . $imageData . '" alt="Cover Image" width="100"></td>';
                                    echo '<td>' . $row['film_writer'] . '</td>';
                                    echo '<td>' . $row['film_releasedate'] . '</td>';
                                }

                                $categories[] = $row['cat_name'];
                            }

                            if ($lastFilmId !== null) {
                                echo '<td>' . implode(', ', $categories) . '</td>';
                                echo '<td>';
                                echo '<input type="hidden" name="idToDeleteMovie" value="' . $lastFilmId . '">';
                                echo '<button type="submit" class="btn btn-outline-danger">Delete</button>';
                                echo '</td>';
                                echo '</form>';
                                echo '</tr>';
                            }
                            ?>

                            <?php //Delete movie button
                            if (isset($_POST['idToDeleteMovie'])) {
                                $idToDeleteMovie = $_POST['idToDeleteMovie'];

                                $sql1 = "DELETE FROM film_category WHERE film_id = $idToDeleteMovie";
                                $sql2 = "DELETE FROM booking WHERE film_id = $idToDeleteMovie";
                                $sql3 = "DELETE FROM film WHERE film_id = $idToDeleteMovie";
                                if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)) {
                                    echo '<script>alert("Movie deleted successfully"); window.location.href="dashboard.php";</script>';
                                } else {
                                    echo '<script>alert("Error: ' . $sql3 . '<br>' . mysqli_error($conn) . '")</script>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container" id="usersContent" style="display: none">
            <div class="row">
                <div class="col-lg-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM user";
                            $result = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<form method="POST" action="">';
                                echo '<th>' . $row['user_id'] . '</th>';
                                echo '<td>' . $row['user_name'] . '</td>';
                                echo '<td>' . $row['user_admin'] . '</td>';
                                echo '<td>';
                                echo '<input type="hidden" name="idToDeleteUser" value="' . $row['user_id'] . '">';
                                echo '<button type="submit" class="btn btn-outline-danger">Delete</button>';
                                echo '</td>';
                                echo '</form>';
                                echo '</tr>';
                            }
                            if (isset($_POST['idToDeleteUser'])) {
                                $idToDeleteUser = $_POST['idToDeleteUser'];

                                $sql = "DELETE FROM user WHERE user_id = $idToDeleteUser";

                                if (mysqli_query($conn, $sql)) {
                                    echo '<script>alert("User deleted successfully"); window.location.href="dashboard.php";</script>';
                                } else {
                                    echo '<script>alert("Error: ' . $sql . '<br>' . mysqli_error($conn) . '")</script>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>

        <footer>

        </footer>


    </main>

    <!-- Javascript -->
    <script src=" dashboard.js">
    </script>
</body>

</html>