            <fieldset>
                <img src="images/<?php echo $_POST['genre']['id'];?>.png" alt="<?php echo $_POST['genre']['name'];?> Icon">
                <p>What vibes are you feeling?</p>
                <?php
                $moods = $newGrace->getMoods($_POST['genre']['radio']);

                    $i = 0;
                    
                    foreach ($moods as $m) {
                        echo "<form action='index.php' method='post'>";
                        echo "<input type='radio' name='mood[id]' id='".$m['id']."' value='".$m['id']."' onclick='this.form.submit()'><label for='".$m['id']."'>".$m['mood']."</label><input type='hidden' name='mood[name]' value='".$m['mood']."'>";
                        //block of code to push forward the $_POST['genre'] values
                        echo "<input type='hidden' name='genre[id]' value='".$_POST['genre']['id']."'><input type='hidden' name='genre[name]' value='".$_POST['genre']['name']."'><input type='hidden' name='genre[radio]' value='".$_POST['genre']['radio']."'></form>";
                        if (++$i == 15) break;
                    }
                ?>
            </fieldset>