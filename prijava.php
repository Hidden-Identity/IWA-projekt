<?php
	session_start();
	
	if(isset($_GET["odjava"])) {
		unset($_SESSION["id"]);
		unset($_SESSION["ime"]);
		unset($_SESSION["prezime"]);
		unset($_SESSION["tip_korisnika_id"]);
		session_destroy();
	}

	

	include_once("baza.php");

	$veza = spojiSeNaBazu();


	if(isset($_POST["submit"])) {
		$greska = "";
		$poruka = "";
		$korisnicko_ime = $_POST["korisnicko_ime"];

		if(isset($korisnicko_ime) && !empty($korisnicko_ime)
			&& isset($_POST["lozinka"]) && !empty($_POST["lozinka"])) {

				$upit = "SELECT * FROM korisnik
				WHERE korisnicko_ime='{$korisnicko_ime}'
				AND lozinka='{$_POST["lozinka"]}'";

				$rezultat = izvrsiUpit($veza, $upit);

				$prijava = false;
				while($red = mysqli_fetch_array($rezultat)){
					$prijava = true;

					$_SESSION["id"] = $red[0];
					$_SESSION["ime"] = $red["ime"];
					$_SESSION["prezime"] = $red["prezime"];
					$_SESSION["tip_korisnika_id"] = $red["tip_korisnika_id"];
					$_SESSION["blokiran"] = $red["blokiran"];
				}

				if($prijava) {
					$poruka = "Korisnik ulogiran";

					header("Location: index.php");
					exit();
				}
				else {
					$greska = "Korisničko ime i/ili lozinka se ne podudaraju!";
				}
		}
		else {
			$greska = "Niste upisali korisničko ime i/ili lozinku!";
		}
	}


	zatvoriVezuNaBazu($veza);

?>


<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
   <link href="oblikovanje.css" rel="stylesheet" type="text/css">
    <title>Prijava</title>
</head>
<body>
    <header>
        <strong>Prijava</strong>
    </header>
		
		<?php
		
			include "meni.php";
		
		?>
		
		<section>

			<form name="forma" id="forma" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
				<label for="korisnicko_ime">Korisničko ime: </label>
				<input name="korisnicko_ime" id="korisnicko_ime" type="text" />
				<br/>
				<label for="lozinka">Lozinka: </label>
				<input name="lozinka" id="lozinka" type="password" />
				<br/>
				<input type="submit" name="submit" id="submit" 
					   value="Prijava" />
			</form>
			<div>
				<?php
					if (isset($greska)) {
						echo "<p style='color:red'>$greska</p>";
					}
					if (isset($_COOKIE['moj_kolacic'])) {
						echo "<p style='color:blue'>{$_COOKIE['moj_kolacic']}</p>";
					}
				?>
			</div>

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