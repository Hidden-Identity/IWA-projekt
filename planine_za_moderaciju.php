<?php 

    session_start();

    if(!isset($_SESSION["id"])) {
        header("Location: prijava.php");
    }

	elseif ($_SESSION["tip_korisnika_id"] == 2) {
		header("Location: index.php");
	}

?>

<?php

	include_once("baza.php");

	$veza = spojiSeNaBazu();
    $id_ulogiranog_korisnika = $_SESSION["id"];
	$id_nove_planine="";


	if(isset($_POST["submitNovaPlanina"])) {
		$greska = "";
		$poruka = "";

		$naziv = $_POST["naziv"];
		$opis = $_POST["opis"];
		$lokacija = $_POST["lokacija"];
		$geografska_sirina = $_POST["geografska_sirina"];
		$geografska_duzina = $_POST["geografska_duzina"];
		

		if(!isset($naziv) || empty($naziv)){
			$greska .= "Niste unijeli naziv planine! <br>";
		}
		if(!isset($opis) || empty($opis)){
			$greska .= "Niste unijeli opis planine! <br>";
		}
		if(!isset($lokacija) || empty($lokacija)){
			$greska .= "Niste unijeli lokaciju planine! <br>";
		}
		if(!isset($geografska_sirina) || empty($geografska_sirina)){
			$greska .= "Niste unijeli geografsku širinu planine! <br>";
		}
		if(!isset($geografska_duzina) || empty($geografska_duzina)){
			$greska .= "Niste unijeli geografsku dužinu planine! <br>";
		}

		if(empty($greska)){

			$upit = "INSERT INTO planina (naziv, opis, lokacija, geografska_sirina, 
			geografska_duzina)
			VALUES ('{$naziv}', '{$opis}', '{$lokacija}', '{$geografska_sirina}', 
			'{$geografska_duzina}')";
			izvrsiUpit($veza, $upit);
			$id_nove_planine = mysqli_insert_id($veza);
			$poruka = "Dodana je nova planina!";
		}
	}



    if($_SESSION["tip_korisnika_id"] == 0) {
        $upit = "SELECT planina.* 
                 FROM planina";
    }
    else {
        $upit = "SELECT planina.*
                 FROM planina
                 INNER JOIN moderator 
                 ON planina.planina_id= moderator.planina_id
                 WHERE moderator.korisnik_id='{$id_ulogiranog_korisnika}'";
    }
	
    
    $rezultat = izvrsiUpit($veza, $upit);


	zatvoriVezuNaBazu($veza);

?>


<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
   <link href="oblikovanje.css" rel="stylesheet" type="text/css">
    <title>Planine za moderaciju</title>
</head>
<body>
    <header>
        <strong>Planine</strong>
    </header>
		
		<?php
		
			include "meni.php";
		
		?>
		
		<section>

		<?php if(isset($_SESSION["tip_korisnika_id"]) 
        && $_SESSION["tip_korisnika_id"] == 0) { ?>

            <form name="forma" id="forma" method="POST" action="
			<?php 
				echo $_SERVER["PHP_SELF"]; 
			?>">
			<strong>Upišite podatke za novu planinu:</strong>
				<br>
				<label for="naziv">Naziv planine: </label>
				<input name="naziv" id="naziv" type="text" />
				<br/>
				<label for="opis">Opis planine: </label>
				<input name="opis" id="opis" type="text" size="100"/>
				<br/>
				<label for="lokacija">Lokacija planine: </label>
				<input name="lokacija" id="lokacija" type="text" />
				<br/>
				<label for="geografska_sirina">Geografska širina planine: </label>
				<input name="geografska_sirina" id="geografska_sirina" type="text" />
				<br/>
				<label for="geografska_duzina">Geografska dužina planine: </label>
				<input name="geografska_duzina" id="geografska_duzina" type="text" /> 
				<br/>
				<input type="submit" name="submitNovaPlanina" id="submitNovaPlanina" 
					   value="Dodaj planinu" />
			</form>
		<?php } ?>

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
			<table style="border-spacing: 0;
						  border-color: rgb(168, 113, 87);"
						  border="1">
				<caption style="text-align: center; 
								background-color: rgb(168, 113, 87);
								font-size: 35px; 
								font-weight: bold; 
								font-family:Georgia, 'Times New Roman', Times, serif; 
								padding: 10px;">
								Ispis planina
				</caption>
				<thead>
					<tr>
						<th>Naziv planine</th>
						<th>Opis planine</th>
						<th>Lokacija planine</th>
						<th>Geografska širina planine</th>
						<th>Geografska dužina planine</th> 
						<?php if($_SESSION["tip_korisnika_id"] == 0) { ?>
                        <th>Promjeni podatke</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
				<?php

					if(isset($rezultat)){

						while($red = mysqli_fetch_array($rezultat)) {

							echo "<tr>";
                            echo "<td><a href='planina_prezime.php?planina={$red["naziv"]}'>
							{$red["naziv"]}</a></td>";
							echo "<td>{$red["opis"]}</td>";
							echo "<td>{$red["lokacija"]}</td>";
							echo "<td>{$red["geografska_sirina"]}</td>";
							echo "<td>{$red["geografska_duzina"]}</td>";
							if($_SESSION["tip_korisnika_id"] == 0) {
                            echo "<td><a href='editiranje_planine.php?id={$red[0]}'>Ažuriraj</a></td>";
							}
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