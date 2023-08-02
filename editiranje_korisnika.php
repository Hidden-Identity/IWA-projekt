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
	$id_azuriranja_korisnika = $_GET["id"];


	if(isset($_POST["submitEditKorisnik"])) {
		$greska = "";
		$poruka = "";

		$ime = $_POST["ime"];
		$prezime = $_POST["prezime"];
		$email = $_POST["email"];
		$korisnicko_ime = $_POST["korisnicko_ime"];
		$lozinka = $_POST["lozinka"];
		$blokiran = $_POST["blokiran"];
		$tip_korisnika_id = $_POST["tip_korisnika_id"];
		$slika = $_POST["slika"];
		

		if(!isset($ime) || empty($ime)){
			$greska .= "Niste unijeli ime! <br>";
		}
		if(!isset($prezime) || empty($prezime)){
			$greska .= "Niste unijeli prezime! <br>";
		}
		if(!isset($email) || empty($email)){
			$greska .= "Niste unijeli email! <br>";
		}
		if(!isset($korisnicko_ime) || empty($korisnicko_ime)){
			$greska .= "Niste unijeli korisničko ime! <br>";
		}
		if(!isset($lozinka) || empty($lozinka)){
			$greska .= "Niste unijeli lozinku! <br>";
		}

		if(empty($greska)){

			$upit="UPDATE korisnik SET 
			tip_korisnika_id='{$tip_korisnika_id}',
			korisnicko_ime='{$korisnicko_ime}',
			lozinka='{$lozinka}',
			ime='{$ime}',
			prezime='{$prezime}',
			email='{$email}',
			blokiran='{$blokiran}',
			slika='{$slika}'
			WHERE korisnik_id='{$id_azuriranja_korisnika}'";
			izvrsiUpit($veza, $upit);

			$poruka = "Korisnik $id_azuriranja_korisnika je ažuriran!";
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
			<strong>
			<?php	
				echo "Ažurirajte podatke korisnika $id_azuriranja_korisnika:";
			?>
			</strong>
				<br>
				<label for="ime">Ime: </label>
				<input name="ime" id="ime" type="text" 
				value="<?php echo $rezultat_ispis["ime"];?>"/>
				<br/>
				<label for="prezime">Prezime: </label>
				<input name="prezime" id="prezime" type="text" 
				value="<?php echo $rezultat_ispis["prezime"];?>"/>
				<br/>
				<label for="email">E-mail: </label>
				<input name="email" id="email" type="email" 
				value="<?php echo $rezultat_ispis["email"];?>"/>
				<br/>
				<label for="korisnicko_ime">Korisničko ime: </label>
				<input name="korisnicko_ime" id="korisnicko_ime" type="text" 
				value="<?php echo $rezultat_ispis["korisnicko_ime"];?>"/>
				<br/>
				<label for="lozinka">Lozinka: </label>
				<input name="lozinka" id="lozinka" type="password" 
				value="<?php echo $rezultat_ispis["lozinka"];?>"/>
				<br/>
				<label for="blokiran">Status korisnika: </label>
				<select name="blokiran" id="blokiran" >
					<option value="0"<?php 
					if($rezultat_ispis['blokiran'] == 0){
						echo "selected";
						}
						?> >dozvoljen</option>
					<option value="1"<?php 
					if($rezultat_ispis['blokiran'] == 1){
						echo "selected";
						}
						?> >blokiran</option>
				</select>
				<br/>
				<label for="tip_korisnika_id">Tip korisnika: </label>
				<select name="tip_korisnika_id" id="tip_korisnika_id" >

					<option value="0"<?php 
					if($rezultat_ispis['tip_korisnika_id'] == 0){
						echo "selected";
						}
						?> >administrator</option>
					<option value="1"<?php 
					if($rezultat_ispis['tip_korisnika_id'] == 1){
						echo "selected";
						}
						?> >moderator</option>
					<option value="2"<?php 
					if($rezultat_ispis['tip_korisnika_id'] == 2){
						echo "selected";
						}
						?> >korisnik</option>
				</select>
				<br/>
				<label for="slika">Slika korisnika: </label>
				<input name="slika" id="slika" type="text" placeholder="korisnici/ime_slike.jpg"
				value="<?php echo $rezultat_ispis["slika"];?>" />
				<br/>
				<input type="submit" name="submitEditKorisnik" id="submitEditKorisnik" 
					   value="Ažuriraj korisnika" />
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