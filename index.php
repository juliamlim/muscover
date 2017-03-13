<?php
$window_title = "Welcome";
require "includes/header.php";

?>
    
        <h1>Müscover</h1>
            <?php
            if (isset($_POST['genre']) && isset($_POST['mood'])) {
                include_once "includes/quiz/artist.php";
            } else if (isset($_POST['genre']) && !isset($_POST['mood'])) {  
                include_once "includes/quiz/mood.php";
            } else {
                include_once "includes/quiz/genre.php";
            }
            ?>
<?php
require "includes/footer.php";
?>