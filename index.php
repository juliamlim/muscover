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
                    echo "<a href='index.php?radio=".$_GET['radio'].$_GET['genre']."?mood=".$m['id']."'>".$m['mood']."</a><br/>";
                    if (++$i == 15) break;
                }
                ?>
            </div>
            <form method="post" action="index.php">
                
                
            </form>
<?php
require "includes/footer.php";
?>