                <h2>Genre</h2>
                <p>Select a genre.</p>
                <?php
                $genres = $newGrace->getGenres();
                
                foreach($genres as $v) { ?>
                <form action='index.php' method='post' class='form__genre'>
                    <button type='submit' name='genre[id]' id='<?php echo $v['name'];?>' value='<?php echo $v['id'];?>'>
                        <img src='images/genre/<?php echo $v['id'];?>.png' alt='<?php echo $v['name'];?> icon' title='<?php echo $v['name'];?>'>
                        <p><?php echo $v['name'];?></p>
                    </button>
                    <input type='hidden' name='genre[name]' value='<?php echo $v['name'];?>'>
                    <input type='hidden' name='genre[radio]' value='<?php echo $v['radio'];?>'>
                </form>
                <?php
                }
                ?>