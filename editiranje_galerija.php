<?php 

    session_start();

    if(!isset($_SESSION["id"])) {
        header("Location: prijava.php");
    }

?>

<?php 


	include_once("baza.php");

	$veza = spojiSeNaBazu();
    $id_ulogiranog_korisnika = $_SESSION["id"]; 
    $id_azuriranja_slike = $_GET["id"];


	if(isset($_POST["submitEditSlika"])) {
		$greska = "";
		$poruka = "";

		$planina = $_POST["planina"];
		$url = $_POST["url"];
		$datum_vrijeme_slikanja = $_POST["datum_vrijeme_slikanja"];
		$naziv = $_POST["naziv"];
		$opis = $_POST["opis"];
		$status = $_POST["status"];
		

		if(!isset($planina) || empty($planina)){
			$greska .= "Niste unijeli planinu! <br>";
		}
		if(!isset($url) || empty($url)){
			$greska .= "Niste unijeli URL do slike! <br>";
		}
		if(!isset($datum_vrijeme_slikanja) || empty($datum_vrijeme_slikanja)){
			$greska .= "Niste unijeli datum i vrijeme slikanja! <br>";
		}
		if(!isset($naziv) || empty($naziv)){
			$greska .= "Niste unijeli naziv slike! <br>";
		}
		if(!isset($opis) || empty($opis)){
			$greska .= "Niste unijeli opis slike! <br>";
		}
	
		if(empty($greska)){

			$upit = "UPDATE slika SET
			planina_id='{$planina}',
			korisnik_id='{$id_ulogiranog_korisnika}',
			naziv='{$naziv}',
			url='{$url}', 
			opis='{$opis}', 
			datum_vrijeme_slikanja='{$datum_vrijeme_slikanja}', 
			status='{$status}'
			WHERE slika_id='{$id_azuriranja_slike}'";
			izvrsiUpit($veza, $upit);

			$poruka = "Ažurirali ste sliku!";
		}
	}


    
        $upit = "SELECT slika.slika_id AS slika_id, 
					slika.url AS slika_url, 
					slika.naziv AS slika_naziv, 
					slika.opis AS slika_opis, 
					slika.datum_vrijeme_slikanja AS slika_datum_vrijeme_slikanja,
                    slika.status AS slika_status,
					planina.planina_id, 
					planina.naziv AS planina_naziv, 
					planina.opis AS planina_opis, 
					korisnik.ime AS korisnik_ime,
					korisnik.prezime AS korisnik_prezime 
                    FROM slika, planina, korisnik 
                    WHERE planina.planina_id=slika.planina_id
                    AND korisnik.korisnik_id='{$id_ulogiranog_korisnika}'
                    AND korisnik.korisnik_id=slika.korisnik_id
					AND slika.slika_id='{$id_azuriranja_slike}'
                    ORDER BY datum_vrijeme_slikanja DESC ";
    

	$rezultat = izvrsiUpit($veza, $upit);
	$rezultat_ispis = mysqli_fetch_array($rezultat);

?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
   <link href="oblikovanje.css" rel="stylesheet" type="text/css">
    <title>Ažuriranje slike</title>
</head>
<body>
    <header>
        <strong>Ažuriranje slike</strong>
    </header>
    
    <?php
        include 'meni.php'
    ?>

    <section>
    <form name="forma" id="forma" method="POST" action="
	<?php 
		echo $_SERVER["PHP_SELF"]. "?id={$id_azuriranja_slike}"; 
	?>">
	<strong>Ažurirajte podatke slike:</strong>
		<br>
		<label for="planina">Planina: </label>
		<select name="planina" id="planina">
        <?php
            $lista_planina = "SELECT planina.* FROM planina";
            $rezultat_lista_planina = izvrsiUpit($veza, $lista_planina);

            if(isset($rezultat_lista_planina)) {

                while($red_lista_planina = mysqli_fetch_array($rezultat_lista_planina)) {
                    echo "<option value='{$red_lista_planina["planina_id"]}'";?>
					<?php
					if($rezultat_ispis["planina_id"] == $red_lista_planina["planina_id"]) {
						echo "selected";
					}
					?> <?php
					echo">{$red_lista_planina["naziv"]}</option>";
                }
            }
        ?>
        </select>
		<br/>
		<label for="url">URL do slike: </label>
		<input name="url" id="url" type="text" size="100" 
		value="<?php echo $rezultat_ispis["slika_url"];?>"/>
		<br/>
		<label for="datum_vrijeme_slikanja">Datum i vrijeme slikanja: </label>
		<input name="datum_vrijeme_slikanja" id="datum_vrijeme_slikanja" type="text" 
		value="<?php echo $rezultat_ispis["slika_datum_vrijeme_slikanja"];?>"/>
		<br/>
        <label for="naziv">Naziv slike: </label>
		<input name="naziv" id="naziv" type="text" 
		value="<?php echo $rezultat_ispis["slika_naziv"];?>"/>
		<br/>
		<label for="opis">Opis slike: </label>
		<input name="opis" id="opis" type="text" size="100"
		value="<?php echo $rezultat_ispis["slika_opis"];?>"/>
		<br/>
		<label for="status">Objava: </label>
		<select name="status" id="status">
			<option value="0"<?php 
					if($rezultat_ispis['slika_status'] == 0){
						echo "selected";
						}
						?> >Privatno</option>
			<option value="1"<?php 
					if($rezultat_ispis['slika_status'] == 1){
						echo "selected";
						}
						?>>Javno</option>
		</select>
		<br/>
        <?php
        if(isset($_SESSION["blokiran"]) 
        && $_SESSION["blokiran"] == 0) {
            echo "<input type='submit' name='submitEditSlika' id='submitEditSlika' 
			   value='Ažuriraj sliku' />";
             }
        if(isset($_SESSION["blokiran"]) 
        && $_SESSION["blokiran"] == 1) {
            echo "<p style='color:red'>Ne možete ažurirati slike jer ste blokirani!</p>";
            }
        ?>
	</form>
	<div>
		<?php
			if (isset($greska)) {
				echo "<p style='color:red'>$greska</p>";
			}
			if (isset($_COOKIE['moj_kolacic'])) {
				echo "<p style='color:blue'>{$_COOKIE['moj_kolacic']}</p>";
			}
			if (isset($poruka)) {
				echo "<p style='color:blue'>$poruka</p>";
			}
		?>
	</div>
    <br>
	<br>

    
	<?php
			
        zatvoriVezuNaBazu($veza);
	
	?>
	
	
    </section>
    <footer>
        <hr>
        Luka Baturić
        <p>
            <a href="mailto:lbaturic@foi.unizg.hr">lbaturic@foi.unizg.hr</a>
		</p>
    </footer>

</body>
</html>
