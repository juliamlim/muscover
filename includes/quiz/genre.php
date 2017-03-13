            <fieldset>  
                <p>Choose a genre</p>
                
                <?php
                $genres = $newGrace->getGenres();
                
                foreach($genres as $v) { ?>
                <form action="index.php" method="post">
                <?php
                    echo "<input type='hidden' name='genre[id]' value='".$v[0]."'><input type='hidden' name='genre[name]' value='".$v[1]."'><input type='radio' name='genre[radio]' id='".$v[0]."' value='".$v[2]."' onclick='this.form.submit()'><label for='".$v[0]."'>".$v[1]."</label></form>";
                }
                ?>
            </fieldset>