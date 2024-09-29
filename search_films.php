<?php

include 'connect.php';

$searchQuery = $_GET['query'];
$sql = "SELECT DISTINCT f.* FROM film f 
        JOIN film_category fc ON f.film_id = fc.film_id 
        JOIN categories c ON fc.cat_id = c.cat_id WHERE 
        film_title LIKE '%$searchQuery%' OR 
        film_releasedate LIKE '%$searchQuery%' OR 
        film_duration LIKE '%$searchQuery%' OR 
        film_writer LIKE '%$searchQuery%' OR
        film_stars LIKE '%$searchQuery%'OR
        cat_name LIKE '%$searchQuery%'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="row">';
    $categories = [];
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-lg-3 col-md-6 col-sm-6">';
        $video_url = $row['film_trailer'];
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
    echo '</div>';
} else {
    echo "<div class='alert alert-secondary' role='alert'>
            No films found
                      </div>";
}

$conn->close();
?>