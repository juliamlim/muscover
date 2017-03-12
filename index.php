<?php
$window_title = "Welcome";
require "includes/header.php";
include_once "classes/Gracenote/Gracenote.class.php";

?>
    
        <h1>Müscover</h1>
            <?php 
            foreach ($genres as $k => $v) {
                echo "<a href='index.php?radio=".$k."?genre=".$v[0]."'>".$v[1]."</a><br/>";
            }
            ?>
            
            <form method="post" action="index.php">
                <?php 
                /*foreach ($genres as $k => $v) {
                    echo "<input type='radio' name='radio' id='".$v[0]."' value='".$k."' onclick='this.form.submit()'><label for='".$v[0]."'>".$v[1]."</label><br/>";
                }*/
                
                $moods = $newGrace->setMoods($_GET['radio']);
                $genre = $genres[$_POST['radio']];

                $i = 0;
                foreach ($moods as $m) {
                    echo "<input type='radio' name='mood' id='".$m['id']."' value='".$m['id']."' onclick='this.form.submit()'><label for='".$m['id']."'>".$m['mood']."</label><br/>";
                    if (++$i == 15) break;
                }
                ?>
            </form>
<?php
require "includes/footer.php";
?>