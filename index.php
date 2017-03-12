<?php
$window_title = "Welcome";
require "includes/header.php";
include_once "classes/Gracenote/Gracenote.class.php";

?>
    
        <h1>Müscover</h1>
            <form action="index.php" method="post">
            <?php
            if (!isset($_POST['radio'])) { 
            ?>    
                <fieldset>
                <?php
                foreach($genres as $k => $v) {
                    echo "<input type='radio' name='radio' id='".$v[0]."' value='".$k."' onclick='this.form.submit()'><label for='".$v[0]."'>".$v[1]."</label><br/>";
                }
                ?>
                </fieldset>
            <?php
            }
            if (isset($_POST['radio'])) { 
                $moods = $newGrace->setMoods($_POST['radio']);
            ?>
                <fieldset>
                <?php

                $i = 0;
                foreach ($moods as $m) {
                    echo "<input type='radio' name='mood' id='".$m['id']."' value='".$m['id']."' onclick='this.form.submit()'><label for='".$m['id']."'>".$m['mood']."</label><br/>";
                    if (++$i == 15) break;
                }
                ?>
                </fieldset>
            <?php    
            }
            ?>
            </form>
<?php
require "includes/footer.php";
?>