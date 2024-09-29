<?php
include 'connect.php';

if(isset($_POST['film_id'])){
    $film_id = $_POST['film_id'];
    $sql = "SELECT * FROM film WHERE film_id = '$film_id'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $film = $result->fetch_assoc();
        echo '<h5 class="modal-title" id="movie"> '. $film['film_title'] .'<h5>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    
                        echo '<div class="trailerContainer">';
                            
                        echo '</div>';
                        echo '<div class="infoContainer">';
                            echo '<h4>Writer: '. $film['film_writer'] .' ';
                            echo '</h4>';
                            echo '<h4>Release Date: '. $film['film_releasedate'] .'';
                            echo '</h4>';
                            echo '<h4>Stars: '. $film['film_stars'] .'';
                            echo '</h4>';
                            echo '<h4>Category: ';
                            echo '</h4>'; 
                        echo '</div>';
                    echo '</div>';
                    echo '<div class="modal-footer">';
                        $video_url =  $film['film_trailer'] ;
                        echo '<a href="' . $video_url . '" class="cardBtn">';
                        echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
                        echo '<button type="button" class="btn btn-danger ">Book</button>';
                       
    } else {
        echo "Film not found";
    }
} else {
    echo "Invalid request";
}
?>