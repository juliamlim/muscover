                <h2>Track</h2>
                
                <section id="icons">
                    <div>
                        <img src="images/genre/<?php echo $_POST['genre']['id'];?>.png" id="genre_icon" alt="<?php echo $_POST['genre']['name'];?> Icon"><p><?php echo $_POST['genre']['name'];?></p>
                    </div><div>
                        <img src="images/<?php echo $_POST['mood']['id'];?>.svg" id="mood_icon" alt="<?php echo $_POST['mood']['name'];?> Icon"><p><?php echo $_POST['mood']['name'];?></p>
                    </div>
                </section>
                <p>Pick a song.</p>
                <?php
                    $tracks = $newGrace->getTracks($_POST['genre']['id'],$_POST['mood']['id']);
                       
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