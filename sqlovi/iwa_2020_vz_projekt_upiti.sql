#odabir svih korisnika
SELECT * FROM korisnik;

#odabir slika i naziva
SELECT naziv, url FROM slika;

#odabir svih moderatora
SELECT * FROM korisnik WHERE tip_korisnika_id = 1;

#odabir svih javinih slika planine 1
SELECT * FROM slika WHERE status=1 AND planina_id=1

#odabir svih planina za koje je zadužen moderator 2
SELECT p.naziv as planina FROM planina p, moderator m WHERE m.planina_id=p.planina_id AND m.korisnik_id = 2

#Popis svih javnih slika sa imenom i prezimenom osobe za planinu 1
SELECT k.ime as ime, k.prezime as prezime, s.naziv as slika, s.url as url FROM korisnik k, slika s WHERE s.korisnik_id=k.korisnik_id AND s.status=1 AND s.planina_id=1

#odabir svih javnih slika korisnika 1 sa nazivom planine
SELECT s.*, p.naziv as planina FROM slika s, planina p WHERE s.planina_id=p.planina_id AND s.status=1 AND s.korisnik_id=3

#odabir javnih slika filtrirano po datumu i vremenu slikanja
SELECT * FROM slika WHERE status=1 AND datum_vrijeme_slikanja BETWEEN '2020-10-01 10:00:00' AND '2020-10-15 13:00:00'

#odabir javnih slika filtrirano po planini 1 i vremenskog razdoblja slikanja
SELECT * FROM slika WHERE planina_id=1 AND status=1 AND datum_vrijeme_slikanja BETWEEN '2020-10-01 10:00:00' AND '2020-10-15 13:00:00'

#statistika broja javnih slika po korisniku sortirano po prezimenu korisnika
SELECT k.ime as ime, k.prezime as prezime, COUNT(*) as broj_slika FROM korisnik k, slika s WHERE status=1 and k.korisnik_id=s.korisnik_id GROUP BY k.korisnik_id ORDER BY k.prezime
