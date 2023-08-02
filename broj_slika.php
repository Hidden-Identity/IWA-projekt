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

 $upit = "SELECT korisnik.ime AS ime, 
                 korisnik.prezime AS prezime, 
                 COUNT(CASE WHEN status = 1 THEN 1 END) AS broj_javnih_slika,
                 COUNT(CASE WHEN status = 0 THEN 1 END) AS broj_privatnih_slika
                 FROM korisnik, slika 
                 WHERE korisnik.korisnik_id=slika.korisnik_id 
                 GROUP BY korisnik.korisnik_id 
                 ORDER BY korisnik.prezime";

    $rezultat = izvrsiUpit($veza, $upit);


	zatvoriVezuNaBazu($veza);
?>

<!DOCTYPE html>
    <html lang="hr">
    <head>
        <meta charset="UTF-8">
       <link href="oblikovanje.css" rel="stylesheet" type="text/css">
        <title>Broj slika</title>
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
						  border="1">
				<caption style="text-align: center; 
								background-color: rgb(168, 113, 87);
								font-size: 35px; 
								font-weight: bold; 
								font-family:Georgia, 'Times New Roman', Times, serif; 
								padding: 10px;">
								Broj slika
				</caption>
				<thead>
					<tr>
						<th>Ime</th>
                        <th>Prezime</th>
                        <th>Broj slika u javnoj galeriji</th>
                        <th>Broj slika u privatnoj galeriji</th>
					</tr>
				</thead>
				<tbody>
				<?php

					if(isset($rezultat)){

						while($red = mysqli_fetch_array($rezultat)) {

							echo "<tr>";
							echo "<td>{$red["ime"]}</td>";
                            echo "<td>{$red["prezime"]}</td>";
                            echo "<td>{$red["broj_javnih_slika"]}</td>";
                            echo "<td>{$red["broj_privatnih_slika"]}</td>";
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












