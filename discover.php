<?php
$window_title = "Welcome";
require "includes/header.php";

$moods = $newGrace->setMoods($_POST['radio']);
$genre = $genres[$_POST['radio']];

$i = 0;
?>
    
        <h1>Müscover</h1>

            <form method="post" action="index.php">
                <img src="images/<?php echo $genre[0];?>.png"  alt="<?php echo $genre[1];?>">
                <input type="hidden" name="genre" value="<?php echo $genre[0];?>">
                <?php
                foreach ($moods as $m) {
                    echo "<input type='radio' name='mood' id='".$m['id']."' value='".$m['id']."' onclick='this.form.submit()'><label for='".$m['id']."'>".$m['mood']."</label><br/>";
                    if (++$i == 15) break;
                }
                ?>
            </form>
<?php


include "includes/footer.php";
?>