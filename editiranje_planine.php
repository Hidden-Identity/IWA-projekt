<?php 

    session_start();

    if(!isset($_SESSION["id"])) {
        header("Location: prijava.php");
    }

	elseif ($_SESSION["tip_korisnika_id"] != 0) {
		header("Location: index.php");
	}

?>

<?php

	include_once("baza.php");

	$veza = spojiSeNaBazu();
	$id_azuriranja_planine= $_GET["id"];


	if(isset($_POST["submitEditPlanina"])) {
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

			$upit = "UPDATE planina SET
			naziv='{$naziv}',
			opis='{$opis}',
			lokacija='{$lokacija}',
			geografska_sirina='{$geografska_sirina}',
			geografska_duzina='{$geografska_duzina}'
			WHERE planina_id='{$id_azuriranja_planine}'";
			izvrsiUpit($veza, $upit);
			$id_nove_planine = mysqli_insert_id($veza);
			$poruka = "Ažurirana je planina pod ključem $id_azuriranja_planine!";
		}
	}


	$upit = "SELECT * FROM planina WHERE planina_id='{$id_azuriranja_planine}'";
    $rezultat = izvrsiUpit($veza, $upit);
	$rezultat_ispis = mysqli_fetch_array($rezultat);


	zatvoriVezuNaBazu($veza);

?>


<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
   <link href="oblikovanje.css" rel="stylesheet" type="text/css">
    <title>Ažuriranje planine</title>
</head>
<body>
    <header>
        <strong>Ažuriranje planine</strong>
    </header>
		
		<?php
		
			include "meni.php";
		
		?>
		
		<section>

		<?php if(isset($_SESSION["tip_korisnika_id"]) 
        && $_SESSION["tip_korisnika_id"] == 0) { ?>

            <form name="forma" id="forma" method="POST" action="
			<?php 
				echo $_SERVER["PHP_SELF"]. "?id={$id_azuriranja_planine}"; 
			?>">
			<strong>
			<?php	
				echo "Ažurirajte podatke planine $id_azuriranja_planine:";
			?>
			</strong>
				<br>
				<label for="naziv">Naziv planine: </label>
				<input name="naziv" id="naziv" type="text" 
				value="<?php echo $rezultat_ispis["naziv"];?>"/>
				<br/>
				<label for="opis">Opis planine: </label>
				<input name="opis" id="opis" type="text" size="100" 
				value="<?php echo $rezultat_ispis["opis"];?>"/>
				<br/>
				<label for="lokacija">Lokacija planine: </label>
				<input name="lokacija" id="lokacija" type="text" 
				value="<?php echo $rezultat_ispis["lokacija"];?>"/>
				<br/>
				<label for="geografska_sirina">Geografska širina planine: </label>
				<input name="geografska_sirina" id="geografska_sirina" type="text" 
				value="<?php echo $rezultat_ispis["geografska_sirina"];?>"/>
				<br/>
				<label for="geografska_duzina">Geografska dužina planine: </label>
				<input name="geografska_duzina" id="geografska_duzina" type="text" 
				value="<?php echo $rezultat_ispis["geografska_duzina"];?>"/> 
				<br/>
				<input type="submit" name="submitEditPlanina" id="submitEditPlanina" 
					   value="Ažuriraj planinu" />
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