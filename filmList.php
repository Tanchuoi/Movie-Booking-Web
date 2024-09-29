<?php
include 'connect.php';
$sql_films = "SELECT * FROM film WHERE film_releasedate <= CURDATE()";
$result_films = $conn->query($sql_films);
if ($result_films->num_rows > 0) {
    echo '<div class="row">';
    while ($row = $result_films->fetch_assoc()) {
        echo '<div class="col-lg-3 col-md-6 col-sm-6">';
        echo '<a href="#" class="cardBtn" data-toggle="modal" data-target="#modal' . $row['film_id'] . '">';
        echo '<div class="card bg-transparent">';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['film_image']) . '" class="card-img-top card-img-top-1" alt="Film Image" />';
        echo '</a>';
        echo '<div class="card-body">';
        echo '<h5 class="card-title text-white">' . $row['film_title'] . '</h5>';
        echo '<p class="card-text text-white">' . $row['film_duration'] . ' min';
        $filmtitle = $row['film_title'];
        $sql_category = "SELECT c.* FROM categories c JOIN film_category fc ON c.cat_id = fc.cat_id
                                                    JOIN film f ON fc.film_id = f.film_id WHERE f.film_title = '$filmtitle'";
        $result_category = $conn->query($sql_category);

        if ($result_category->num_rows > 0) {
            echo '<p class="card-text text-white">';
            $categories = array();
            while ($cat = $result_category->fetch_assoc()) {
                $categories[] = $cat['cat_name'];
            }
            echo implode(', ', $categories);
            echo '</p>';
        }
        echo '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>'; // Close the row
} else {
    echo "0 results";
}
?>