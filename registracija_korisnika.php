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
	$id_novi_korisnik="";


	if(isset($_POST["submitNoviKorisnik"])) {
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

			$upit = "INSERT INTO korisnik (tip_korisnika_id, korisnicko_ime, lozinka, ime, 
			prezime, email, blokiran)
			VALUES ('{$tip_korisnika_id}', '{$korisnicko_ime}', '{$lozinka}', '{$ime}', 
			'{$prezime}', '{$email}', '{$blokiran}', '{$slika}')";
			izvrsiUpit($veza, $upit);
			$id_novi_korisnik = mysqli_insert_id($veza);
			$poruka = "Dodan je novi korisnik pod ključem $id_novi_korisnik";
		}
	}


	$upit = "SELECT * FROM korisnik";
	$rezultat = izvrsiUpit($veza, $upit);


	zatvoriVezuNaBazu($veza);

?>


<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
   <link href="oblikovanje.css" rel="stylesheet" type="text/css">
    <title>Korisnici</title>
</head>
<body>
    <header>
        <strong>Dodavanje korisnika</strong>
    </header>
		
		<?php
		
			include "meni.php";
		
		?>
		
		<section>

			<form name="forma" id="forma" method="POST" action="
			<?php 
				echo $_SERVER["PHP_SELF"]; 
			?>">
			<strong>Upišite podatke za novog korisnika:</strong>
				<br>
				<label for="ime">Ime: </label>
				<input name="ime" id="ime" type="text" />
				<br/>
				<label for="prezime">Prezime: </label>
				<input name="prezime" id="prezime" type="text" />
				<br/>
				<label for="email">E-mail: </label>
				<input name="email" id="email" type="email" />
				<br/>
				<label for="korisnicko_ime">Korisničko ime: </label>
				<input name="korisnicko_ime" id="korisnicko_ime" type="text" />
				<br/>
				<label for="lozinka">Lozinka: </label>
				<input name="lozinka" id="lozinka" type="password" />
				<br/>
				<label for="blokiran">Status korisnika: </label>
				<select name="blokiran" id="blokiran">
					<option value="0" selected>dozvoljen</option>
					<option value="1">blokiran</option>
				</select>
				<br/>
				<label for="tip_korisnika_id">Tip korisnika: </label>
				<select name="tip_korisnika_id" id="tip_korisnika_id">

					<option value="0">administrator</option>
					<option value="1">moderator</option>
					<option value="2" selected>korisnik</option>
				</select>
				<br/>
				<label for="slika">Slika korisnika: </label>
				<input name="slika" id="slika" type="text" placeholder="korisnici/ime_slike.jpg"/>
				<br/>
				<input type="submit" name="submitNoviKorisnik" id="submitNoviKorisnik" 
					   value="Dodaj korisnika" />
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
			<table style="border-spacing: 0;
						  border-color: rgb(168, 113, 87);"
						  border="1">
				<caption style="text-align: center; 
								background-color: rgb(168, 113, 87);
								font-size: 35px; 
								font-weight: bold; 
								font-family:Georgia, 'Times New Roman', Times, serif; 
								padding: 10px;">
								Ispis postojećih korisnika
				</caption>
				<thead>
					<tr>
						<th>ID korisnika</th>
						<th>Ime</th>
						<th>Prezime</th>
						<th>E-mail</th>
						<th>Korisničko ime</th>
						<th>Blokiran</th>
						<th>Tip korisnika</th>
						<th>Slika</th>
						<th>Promjeni podatke</th>
					</tr>
				</thead>
				<tbody>
				<?php

					if(isset($rezultat)){

						while($red = mysqli_fetch_array($rezultat)) {

							echo "<tr>";
							echo "<td>{$red[0]}</td>";
							echo "<td>{$red["ime"]}</td>";
							echo "<td>{$red["prezime"]}</td>";
							echo "<td>{$red["email"]}</td>";
							echo "<td>{$red["korisnicko_ime"]}</td>";
							echo "<td>{$red["blokiran"]}</td>";
							echo "<td>{$red["tip_korisnika_id"]}</td>";
							echo "<td><img src='{$red["slika"]}' width='75' height='100'/></td>";
							echo "<td><a href='editiranje_korisnika.php?id={$red[0]}'>Ažuriraj</a></td>";
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