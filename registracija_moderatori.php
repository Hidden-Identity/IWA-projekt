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
	$id_novi_moderator="";


	if(isset($_POST["submitNoviModerator"])) {
		$greska = "";
		$poruka = "";

		$planina_id = $_POST["planina_id"];
		$korisnik_id = $_POST["korisnik_id"];
		
		if(empty($greska)){

			$upit = "INSERT INTO moderator (korisnik_id, planina_id)
			VALUES ('{$korisnik_id}', '{$planina_id}')";
			izvrsiUpit($veza, $upit);
			$poruka = "Dodan je novi moderator!";
		}
	}


	$upit = "SELECT * FROM korisnik
					  WHERE tip_korisnika_id = 1 ";
	$rezultat = izvrsiUpit($veza, $upit);



?>


<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
   <link href="oblikovanje.css" rel="stylesheet" type="text/css">
    <title>Moderatori</title>
</head>
<body>
    <header>
        <strong>Moderatori</strong>
    </header>
		
		<?php
		
			include "meni.php";
		
		?>
		
		<section>
			
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

			<form name="forma" id="forma" method="POST" action="
			<?php 
				echo $_SERVER["PHP_SELF"]; 
			?>">
			<strong>Odaberite planinu i moderatore za nj:</strong>
				<br>
				<label for="planina_id">Planina: </label>
				<select name="planina_id" id="planina_id">
       			<?php
            		$lista_planina = "SELECT planina.* FROM planina";
            		$rezultat_lista_planina = izvrsiUpit($veza, $lista_planina);

            		if(isset($rezultat_lista_planina)) {

                		while($red = mysqli_fetch_array($rezultat_lista_planina)) {
                   		 echo "<option value='{$red["planina_id"]}'>{$red["naziv"]}</option>";
               		 	}
            		}
					
        		?>
				<br/>
				<input type="submit" name="submitNoviModerator" id="submitNoviModerator" 
					   value="Dodaj moderatora" />
				<br/>

				<label for="korisnik_id">Korisnici: </label>
				<br/>
				<?php
					
					if(isset($rezultat)){
						while($red = mysqli_fetch_array($rezultat)) {
							echo "<input type='checkbox' name='korisnik_id' id='korisnik_id' 
							value='{$red["korisnik_id"]}'/> {$red["ime"]} {$red["prezime"]}<br/>";
						}
					}
				
					zatvoriVezuNaBazu($veza);
				?>
			</form>
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