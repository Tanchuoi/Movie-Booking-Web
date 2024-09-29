<?php
include 'connect.php';
$sql_films = "SELECT * FROM film";
$result_films = $conn->query($sql_films);
if ($result_films->num_rows > 0) {
    while ($row = $result_films->fetch_assoc()) {
        echo '<div class="modal fade" id="modal' . $row['film_id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo '<div class="modal-dialog modal-xl text-white " role="document">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">';
        echo '<h5 class="modal-title" id="movie"> ' . $row['film_title'] . '<h5>';
        echo '</div>';
        echo '<div class="modal-body">';
        echo '<div class="trailerContainer">';
        $video = $row['film_trailer'];
        echo '<video controls width="100%" height="500">
        <source src="' . $video . '" type="video/mp4">
        Your browser does not support the video tag.
            </video>';
        echo '</div>';
        echo '<div class="infoContainer">';
        echo '<h4>Writer: ' . $row['film_writer'] . ' ';
        echo '</h4>';
        echo '<h4>Release Date: ' . $row['film_releasedate'] . '';
        echo '</h4>';
        echo '<h4>Stars: ' . $row['film_stars'] . '';
        echo '</h4>';
        echo '<h4>Category: ';
        $filmtitle = $row['film_title'];
        $sql_category = "SELECT c.* FROM categories c JOIN film_category fc ON c.cat_id = fc.cat_id
                                                                JOIN film f ON fc.film_id = f.film_id WHERE f.film_title = '$filmtitle'";
        $result_category = $conn->query($sql_category);
        if ($result_category->num_rows > 0) {
            while ($cat = $result_category->fetch_assoc()) {
                echo $cat['cat_name'];
                if ($result_category->num_rows > 1) {
                    echo ' ';
                }
            }
        }
        echo '</h4>';
        echo '</div>';
        echo '</div>';
        echo '<div class="modal-footer">';
        echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
        echo '<button type="button" class="btn btn-danger id="Book" data-film-id="' . $row['film_id'] . '">Book</button>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

    }
} else {
    echo "0 results";
}
?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var bookButtons = document.querySelectorAll(".btn-danger");
        bookButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                var filmId = button.getAttribute('data-film-id');
                var today = new Date();
                var bookingDate = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                var xhr = new XMLHttpRequest();
                var url = "book_film.php";
                var params = "book_film=true & film_id=" + filmId + "&booking_date=" + bookingDate;
                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send(params);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        if (xhr.responseText.trim() === "Booking successful!") {
                            window.alert("Booking successful!");
                        } else {
                            window.location.href = "login.php";
                            window.alert("Booking failed!");
                        }
                    }
                }
            });
        });
    });
</script>