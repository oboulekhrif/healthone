<!DOCTYPE html>
<html>

<body>

    <div class="container">
       
        <br>
        <h4 class="card-title">Contactgegevens</h4>
        <br>
        <p class="card-header">Naam: Health One</p>
        <p class="card-header">Locatie: Den Haag</p>
        <p class="card-header">Openingstijden: </p>
<p class="card-header bg-white">Maandag t/m vrijdag: 08:00 uur tot 20:00 uur </p>
<p class="card-header bg-white">Zaterdag en Zondag: 10:00 uur tot 18:00 uur </p>
        <p class="card-header">Telefoonnummer:<a href="tel:"></a></p>
        <p class="card-header">E-Mail: <a href="mailto: healthone@gmail.com">healthone@gmail.com</a></p>
        <br>
        <h4 class="card-title">Geef ons feedback</h4>
        <br>
        <form method="post" action="">
            <label>Naam</label>
            <input type="text" name="naam"><br>
            <label>Bericht</label>
            <textarea name="bericht" id="bericht" cols="20" rows="3"></textarea>
            <br><br>
            <input type="submit" name="verzenden" value="Opslaan">
        </form>
        <?php
        $db = new PDO("mysql:host=localhost;dbname=healthone"
        ,"root");
        echo "<table border='1'>";
            if(isset($_POST['verzenden'])){
                $naam = $_POST['naam'];
                $bericht = $_POST['bericht'];
                $query = $db->prepare("INSERT INTO comments(naam,bericht)
                VALUES(:naam, :bericht)");
                $query->bindParam("naam", $naam);
                $query->bindParam("bericht", $bericht);
                if($query->execute()){
                    echo "goed";
                    $query = $db->prepare("SELECT * FROM comments WHERE datumtijd");
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as &$data){
                    echo "<tr>";
                    echo "<td>" . $data["naam"] . "---" .  "</td>";
                    echo "<td>" . $data["bericht"] . "---" . "</td>";
                    echo "<td>" . $data["datumtijd"] . "</td>";
                    echo "</tr>";
                }
                }
            }
        ?>
        <br>
        <?php
        include_once ('../Templates/defaults/footer.php');
        ?>
    </div>

</body>
</html>