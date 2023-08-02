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
    $id_nove_slike="";


	if(isset($_POST["submitNovaSlika"])) {
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

			$upit = "INSERT INTO slika (planina_id, korisnik_id, naziv, url, 
			opis, datum_vrijeme_slikanja, status)
			VALUES ('{$planina}', '{$id_ulogiranog_korisnika}', '{$naziv}', '{$url}', 
			'{$opis}', '{$datum_vrijeme_slikanja}', '{$status}')";
			izvrsiUpit($veza, $upit);
			$id_nove_slike = mysqli_insert_id($veza);
			$poruka = "Dodali ste novu sliku!";
		}
	}


    
        $upit = "SELECT slika.slika_id AS slika_id, 
					slika.url AS slika_url, 
					slika.naziv AS slika_naziv, 
					slika.opis AS slika_opis, 
					slika.datum_vrijeme_slikanja AS slika_datum_vrijeme_slikanja,
                    slika.status AS slika_status, 
					planina.naziv AS planina_naziv, 
					planina.opis AS planina_opis, 
					korisnik.ime AS korisnik_ime,
					korisnik.prezime AS korisnik_prezime 
                    FROM slika, planina, korisnik 
                    WHERE planina.planina_id=slika.planina_id
                    AND korisnik.korisnik_id='{$id_ulogiranog_korisnika}'
                    AND korisnik.korisnik_id=slika.korisnik_id
                    ORDER BY datum_vrijeme_slikanja DESC ";
    

	$rezultat = izvrsiUpit($veza, $upit);


?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
   <link href="oblikovanje.css" rel="stylesheet" type="text/css">
    <title>Vaša galerija</title>
</head>
<body>
    <header>
        <strong>Unesite sliku</strong>
    </header>
    
    <?php
        include 'meni.php'
    ?>

    <section>
    <form name="forma" id="forma" method="POST" action="
    <?php 
        echo $_SERVER["PHP_SELF"]; 
    ?>">
	<strong>Dodajte novu sliku:</strong>
		<br>
		<label for="planina">Planina: </label>
		<select name="planina" id="planina">
        <?php
            $lista_planina = "SELECT planina.* FROM planina";
            $rezultat_lista_planina = izvrsiUpit($veza, $lista_planina);

            if(isset($rezultat_lista_planina)) {

                while($red = mysqli_fetch_array($rezultat_lista_planina)) {
                    echo "<option value='{$red["planina_id"]}'>{$red["naziv"]}</option>";
                }
            }
        ?>
        </select>
		<br/>
		<label for="url">URL do slike: </label>
		<input name="url" id="url" type="text" size="100"/>
		<br/>
		<label for="datum_vrijeme_slikanja">Datum i vrijeme slikanja: </label>
		<input name="datum_vrijeme_slikanja" id="datum_vrijeme_slikanja" type="text" />
		<br/>
        <label for="naziv">Naziv slike: </label>
		<input name="naziv" id="naziv" type="text" />
		<br/>
		<label for="opis">Opis slike: </label>
		<input name="opis" id="opis" type="text" size="100"/> 
		<br/>
		<label for="status">Objava: </label>
		<select name="status" id="status">
			<option value="0" >Privatno</option>
			<option value="1" selected>Javno</option>
		</select>
		<br/>
        <?php
        if(isset($_SESSION["blokiran"]) 
        && $_SESSION["blokiran"] == 0) {
            echo "<input type='submit' name='submitNovaSlika' id='submitNovaSlika' 
			   value='Dodaj sliku' />";
             }
        if(isset($_SESSION["blokiran"]) 
        && $_SESSION["blokiran"] == 1) {
            echo "<p style='color:red'>Ne možete dodavati slike jer ste blokirani!</p>";
            }
        ?>
	</form>
    <br>
	<br>
    <?php 
        
    ?>
        <table style="border-spacing: 0;
						  border-color: rgb(168, 113, 87);"
						  border="1">
				<caption style="text-align: center; 
								background-color: rgb(168, 113, 87);
								font-size: 35px; 
								font-weight: bold; 
								font-family:Georgia, 'Times New Roman', Times, serif; 
								padding: 10px;">
								Vaša galerija
				</caption>
				<thead>
					<tr>
                    <th>Slika</th>
						<th>Naziv slike</th>
						<th>Opis slike</th>
						<th>Datum i vrijeme slikanja</th>
						<th>Planina</th>

						<th colspan="2">Postavio</th>
                        <th>Status</th>
						<th>Promjeni podatke</th>
					</tr>
				</thead>
				<tbody>
				<?php

					if(isset($rezultat)){

						while($red = mysqli_fetch_array($rezultat)) {
					$dohvaceni_datum = date_create(($red["slika_datum_vrijeme_slikanja"]));
					$hrv_datum = date_format($dohvaceni_datum, "d.m.Y h:i:s");
							echo "<tr>";
							echo "<td><a href='detalji_slike.php?id={$red[0]}'>
                            <img src='{$red["slika_url"]}' width='592' height='412' /></a></td>";
							echo "<td>{$red["slika_naziv"]}</td>";
							echo "<td>{$red["slika_opis"]}</td>";
							echo "<td>{$hrv_datum}</td>";
							echo "<td>{$red["planina_naziv"]}</td>";
							echo "<td>{$red["korisnik_ime"]}</td>";
							echo "<td><a href='index.php?korisnik={$red["korisnik_prezime"]}'> 
							{$red["korisnik_prezime"]}</a></td>";
                            echo "<td>{$red["slika_status"]}</td>";
                            echo "<td><a href='editiranje_galerija.php?id={$red[0]}'>Ažuriraj</a></td>";
							echo "</tr>";
						}
					}
                    zatvoriVezuNaBazu($veza);
				?>
				</tbody>
			</table>
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
