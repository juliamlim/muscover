                <h2>Track</h2>
                
                <section id="icons">
                    <div>
                        <img src="images/genre/<?php echo $_POST['genre']['id'];?>.svg" id="genre_icon" alt="<?php echo $_POST['genre']['name'];?> Icon"><p><?php echo $_POST['genre']['name'];?></p>
                    </div><div>
                        <img src="images/<?php echo $_POST['mood']['id'];?>.svg" id="mood_icon" alt="<?php echo $_POST['mood']['name'];?> Icon"><p><?php echo $_POST['mood']['name'];?></p>
                    </div>
                </section>
                <p>Pick a song.</p>
                <?php
                    $tracks = $newGrace->getTracks($_POST['genre']['id'],$_POST['mood']['id']);
                       
                    foreach ($tracks as $m) {
                        echo "<form action='discover.php' method='post'>";
                        
                        echo "<img src='".$m['cover']."'><input type='radio' name='track' id='".$m['artist']."' value='".$m['id']."' onclick='this.form.submit()'><label for='".$m['artist']."'>".$m['artist']."</label><br><label for='".$m['artist']."'>".$m['album']." - ".$m['track']."</label>";
                        
                        //block of code to push forward the $_POST['mood'] values
                        echo "<input type='hidden' name='mood[id]' value='".$_POST['mood']['id']."'><input type='hidden' name='mood[name]' value='".$_POST['mood']['name']."'>";
                        
                        //block of code to push forward the $_POST['genre'] values
                        echo "<input type='hidden' name='genre[id]' value='".$_POST['genre']['id']."'><input type='hidden' name='genre[name]' value='".$_POST['genre']['name']."'><input type='hidden' name='genre[radio]' value='".$_POST['genre']['radio']."'></form>";
                    }
                ?>