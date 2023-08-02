SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
USE `iwa_2020_vz_projekt` ;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

INSERT INTO `tip_korisnika` (`tip_korisnika_id`, `naziv`) VALUES
(0, 'administrator'),
(1, 'voditelj'),
(2, 'korisnik');


INSERT INTO `korisnik` (`blokiran`,`korisnik_id`, `tip_korisnika_id`, `korisnicko_ime`, `lozinka`, `ime`, `prezime`, `email`, `slika`) VALUES
(0,1, 0, 'admin', 'foi', 'Administrator', 'Admin', 'admin@foi.hr', 'korisnici/admin.jpg'),
(0,2, 1, 'voditelj', '123456', 'voditelj', 'Vodi', 'voditelj@foi.hr', 'korisnici/admin.jpg'),
(0,3, 2, 'pkos', '123456', 'Pero', 'Kos', 'pkos@fff.hr', 'korisnici/pkos.jpg'),
(0,4, 2, 'vzec', '123456', 'Vladimir', 'Zec', 'vzec@fff.hr', 'korisnici/vzec.jpg'),
(0,5, 2, 'qtarantino', '123456', 'Quentin', 'Tarantino', 'qtarantino@foi.hr', 'korisnici/qtarantino.jpg'),
(0,6, 2, 'mbellucci', '123456', 'Monica', 'Bellucci', 'mbellucci@foi.hr', 'korisnici/mbellucci.jpg'),
(0,7, 2, 'vmortensen', '123456', 'Viggo', 'Mortensen', 'vmortensen@foi.hr', 'korisnici/vmortensen.jpg'),
(0,8, 2, 'jgarner', '123456', 'Jennifer', 'Garner', 'jgarner@foi.hr', 'korisnici/jgarner.jpg'),
(0,9, 2, 'nportman', '123456', 'Natalie', 'Portman', 'nportman@foi.hr', 'korisnici/nportman.jpg'),
(0,10, 2, 'dradcliffe', '123456', 'Daniel', 'Radcliffe', 'dradcliffe@foi.hr', 'korisnici/dradcliffe.jpg'),
(0,11, 2, 'hberry', '123456', 'Halle', 'Berry', 'hberry@foi.hr', 'korisnici/hberry.jpg'),
(0,12, 2, 'vdiesel', '123456', 'Vin', 'Diesel', 'vdiesel@foi.hr', 'korisnici/vdiesel.jpg'),
(0,13, 2, 'ecuthbert', '123456', 'Elisha', 'Cuthbert', 'ecuthbert@foi.hr', 'korisnici/ecuthbert.jpg'),
(0,14, 2, 'janiston', '123456', 'Jennifer', 'Aniston', 'janiston@foi.hr', 'korisnici/janiston.jpg'),
(0,15, 2, 'ctheron', '123456', 'Charlize', 'Theron', 'ctheron@foi.hr', 'korisnici/ctheron.jpg'),
(0,16, 2, 'nkidman', '123456', 'Nicole', 'Kidman', 'nkidman@foi.hr', 'korisnici/nkidman.jpg'),
(0,17, 2, 'ewatson', '123456', 'Emma', 'Watson', 'ewatson@foi.hr', 'korisnici/ewatson.jpg'),
(0,18, 1, 'kdunst', '123456', 'Kirsten', 'Dunst', 'kdunst@foi.hr', 'korisnici/kdunst.jpg'),
(0,19, 2, 'sjohansson', '123456', 'Scarlett', 'Johansson', 'sjohansson@foi.hr', 'korisnici/sjohansson.jpg'),
(0,20, 2, 'philton', '123456', 'Paris', 'Hilton', 'philton@foi.hr', 'korisnici/philton.jpg'),
(0,21, 2, 'kbeckinsale', '123456', 'Kate', 'Beckinsale', 'kbeckinsale@foi.hr', 'korisnici/kbeckinsale.jpg'),
(0,22, 2, 'tcruise', '123456', 'Tom', 'Cruise', 'tcruise@foi.hr', 'korisnici/tcruise.jpg'),
(0,23, 2, 'hduff', '123456', 'Hilary', 'Duff', 'hduff@foi.hr', 'korisnici/hduff.jpg'),
(0,24, 2, 'ajolie', '123456', 'Angelina', 'Jolie', 'ajolie@foi.hr', 'korisnici/ajolie.jpg'),
(0,25, 2, 'kknightley', '123456', 'Keira', 'Knightley', 'kknightley@foi.hr', 'korisnici/kknightley.jpg'),
(0,26, 2, 'obloom', '123456', 'Orlando', 'Bloom', 'obloom@foi.hr', 'korisnici/obloom.jpg'),
(0,27, 2, 'llohan', '123456', 'Lindsay', 'Lohan', 'llohan@foi.hr', 'korisnici/llohan.jpg'),
(0,28, 2, 'jdepp', '123456', 'Johnny', 'Depp', 'jdepp@foi.hr', 'korisnici/jdepp.jpg'),
(0,29, 2, 'kreeves', '123456', 'Keanu', 'Reeves', 'kreeves@foi.hr', 'korisnici/kreeves.jpg'),
(0,30, 1, 'thanks', '123456', 'Tom', 'Hanks', 'thanks@foi.hr', 'korisnici/thanks.jpg'),
(0,31, 2, 'elongoria', '123456', 'Eva', 'Longoria', 'elongoria@foi.hr', 'korisnici/elongoria.jpg'),
(0,32, 2, 'rde', '123456', 'Robert', 'De', 'rde@foi.hr', 'korisnici/rde.jpg'),
(0,33, 2, 'jheder', '123456', 'Jon', 'Heder', 'jheder@foi.hr', 'korisnici/jheder.jpg'),
(0,34, 2, 'rmcadams', '123456', 'Rachel', 'McAdams', 'rmcadams@foi.hr', 'korisnici/rmcadams.jpg'),
(0,35, 2, 'cbale', '123456', 'Christian', 'Bale', 'cbale@foi.hr', 'korisnici/cbale.jpg'),
(0,36, 1, 'jalba', '123456', 'Jessica', 'Alba', 'jalba@foi.hr', 'korisnici/jalba.jpg'),
(0,37, 2, 'bpitt', '123456', 'Brad', 'Pitt', 'bpitt@foi.hr', 'korisnici/bpitt.jpg'),
(0,43, 2, 'apacino', '123456', 'Al', 'Pacino', 'apacino@foi.hr', 'korisnici/apacino.jpg'),
(0,44, 2, 'wsmith', '123456', 'Will', 'Smith', 'wsmith@foi.hr', 'korisnici/wsmith.jpg'),
(0,45, 2, 'ncage', '123456', 'Nicolas', 'Cage', 'ncage@foi.hr', 'korisnici/ncage.jpg'),
(0,46, 2, 'vanne', '123456', 'Vanessa', 'Anne', 'vanne@foi.hr', 'korisnici/vanne.jpg'),
(0,47, 2, 'kheigl', '123456', 'Katherine', 'Heigl', 'kheigl@foi.hr', 'korisnici/kheigl.jpg'),
(0,48, 2, 'gbutler', '123456', 'Gerard', 'Butler', 'gbutler@foi.hr', 'korisnici/gbutler.jpg'),
(0,49, 2, 'jbiel', '123456', 'Jessica', 'Biel', 'jbiel@foi.hr', 'korisnici/jbiel.jpg'),
(0,50, 2, 'ldicaprio', '123456', 'Leonardo', 'DiCaprio', 'ldicaprio@foi.hr', 'korisnici/ldicaprio.jpg'),
(0,51, 2, 'mdamon', '123456', 'Matt', 'Damon', 'mdamon@foi.hr', 'korisnici/mdamon.jpg'),
(0,52, 2, 'hpanettiere', '123456', 'Hayden', 'Panettiere', 'hpanettiere@foi.hr', 'korisnici/hpanettiere.jpg'),
(0,53, 2, 'rreynolds', '123456', 'Ryan', 'Reynolds', 'rreynolds@foi.hr', 'korisnici/rreynolds.jpg'),
(0,54, 2, 'jstatham', '123456', 'Jason', 'Statham', 'jstatham@foi.hr', 'korisnici/jstatham.jpg'),
(0,55, 2, 'enorton', '123456', 'Edward', 'Norton', 'enorton@foi.hr', 'korisnici/enorton.jpg'),
(0,56, 2, 'mwahlberg', '123456', 'Mark', 'Wahlberg', 'mwahlberg@foi.hr', 'korisnici/mwahlberg.jpg'),
(0,57, 2, 'jmcavoy', '123456', 'James', 'McAvoy', 'jmcavoy@foi.hr', 'korisnici/jmcavoy.jpg'),
(0,58, 2, 'epage', '123456', 'Ellen', 'Page', 'epage@foi.hr', 'korisnici/epage.jpg'),
(0,59, 2, 'mcyrus', '123456', 'Miley', 'Cyrus', 'mcyrus@foi.hr', 'korisnici/mcyrus.jpg'),
(0,60, 2, 'kstewart', '123456', 'Kristen', 'Stewart', 'kstewart@foi.hr', 'korisnici/kstewart.jpg'),
(0,61, 2, 'mfox', '123456', 'Megan', 'Fox', 'mfox@foi.hr', 'korisnici/mfox.jpg'),
(0,62, 2, 'slabeouf', '123456', 'Shia', 'LaBeouf', 'slabeouf@foi.hr', 'korisnici/slabeouf.jpg'),
(0,63, 2, 'ceastwood', '123456', 'Clint', 'Eastwood', 'ceastwood@foi.hr', 'korisnici/ceastwood.jpg'),
(0,64, 2, 'srogen', '123456', 'Seth', 'Rogen', 'srogen@foi.hr', 'korisnici/srogen.jpg'),
(0,65, 2, 'nreed', '123456', 'Nikki', 'Reed', 'nreed@foi.hr', 'korisnici/nreed.jpg'),
(1,66, 2, 'agreene', '123456', 'Ashley', 'Greene', 'agreene@foi.hr', 'korisnici/agreene.jpg'),
(1,67, 2, 'zdeschanel', '123456', 'Zooey', 'Deschanel', 'zdeschanel@foi.hr', 'korisnici/zdeschanel.jpg'),
(1,68, 2, 'dfanning', '123456', 'Dakota', 'Fanning', 'dfanning@foi.hr', 'korisnici/dfanning.jpg'),
(1,69, 2, 'tlautner', '123456', 'Taylor', 'Lautner', 'tlautner@foi.hr', 'korisnici/tlautner.jpg'),
(1,70, 2, 'rpattinson', '123456', 'Robert', 'Pattinson', 'rpattinson@foi.hr', 'korisnici/rpattinson.jpg');

