<?php
include 'connect.php';
session_start();
?>
<div id="filmList">
    <?php
    // Check if the category parameter is set in the URL
    if (isset($_GET['category'])) {
        // Get the category value from the URL
        $category_name = $_GET['category'];

        // Query to retrieve the category ID based on the category name
        $sql_category = "SELECT cat_id FROM categories WHERE cat_name = '$category_name'";
        $result_category = $conn->query($sql_category);

        if ($result_category->num_rows > 0) {
            // Fetch the category ID
            $row_category = $result_category->fetch_assoc();
            $category_id = $row_category['cat_id'];

            // Query to retrieve films based on the selected category
            $sql_films = "SELECT f.* 
                                FROM film f 
                                JOIN film_category fc ON f.film_id = fc.film_id 
                                WHERE fc.cat_id = $category_id";
            $result_films = $conn->query($sql_films);

            if ($result_films->num_rows > 0) {
                echo '<div class="row">';
                while ($row = $result_films->fetch_assoc()) {
                    echo '<div class="col-lg-3 col-md-6 col-sm-6">';
                    echo '<a href="#" class="cardBtn" data-toggle="modal" data-target="#modal' . $row['film_id'] . '">';
                    echo '<div class="card bg-transparent">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['film_image']) . '" class="card-img-top" alt="Film Image" />';
                    echo '</a>';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title text-white">' . $row['film_title'] . '</h5>';
                    echo '<p class="card-text text-white">' . $row['film_duration'] . ' min';
                    $filmtitle = $row['film_title'];

                    $sql_category = "SELECT c.* FROM categories c JOIN film_category fc ON c.cat_id = fc.cat_id
                                                                JOIN film f ON fc.film_id = f.film_id WHERE f.film_title = '$filmtitle'";
                    $result_category = $conn->query($sql_category);
                    if ($result_category->num_rows > 0) {
                        $categories = [];
                        while ($cat = $result_category->fetch_assoc()) {
                            $categories[] = $cat['cat_name'];
                        }
                    }
                    echo '<p class="card-text text-white">' . implode(', ', $categories) . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
                echo '</div>'; // Close the row
            } else {
                echo "<div class='alert alert-secondary' role='alert'>
                        No films found in the selected category.
                      </div>";
            }
        } else {
            echo "No category selected";
        }
    }
    $conn->close();
    ?>