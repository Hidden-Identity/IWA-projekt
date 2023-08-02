<?php 
    

    session_start();

?>

<?php 

	include_once("baza.php");

	$veza = spojiSeNaBazu();
	$id_slike = $_GET["id"];



	$upit = "SELECT slika.slika_id AS slika_id, 
					slika.url AS slika_url, 
					slika.naziv AS slika_naziv, 
					slika.opis AS slika_opis, 
					slika.datum_vrijeme_slikanja AS slika_datum_vrijeme_slikanja, 
					planina.naziv AS planina_naziv, 
					planina.opis AS planina_opis, 
					korisnik.ime AS korisnik_ime,
					korisnik.prezime AS korisnik_prezime
					FROM slika, planina, korisnik 
					WHERE planina.planina_id=slika.planina_id
					AND korisnik.korisnik_id=slika.korisnik_id
					AND slika.slika_id='{$id_slike}'";
	$rezultat = izvrsiUpit($veza, $upit);


	zatvoriVezuNaBazu($veza);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
   <link href="oblikovanje.css" rel="stylesheet" type="text/css">
    <title>O slici</title>
</head>
<body>
    <header>
        <strong>Hrvatske Planine</strong>
    </header>
    
    <?php
        include 'meni.php'
    ?>

    <section>
    <table style="border-spacing: 0;
						  border-color: rgb(168, 113, 87);"
						  border="1" align="center">
				<caption style="text-align: center; 
								background-color: rgb(168, 113, 87);
								font-size: 35px; 
								font-weight: bold; 
								font-family:Georgia, 'Times New Roman', Times, serif; 
								padding: 10px;">
								O slici
				</caption>
				<thead>
					<tr>
						<th>Slika</th>
						<th>Naziv slike</th>
						<th>Opis slike</th>
						<th>Datum i vrijeme slikanja</th>
						<th>Planina</th>
						<th>Opis planine</th>
						<th colspan="2">Postavio</th>
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
							echo "<td><a href='index.php?planina={$red["planina_naziv"]}'>
							{$red["planina_naziv"]}</a></td>";
							echo "<td>{$red["planina_opis"]}</td>";
							echo "<td>{$red["korisnik_ime"]}</td>";
							echo "<td><a href='index.php?korisnik={$red["korisnik_prezime"]}'> 
							{$red["korisnik_prezime"]}</a></td>";
							echo "</tr>";
						}
					}
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