INSERT INTO `planina` (`planina_id`, `naziv`, `opis`, `lokacija`, `geografska_sirina`, `geografska_duzina`) VALUES
(1,'Dinara','Dinara je planina u Dinarskom gorju na granici Republike Hrvatske i Bosne i Hercegovine. Dinara dijeli Livanjsko polje od Sinjskoga, te čini prirodnu granicu između Bosne i Hercegovine i Hrvatske.','Šibensko-kninska županija',44.062475,16.387691),
(2,'Ivančica','Ivanščica (zvana i Ivančica) 1061 mnv. , najviša planina sjeverozapadne Hrvatske, smještena u Hrvatskom Zagorju. Proteže se u smjeru zapad-istok, duga oko 30 km i široka do 9 km, a omeđena je vodotocima Bednje, gornjeg toka Lonje, Krapine i Velikog potoka.','Ivanec',46.1755513581999,16.10595703125),
(3,'Medvednica','Medvednica ili Zagrebačka gora je planina sjeverno od Zagreba. Sljeme, njezin najviši vrh (1033 m), je popularno izletničko mjesto do kojeg se može doći cestom ili pješice, planinareći.Od 1963. do 2007. do Sljemena je vozila turistička žičara.[2] Bilo Medvednice dugo je 42 km, a proteže se u smjeru sjeveroistok - jugozapad. Površina planine je pošumljena. Godine 1981. zapadni dio Medvednice proglašen je parkom prirode.','Zagreb',45.91073831,15.94433172),
(4,'Velebit','Velebit ili velebitski masiv je najduža (145 km), ali po nadmorskoj visini tek četvrta planina u Hrvatskoj. Niži je od planina u Zagori - Dinare (1831 m), Kamešnice (1809 m) i Biokova (1762 m). Velebit je širine od 10 do 30 km, a površina mu je oko 2200 km2, a najviši vrh Vaganski vrh (1.757 m). Pripada Dinarskome gorju.','Ličko senjska i zadarska županija',44.78956682,14.94328614),
(5,'Papuk','Papuk je planina u istočnoj Hrvatskoj, na sjevernoj i sjeverozapadnoj granici Požeške kotline.','Požega',45.531986, 17.592906);

