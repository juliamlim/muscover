<?php
$window_title = "Welcome";
require "includes/header.php";


?>
    
        <h1>Müscover</h1>
            <fieldset>
                <img src="images/<?php echo $_POST['genre']['id'];?>.png" alt="<?php echo $_POST['genre']['name'];?> Icon">
                <img src="images/<?php echo $_POST['mood']['id'];?>.png" alt="<?php echo $_POST['mood']['name'];?> Icon">
                <p>Select a song.</p>
                <?php
                    $tracks = $newGrace->getRecomend($_POST['genre']['radio'],$_POST['track']);
                    foreach ($tracks as $m) {
                        echo "<form action='discover.php' method='post'>";
                        
                        echo "<img src='".$m['cover']."'><input type='radio' name='track' id='".$m['artist']."' value='".$m['id']."' onclick='this.form.submit()'><label for='".$m['artist']."'>".$m['artist']."</label><br><label for='".$m['artist']."'>".$m['album']." - ".$m['track']."</label>";
                        
                        //block of code to push forward the $_POST['genre'] values
                        echo "<input type='hidden' name='genre[id]' value='".$_POST['genre']['id']."'><input type='hidden' name='genre[name]' value='".$_POST['genre']['name']."'><input type='hidden' name='genre[radio]' value='".$_POST['genre']['radio']."'></form>";
                    }
                ?>
            </fieldset>            
<?php


include "includes/footer.php";
?>