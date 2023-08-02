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
	$id_azuriranja_korisnika = $_GET["id"];

	if(isset($_POST["Ne"])) {
		header("Location: planine_za_moderaciju.php");
	}


	if(isset($_POST["submitEditKorisnik"])) {
		$greska = "";
		$poruka = "";

		$blokiran = $_POST["blokiran"];
		if(empty($greska)){


			$upit="UPDATE korisnik, slika SET
			korisnik.blokiran='{$blokiran}',
			slika.status= 0
			WHERE korisnik.korisnik_id='{$id_azuriranja_korisnika}'
			AND slika.korisnik_id= '{$id_azuriranja_korisnika}'";
			izvrsiUpit($veza, $upit);

			header("Location: index.php");
		}
	}


	$upit = "SELECT * FROM korisnik WHERE korisnik_id='{$id_azuriranja_korisnika}'";
	$rezultat = izvrsiUpit($veza, $upit);
	$rezultat_ispis = mysqli_fetch_array($rezultat);


	zatvoriVezuNaBazu($veza);

?>


<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
   <link href="oblikovanje.css" rel="stylesheet" type="text/css">
    <title>Ažuriranje korisnika</title>
</head>
<body>
    <header>
        <strong>Ažuriranje korisnika</strong>
    </header>
		
		<?php
		
			include "meni.php";
		
		?>
		
		<section>

			<form name="forma" id="forma" method="POST" action="
			<?php 
				echo $_SERVER["PHP_SELF"]. "?id={$id_azuriranja_korisnika}"; 
			?>">
			<br>
				<label style="visibility:hidden" for="blokiran">Status korisnika: </label>
				<select style="visibility:hidden" name="blokiran" id="blokiran" >
					<option value="1" selected >blokiran</option>
				</select>
				<br/>
				<strong>
			<?php	
				echo "Jeste li sigurni da želite blokirati korisnika {$rezultat_ispis["ime"]} {$rezultat_ispis["prezime"]}? ";
			?>
			</strong>
			<br/>
			<br/>
				<input type="submit" name="submitEditKorisnik" id="submitEditKorisnik" 
					   value="Da" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" name="Ne" id="Ne" 
					   value="Ne" />
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