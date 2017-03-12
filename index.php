<?php
$window_title = "Welcome";
require "includes/header.php";
include_once "classes/Gracenote/Gracenote.class.php";

?>
    
        <h1>Müscover</h1>
            <div id="genre">
            <?php 
            foreach ($genres as $k => $v) {
                echo "<a href='index.php?radio=".$k."?genre=".$v[0]."'>".$v[1]."</a><br/>";
            }
            ?>
            </div>
            <div id="mood">
                <?php
                $moods = $newGrace->setMoods($_GET['radio']);

                $i = 0;
                foreach ($moods as $m) {
                    echo "<input type='radio' name='mood' id='".$m['id']."' value='".$m['id']."' onclick='this.form.submit()'><label for='".$m['id']."'>".$m['mood']."</label><br/>";
                    if (++$i == 15) break;
                }
                ?>
            </div>
            <form method="post" action="index.php">
                
                
            </form>
<?php
require "includes/footer.php";
?>