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

    error_reporting (E_ALL ^ E_NOTICE);


	include_once("baza.php");

	$veza = spojiSeNaBazu();

    $prezime_korisnika = $_GET["korisnik"];
    $naziv_planine = $_GET["planina"];
    $planina_pretraga = $_GET["planina_pretraga"];
    $prvi_datum = $_GET["prvi_datum"];
    $drugi_datum = $_GET["drugi_datum"];



	if(isset($naziv_planine)) {
    $upit = "SELECT slika.*,
                    planina.naziv AS planina_naziv, 
                    korisnik.ime AS korisnik_ime, 
                    korisnik.prezime AS korisnik_prezime
                    FROM slika, planina, korisnik 
                    WHERE status=1
                    AND planina.planina_id=slika.planina_id
                    AND korisnik.korisnik_id=slika.korisnik_id
                    AND planina.naziv= '{$naziv_planine}'
                    ORDER BY datum_vrijeme_slikanja DESC";
    } 
    else {
        header("Location: index.php");
    }

    

	$rezultat = izvrsiUpit($veza, $upit);


	zatvoriVezuNaBazu($veza);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
   <link href="oblikovanje.css" rel="stylesheet" type="text/css">
    <title>Početna stranica</title>
</head>
<body>
    <header>
        <strong>Hrvatske Planine</strong>
    </header>
    
    <?php
        include 'meni.php'
    ?>

    <section>
    <form name="pretraga" id="pretraga" method="GET" action="
    <?php 
        echo $_SERVER['PHP_SELF'];
    ?>">
    <strong>Pretražite galeriju prema nazivu i/ili datumu:</strong>
        <br>
        <label for="planina_pretraga">Naziv planine:</label>
		<input name="planina_pretraga" id="planina_pretraga" type="text" 
        value="<?php if(isset($planina_pretraga)) {
        echo $planina_pretraga;
        }
        ?>"/>
        <br>
		<label for="prvi_datum">Datum od </label>
		<input name="prvi_datum" id="prvi_datum" type="text" 
        placeholder="DD.MM.YYYY hh:mm:ss" 
        value="<?php if(isset($prvi_datum)) {
        echo $prvi_datum;
        }
        ?>"/>
        <label for="drugi_datum">do </label>
		<input name="drugi_datum" id="drugi_datum" type="text" 
        placeholder="DD.MM.YYYY hh:mm:ss" 
        value="<?php if(isset($drugi_datum)) {
        echo $drugi_datum;
        }
        ?>"/>
        <br>
        <input type="submit" name="submit" id="submit" 
					   value="Pretraži" />
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
								Javna galerija
				</caption>
				<thead>
					<tr>
                        <?php if(isset($naziv_planine)) { ?>
						<th>Slika</th>
                        <th colspan="2">Postavio</th>
                        <th></th>
                        <?php } ?>
					</tr>
				</thead>
				<tbody>
				<?php

					if(isset($rezultat)){

						while($red = mysqli_fetch_array($rezultat)) {

							echo "<tr>";
							echo "<td><a href='detalji_slike.php?id={$red[0]}'>
                            <img src='{$red["url"]}' width='592' height='412' /></a></td>";
                            if(isset($naziv_planine)) {
                            echo "<td>{$red["korisnik_ime"]}</td>";
							echo "<td><a href='index.php?korisnik={$red["korisnik_prezime"]}'> 
							{$red["korisnik_prezime"]}</a></td>";
                            }
                            echo "<td><a href='blokiraj.php?id={$red["korisnik_id"]}'>Blokiraj</a></td>";
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