INSERT INTO `moderator` (`korisnik_id`, `planina_id`) VALUES
(2,1),
(18,1),
(2,2),
(2,3),
(18,3),
(30,3),
(36,3),
(18,4),
(30,5),
(18,5);

INSERT INTO `slika` (`korisnik_id`, `planina_id`, `naziv`, `url`, `opis`, `datum_vrijeme_slikanja`, `status`) VALUES
(3,1,'Dinara iz daljine','https://upload.wikimedia.org/wikipedia/commons/7/7c/Dinara_central.jpg','Najbolji pogled','2020-10-02 10:00:00',1),
(3,1,'Kod vrha','https://croatia.hr/sites/default/files/styles/image_full_width/public/migrate/badanj-14-alan-caplar.jpg','Zadnja ravnica prije kraja','2020-10-03 10:00:00',1),
(3,1,'Dinara najviša planina','https://live.staticflickr.com/4511/36844950564_70b897f770_z.jpg','Sunset on the higest mountain in Croatia, and the first snow this fall. Below the mountain, Krčić river runs out.','2020-10-22 10:00:00',1),
(3,2,'Šume Ivanščice','https://live.staticflickr.com/4564/26859026319_8345211dc1_o.jpg','Predivna staza','2020-10-04 10:00:00',1),
(3,2,'Ivanščica zalazak','http://www.mnovine.hr/wp-content/uploads/2017/12/Zalazak-sunca-Ivan%C5%A1%C4%8Dica-3.jpg','Pogled s Ivanščice na očaravajući zimski zalazak','2020-10-05 10:00:00',1),
(3,3,'Medvednica iz zraka','https://croatia.hr/sites/default/files/styles/image_full_width/public/migrate/medvedgrad-iz-zraka-17-alan-caplar-dronom.jpg','Slikano sa dronom','2020-10-06 10:00:00',1),
(3,3,'Medvednica park','http://www.discoverdinarides.com/content/big_579b3d9f62a92.jpg','Nature Park Medvednica | Parks Dinarides','2020-10-07 10:00:00',1),
(3,1,'Mali Troglav Dinara','https://upload.wikimedia.org/wikipedia/commons/e/e9/Mali_Troglav,_Dinara-0024.jpg','Ljepi vrh','2020-10-08 13:00:00',0),
(70,1,'Dinara most','https://croatia.hr/sites/default/files/styles/image_full_width/public/migrate/rijeka-cetina-alan-caplar.jpg?itok=EoUfafQk','Super mjesto','2020-10-09 10:00:00',0),
(70,1,'Novac dinara','https://www.leftovercurrency.com/wp-content/uploads/2017/11/serbia-5-dinara-coin-obverse-1.jpg','Novac','2020-10-09 12:00:00',0),
(4,1,'Dinara','https://media-cdn.tripadvisor.com/media/photo-s/12/ba/02/6b/dinara.jpg','Dinara umjetnička slika','2020-10-03 12:00:00',1),
(4,1,'Dinara točka na vrhu','https://img.oastatic.com/img2/16338673/600x300r/dinara.jpg','Uspon završen','2020-10-02 13:00:00',1),
(4,1,'Vrh dinare','https://www.virtualmountains.co.uk/esc/Croatia/Dinara_Summit.jpg','Na samom vrhu','2020-10-02 14:00:00',0),
(4,2,'Milengrad','https://live.staticflickr.com/65535/48685919028_c4be46ee65_o.jpg','zidine starog Milengrada koji je sagrađen u 13. stoljeću nakon provale Tatara na južnim padinama gore Ivanščice, Budinščina.','2020-10-02 15:00:00',1),
(4,3,'Medvednica Mountain','https://static.toiimg.com/photo/58851964/.jpg','Medvednica Mountain - Zagreb: Get the Detail of Medvednica Mountain on Times of India Travel','2020-10-02 16:00:00',1),
(5,1,'Troglav','https://www.total-croatia-cycling.com/media/k2/items/cache/011e88ef4a8328e08be9d913808b8290_XL.jpg','Stigli do vrha','2020-10-02 17:00:00',1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
