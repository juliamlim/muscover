                <h2>Mood</h2>
                
                <section id="icons">
                    <div>
                        <img src="images/genre/<?php echo $_POST['genre']['id'];?>.png" id="genre_icon" alt="<?php echo $_POST['genre']['name'];?> Icon"><p><?php echo $_POST['genre']['name'];?></p>
                    </div>
                </section>
                <p>What are you in the mood for?</p>
                <?php
                $moods = $newGrace->getMoods($_POST['genre']['radio']);

                $i = 0;
                foreach ($moods as $m) { ?>
                <form action='index.php' method='post' class='form__mood'>
                    <button type='submit' name='mood[id]' value='<?php echo $m['id'];?>'><a><?php echo $m['mood'];?></a></button>
                    <input type='hidden' name='mood[name]' value='<?php echo $m['mood'];?>'>
                    
                    <?php//Pushes the genre[] values forward ?>
                    <input type='hidden' name='genre[id]' value='<?php echo $_POST['genre']['id'];?>'>
                    <input type='hidden' name='genre[name]' value='<?php echo $_POST['genre']['name'];?>'>
                    <input type='hidden' name='genre[radio]' value='<?php echo $_POST['genre']['radio'];?>'>
                </form>
                <?php
                    if (++$i == 15) break;
                }
                ?>