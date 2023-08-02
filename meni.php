
<nav>
        
        <?php if(isset($_SESSION["tip_korisnika_id"]) 
        && $_SESSION["tip_korisnika_id"] == 0) { ?>
        <a href="index.php" >Početna stranica </a>
        <br>
        <a href="o_autoru.html" >O autoru </a>
        <br>
        <a href="vasa_galerija.php" >Vaša galerija </a>
        <br>
        <a href="planine_za_moderaciju.php" >Planine za moderaciju </a>
        <br>
        <a href="registracija_korisnika.php" >Korisnici </a>
        <br>
        <a href="registracija_moderatori.php" >Moderatori </a>
        <br>
        <a href="broj_slika.php" >Broj slika </a> 
        <br>
        <?php } ?>

        <?php if(isset($_SESSION["tip_korisnika_id"]) 
        && $_SESSION["tip_korisnika_id"] == 1) { ?>

        <a href="index.php" >Početna stranica </a> 
        <br>
        <a href="o_autoru.html" >O autoru </a> 
        <br>
        <a href="vasa_galerija.php" >Vaša galerija </a> 
        <br>
        <a href="planine_za_moderaciju.php" >Planine za moderaciju </a> 
        <br>
        <?php } ?>

        <?php if(isset($_SESSION["tip_korisnika_id"]) 
        && $_SESSION["tip_korisnika_id"] == 2) { ?>

        <a href="index.php" >Početna stranica </a> 
        <br>
        <a href="o_autoru.html" >O autoru </a> 
        <br>
        <a href="vasa_galerija.php" >Vaša galerija </a> 
        <br>
        <?php } ?>
        
        <?php if(!isset($_SESSION["id"])) { ?>
        <a href="index.php" >Početna stranica </a> 
        <br>
        <a href="o_autoru.html" >O autoru </a> 
        <hr>
        <a href="prijava.php" >Prijava </a> 
        <br>

        <?php } else { ?>
        <hr>
        <a href="prijava.php?odjava=1" >Odjava </a> 
        <br>
        <?php } ?>

</nav>