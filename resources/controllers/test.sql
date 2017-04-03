#Procedura koja NE radi!!!! :D
DROP PROCEDURE IF EXISTS crta_select_nepokretna;
CREATE PROCEDURE crta_select_nepokretna
BEGIN
SELECT concat(Poslanik.Ime,' ', Poslanik.Prezime) as Poslanik, (year(PromenaNepokretneImovine.DatumOd)-2008)*4+quarter(PromenaNepokretneImovine.DatumOd) as Kvartal, Tip, Povrsina, jedinicaMerePovrsine from NepokretnaImovina 
INNER JOIN Poslanik on NepokretnaImovina.PoslanikID = Poslanik.PoslanikID
INNER JOIN PromenaNepokretneImovine on PromenaNepokretneImovine.PromenaNIID = NepokretnaImovina.PromenaNIID
WHERE year(PromenaNepokretneImovine.DatumOd) > 2007
ORDER BY Poslanik.PoslanikID
END;

#Od kada do kada poseduje neku nekretninu
SELECT `NekretninaID`,COUNT(`PromenaNIID`) , MIN(`DatumOD`), MAX(`DatumOD`) FROM `PromenaNepokretneImovine` GROUP BY `NekretninaID`

#Ubacivanje kvartala u PromenuNepokretneImovine
INSERT INTO `PromenaNepokretneImovine`(`Kvartal`) 
SELECT (year(PromenaNepokretneImovine.DatumOd)-2008)*4+quarter(PromenaNepokretneImovine.DatumOd) from PromenaNepokretneImovine

#Upit za nepokretnu imovinu i promene po kvartalima
SELECT concat(Poslanik.Ime,' ', Poslanik.Prezime) as Poslanik, (year(MIN(PromenaNepokretneImovine.DatumOd))-2008)*4+quarter(MIN(PromenaNepokretneImovine.DatumOd)) as PrviKvartal,(year(MAX(PromenaNepokretneImovine.DatumOd))-2008)*4+quarter(MAX(PromenaNepokretneImovine.DatumOd)) as PoslednjiKvartal, Tip, Povrsina, jedinicaMerePovrsine FROM NepokretnaImovina 
INNER JOIN Poslanik on NepokretnaImovina.PoslanikID = Poslanik.PoslanikID
INNER JOIN PromenaNepokretneImovine on PromenaNepokretneImovine.NekretninaID = NepokretnaImovina.NepokretnaImovinaID
WHERE year(PromenaNepokretneImovine.DatumOd) > 2007
GROUP BY PromenaNepokretneImovine.NekretninaID
ORDER BY Poslanik.PoslanikID

#Jedinice mere koje nisu pravilno upisane u tabeli
SELECT * FROM nepimov where JedinicaMerePovrsine != "m2"

#Upit za prihode po kvartalima
SELECT CONCAT(Poslanik.Ime, ' ', Poslanik.Prezime) AS Poslanik, (year(MIN(VremeOd))-2008)*4+quarter(MIN(VremeOd)) AS PrviKvartal, (year(MAX(VremeOd))-2008)*4+quarter(MAX(VremeOd)) AS PoslednjiKvartal,Funkcija.Naziv, Funkcija.Prihodi , Poslanik.PoslanikID FROM Funkcija
INNER JOIN Poslanik ON Poslanik.PoslanikID = Funkcija.PoslanikID
WHERE year(VremeOd) > 2007
GROUP BY Funkcija.Prihodi
ORDER BY Poslanik.PoslanikID

#Localhost test
Flight::register('db', 'PDO', array('mysql:host=localhost;port=3306;dbname=crta;charset=utf8', 'dule', 'dule'), function($db) {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
});

/*read from file!!!
$myfile = fopen("sifra.txt", "r") or die("Unable to open file!");
$sifra = fgets($myfile).'';
fclose($myfile);*/

CREATE TABLE IF NOT EXISTS GrupisanePlate(
	GrupisanePlateID INT(20),
	PoslanikID INT(20),
	Prihod FLOAT(15),
	Kvartal INT(10),
	PRIMARY KEY(GrupisanePlateID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP PROCEDURE IF EXISTS crta_insert_grupisaneplate;
CREATE PROCEDURE crta_insert_grupisaneplate
(IN grupisaneplateID INT(20), IN poslanikID INT(20), IN prihod FLOAT(15),IN kvartal INT(10))
INSERT INTO GrupisanePlate(GrupisanePlateID, PoslanikID, Prihod, Kvartal) 
VALUES(grupisaneplateID, poslanikID, prihod, kvartal);