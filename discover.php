<?php
$window_title = "Discover";
require "includes/header.php";


?>
                <h2>Results</h2>
        
                <section id="icons">
                    <div>
                        <p><?php echo $_POST['genre']['name'];?></p>
                    </div><div>
                        <p><?php echo $_POST['mood']['name'];?></p>
                    </div>
                </section>
                
                <?php
                    $tracks = $newGrace->getRecomend($_POST['genre']['radio'],$_POST['track']);
                    foreach ($tracks as $m) {
                        echo "<form action='discover.php' method='post' class='track'>";
                        
                        echo "<button type='submit' id='".$m['artist']."-track' onclick='this.form.submit()'>
                        
                        <img src='".$m['cover']."' alt='".$m['artist']." - ".$m['album']." - ".$m['track']."'><br><label for='".$m['artist']."-track'>".$m['artist']."</label><br> 
                        <label for='".$m['artist']."-track'>".$m['album']." - ".$m['track']."</label><input type='hidden' name='track' value='".$m['id']."'></button>";
                        
                        //getting mood and genre values from track
                        echo "<input type='hidden' name='mood[name]' value='".$m['mood']."'><input type='hidden' name='genre[name]' value='".$m['genre']."'><input type='hidden' name='genre[radio]' value='".$_POST['genre']['radio']."'>";
                        
                        //end form
                        echo "</form>";
                    }
                ?>
                       
<?php


include "includes/footer.php";
?>