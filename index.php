<?php 
    

    session_start();

?>

<?php 

    error_reporting (E_ALL ^ E_NOTICE);


	include_once("baza.php");

	$veza = spojiSeNaBazu();
    $prezime_korisnika = $_GET["korisnik"];
    $naziv_planine = $_GET["planina"];
    $prvi_datum_get = $_GET["prvi_datum"];
    $drugi_datum_get = $_GET["drugi_datum"];
    
    

    $planina_pretraga = $_GET["planina_pretraga"];

    if(!isset($prvi_datum_get) && !isset($drugi_datum_get)) {
        
    if(isset($planina_pretraga)) {
        
        $upit = "SELECT SELECT slika.*, 
        planina.naziv
        FROM slika, planina 
        WHERE status=1
        AND planina.planina_id=slika.planina_id
        AND planina.naziv LIKE '%{$planina_pretraga}%'";
        }

	if(isset($naziv_planine)) {
    $upit = "SELECT slika.*,
                    planina.naziv AS planina_naziv 
                    FROM slika, planina 
                    WHERE status=1
                    AND planina.planina_id=slika.planina_id
                    AND planina.naziv= '{$naziv_planine}'
                    ORDER BY datum_vrijeme_slikanja DESC";
    }
    if(isset($prezime_korisnika)) {
        $upit = "SELECT slika.*, 
                        korisnik.ime AS korisnik_ime,
                        korisnik.prezime AS korisnik_prezime 
                        FROM slika, korisnik 
                        WHERE status=1
                        AND korisnik.korisnik_id=slika.korisnik_id
                        AND korisnik.prezime= '{$prezime_korisnika}'
                        ORDER BY datum_vrijeme_slikanja DESC";
    }                   
    if(!isset($prezime_korisnika) && !isset($naziv_planine) && !isset($prvi_datum_get)) {
    $upit = "SELECT slika.* 
                    FROM slika 
                    WHERE status=1
                    ORDER BY datum_vrijeme_slikanja DESC";
    
    }

} else {
        $prvi_datum = date("Y-m-d H:i:s", strtotime($_GET["prvi_datum"]));
        $drugi_datum = date("Y-m-d H:i:s", strtotime($_GET["drugi_datum"]));

        
        
        if(!isset($planina_pretraga) && isset($prvi_datum) && isset($drugi_datum)) {
        $upit = "SELECT slika.*,
                        FROM slika
                        WHERE status=1
                        AND datum_vrijeme_slikanja 
                        BETWEEN CAST('{$prvi_datum}' AS DATETIME) 
                        AND CAST('{$drugi_datum}' AS DATETIME)
                        ORDER BY datum_vrijeme_slikanja DESC";
        }
        

        if(isset($planina_pretraga) && isset($prvi_datum) && isset($drugi_datum)) {
            $upit = "SELECT slika.*, 
                            planina.naziv
                            FROM slika, planina 
                            WHERE status=1
                            AND planina.planina_id=slika.planina_id
                            AND planina.naziv LIKE '%{$planina_pretraga}%'
                            AND datum_vrijeme_slikanja 
                            BETWEEN CAST('{$prvi_datum}' AS DATETIME) 
                            AND CAST('{$drugi_datum}' AS DATETIME)
                            ORDER BY datum_vrijeme_slikanja DESC"
                            ;
        }
        
}

	$rezultat = izvrsiUpit($veza, $upit);


	
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
		<input name="planina_pretraga" id="planina_pretraga" type="text" value="<?php echo  $_GET['planina_pretraga']?>" />
        <br>
		<label for="prvi_datum">Datum od </label>
		<input name="prvi_datum" id="prvi_datum" type="text" 
        placeholder="DD.MM.YYYY hh:mm:ss" value="<?php echo  $_GET['prvi_datum'] ? $_GET['prvi_datum'] : '01.01.2000. 00:00:00' ?>"/>
        <label for="drugi_datum">do </label>
		<input name="drugi_datum" id="drugi_datum" type="text" 
        placeholder="DD.MM.YYYY hh:mm:ss" value="<?php echo  $_GET['drugi_datum'] ? $_GET['drugi_datum'] : '01.01.2100. 00:00:00' ?>"/>
        <br>
        <input type="submit" name="submitPretrazi" id="submitPretrazi" 
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
						<th style="display:none">Slika</th>
					</tr>
				</thead>
				<tbody>
				<?php

					if(isset($rezultat)){

						while($red = mysqli_fetch_array($rezultat)) {

							echo "<tr>";
							echo "<td><a href='detalji_slike.php?id={$red[0]}'>
                            <img src='{$red["url"]}' width='592' height='412' /></a></td>";
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