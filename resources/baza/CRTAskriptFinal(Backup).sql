DROP DATABASE IF EXISTS crta;
CREATE DATABASE IF NOT EXISTS crta;
USE crta;
ALTER DATABASE crta CHARACTER SET utf8 COLLATE utf8_unicode_ci;
DROP TABLE IF EXISTS Poslanik;
DROP TABLE IF EXISTS Stranka;
DROP TABLE IF EXISTS PromenaStranke;
DROP TABLE IF EXISTS PoslanickiKlub;
DROP TABLE IF EXISTS PromenaPoslanickogKluba;
DROP TABLE IF EXISTS Mesto;
DROP TABLE IF EXISTS Funkcija;
DROP TABLE IF EXISTS Ustanova;
DROP TABLE IF EXISTS IzvorPrihoda;
DROP TABLE IF EXISTS NepokretnaImovina;
DROP TABLE IF EXISTS PromenaNepokretneImovine;
DROP TABLE IF EXISTS Opozicija;
DROP TABLE IF EXISTS PromenaOpozicije;
DROP TABLE IF EXISTS Depozit;
DROP TABLE IF EXISTS PromenaDepozita;
DROP TABLE IF EXISTS PrevoznoSredstvo;
DROP TABLE IF EXISTS PromPrevSredstva;
DROP TABLE IF EXISTS DodeljenStan;
DROP TABLE IF EXISTS PromDodStana;
DROP TABLE IF EXISTS RepublickiProsek;
CREATE TABLE IF NOT EXISTS Poslanik(
	PoslanikID	INT(20),
	IzvorPodataka varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
	Drzava varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
	Ime varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
	Prezime varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
	Pol TINYINT(1), 
	StrankaID INT(20),
	PoslKlubID INT(20),
	MestoPoslID INT(20),
	OpozicijID INT(20),
	Godiste VARCHAR(10),
	Slika LONGBLOB,
	PRIMARY KEY(PoslanikID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS Stranka(
	StrankaID INT(20),
	Naziv varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	DatumOsnivanja DATE,
	PRIMARY KEY(StrankaID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS PromenaStranke(
	PoslanikID INT(20),
	StrankaID INT(20),
	DatumOD DATE,
	DatumDO DATE,
	PromenaStrankeID INT(20),
	PRIMARY KEY(PromenaStrankeID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS PoslanickiKlub(
	PoslKlubID INT(20),
	Naziv varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	StrankaID INT(20),
	Saziv varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY(PoslKlubID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS PromenaPoslanickogKluba(
	PoslanikID INT(20),
	PoslKlubID INT(20),
	DatumOD DATE,
	DatumDO DATE,
	PromKlubaID INT(20),
	PRIMARY KEY(PromKlubaID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS Mesto(
	MestoID INT(20),
	Naziv varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	Opstina varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY(MestoID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS Funkcija(
	FunkcijaID INT(20),
	Naziv varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	UstanovaID INT(20),
	Prihodi FLOAT(15),
	VremeOD DATE,
	VremeDO DATE,
	IntervalF varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	PoslanikID INT(20),
	Valuta varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	IzvorPrihodaID INT(20),
	PRIMARY KEY(FunkcijaID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS Ustanova(
	UstanovaID INT(20),
	Naziv varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY(UstanovaID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS IzvorPrihoda(
	IzvorPrihodaID INT(20),
	Naziv varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	PRIMARY KEY(IzvorPrihodaID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS NepokretnaImovina(
	NepokretnaImovinaID INT(20),
	Tip varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	Stuktura varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	Povrsina FLOAT(10),
	JedinicaMerePovrsine varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	VlasnickiUdeo varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	OsnovSticanja varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	PoslanikID INT(20),
	PromenaNIID INT(20),
	PRIMARY KEY(NepokretnaImovinaID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS PromenaNepokretneImovine(
	PromenaNIID INT(20),
	PoslanikID INT(20),
	DatumOD DATE,
	DatumDO DATE,
	PRIMARY KEY(PromenaNIID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS Opozicija(
	OpozicijaID INT(20),
	Opozicija TINYINT(1),
	PRIMARY KEY(OpozicijaID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS PromenaOpozicije(
	OpozicijaID INT(20),
	PoslanikID INT(20),
	DatumOD DATE,
	DatumDO DATE,
	PromOpozicijaID INT(20),
	PRIMARY KEY(PromOpozicijaID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS Depozit(
	DepozitID INT(20),
	PromenaDepozitaID INT(20),
	Ima TINYINT(1),
	PoslanikID INT(20),
	PRIMARY KEY(DepozitID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS PromenaDepozita(
	PromenaDepozitaID INT(20),
	PoslanikID INT(20),
	DatumOD DATE,
	DatumDO DATE,
	PRIMARY KEY(PromenaDepozitaID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS PrevoznoSredstvo(
	PrevoznoSredstvoID INT(20),
	Tip varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	GodinaProizvodnje INT(10), 
	OsnovSticanja varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	PoslanikID INT(20),
	PromenaPSID INT(20),
	PRIMARY KEY(PrevoznoSredstvoID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS PromPrevSredstva(
	PromenaPSID INT(20),
	PoslanikID INT(20),
	DatumOD DATE,
	DatumDO DATE,
	PRIMARY KEY(PromenaPSID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS DodeljenStan(
	PravoKoriscenaStanaID INT(20),
	MestoID INT(20),
	Struktura varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	Povrsina FLOAT(10),
	OsnovDodele varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
	PromenaPravaKorID INT(20),
	PoslanikID INT(20),
	PRIMARY KEY(PravoKoriscenaStanaID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS PromDodStana(
	PromenePravaKorID INT(20),
	PoslanikID INT(20),
	DatumOd DATE,
	DatumDO DATE,
	PRIMARY KEY(PromenePravaKorID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
CREATE TABLE IF NOT EXISTS RepublickiProsek(
	RepublickiProsekID INT(20),
	Datum varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
	Datumd DATE,
	Iznos INT(20),
	PRIMARY KEY(RepublickiProsekID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP PROCEDURE IF EXISTS crta_insert_stranka;
CREATE PROCEDURE crta_insert_stranka
(IN id INT(20), IN naziv varchar(100), IN datum DATE) 
INSERT INTO Stranka(StrankaID, Naziv, DatumOsnivanja) VALUES(id, naziv, datum);

DROP PROCEDURE IF EXISTS crta_insert_poslanickiklub;
CREATE PROCEDURE crta_insert_poslanickiklub
(IN id INT(20), IN naziv varchar(100), IN StrankaID INT(20), IN Saziv varchar(100))
INSERT INTO PoslanickiKlub(PoslKlubID, Naziv, StrankaID, Saziv) VALUES(id, naziv, StrankaID, Saziv);

DROP PROCEDURE IF EXISTS crta_insert_mesto;
CREATE PROCEDURE crta_insert_mesta
(IN id INT(20), IN naziv varchar(100), IN opstina varchar(100))
INSERT INTO Mesto(MestoID, Naziv, Opstina) VALUES(id, naziv, opstina);

DROP PROCEDURE IF EXISTS crta_insert_ustanova;
CREATE PROCEDURE crta_insert_ustanova
(IN id INT(20), IN naziv varchar(100))
INSERT INTO Ustanova(UstanovaID, Naziv) VALUES(id, naziv);

DROP PROCEDURE IF EXISTS crta_insert_izvorprihoda;
CREATE PROCEDURE crta_insert_izvorprihoda
(IN id INT(20), IN naziv varchar(100))
INSERT INTO IzvorPodataka(IzvorPrihodaID, Naziv) VALUES(id, naziv);

DROP PROCEDURE IF EXISTS crta_insert_poslanik;
CREATE PROCEDURE crta_insert_poslanik
(IN id INT(20), IN izvor varchar(100),IN drzava varchar(100),IN ime VARCHAR(20), IN prezime varchar(100), IN pol TINYINT(1), IN strankaid INT(10), IN poslklubid INT(10), IN mestoid INT(10), IN opozid INT(10),IN godiste VARCHAR(10), IN slika BLOB)
INSERT INTO Poslanik(PoslanikID, IzvorPodataka, Drzava, Ime, Prezime, Pol, StrankaID, PoslKlubID, MestoPoslID, OpozicijaID, Godiste, Slika) 
VALUES(id, izvor, drzava, ime, prezime, pol, strankaid, poslklubid, mestoid, opozid,godiste, slika);

DROP PROCEDURE IF EXISTS crta_insert_funkcija;
CREATE PROCEDURE crta_insert_funkcija
(IN id INT(20), IN naziv varchar(100), IN ustanovaID varchar(100), IN prihodi FLOAT(20), IN vrmeod DATE, IN vremedo DATE, IN intervalf varchar(100), IN poslanikid INT(10), IN valuta VARCHAR(20), IN izvorprihodaid INT(10) )
INSERT INTO Funkcija(FunkcijaID, Naziv, UstanovaID, Prihodi, VremeOD, VremeDO, IntervalF, PoslanikID, Valuta, IzvorPrihodaID) 
VALUES(id, naziv, ustanovaID, prihodi, vrmeod, vremedo, intervalf, poslanikid, valuta, izvorprihodaid);

DROP PROCEDURE IF EXISTS crta_insert_nepokretnaimovina;
CREATE PROCEDURE crta_insert_nepokretnaimovina
(IN id INT(10), IN tip varchar(100), IN struktura varchar(100), IN povrsina FLOAT(20), IN jedinica varchar(100), IN udeo varchar(100), IN sticanje varchar(100), IN poslanikID INT(10), IN promenaniID INT(10))
INSERT INTO NepokretnaImovina(NepokretnaImovinaID, Tip, Struktura, Povrsina, JedinicaMerePovrsine, VlasnickuUdeo, OsnovSticanja, PoslanikID, PromenaNIID)
VALUES(id, tip, struktura, povrsina, jedinica, udeo, sticanje, poslanikID, promenaniID);

DROP PROCEDURE IF EXISTS crta_insert_opozicija;
CREATE PROCEDURE crta_insert_opozicija
(IN id INT(10), IN opozicija TINYINT(1))
INSERT INTO Opozicija(OpozicijaID, Opozicija) VALUES(id, opozicija);

DROP PROCEDURE IF EXISTS crta_insert_depozit;
CREATE PROCEDURE crta_insert_depozit
(IN id INT(10), IN promenadepozitaID INT(10), IN ima TINYINT(1), IN poslanikID INT(10))
INSERT INTO Depozit(DepozitID, PromenaDepozitaID, Ima, PoslanikID) VALUES(id, promenadepozitaID, ima, poslanikID);

DROP PROCEDURE IF EXISTS crta_insert_prevoznosredstvo;
CREATE PROCEDURE crta_insert_prevoznosredstvo
(IN id INT(10), IN tip varchar(100), IN godiste INT(10), IN osnovsticanja varchar(100), IN poslanikID INT(10), IN promenapsID INT(10))
INSERT INTO PrevoznoSredstvo(PrevoznoSredstvoID, Tip, GodinaProizvodnje, OsnovSticanja, PoslanikID, PromenaPSID) 
VALUES(id, tip, godiste, osnovsticanja, poslanikID, promenapsID);

DROP PROCEDURE IF EXISTS crta_insert_dodeljenstan;
CREATE PROCEDURE crta_insert_dodeljenstan
(IN id INT(10), IN mestoID INT(10), IN struktura varchar(100), IN povrsina FLOAT(20), IN osnovdodele varchar(100), IN promenapkID INT(10), IN poslanikID INT(10))
INSERT INTO DodeljenStan(PravoKoriscenaStanaID, MestoID, Struktura, Povrsina, OsnovDodele, PromenaPravKorID, PoslanikID) 
VALUES(id, mestoID, struktura, povrsina, osnovdodele, promenapkID, poslanikID);

DROP PROCEDURE IF EXISTS crta_insert_promdodstana;
CREATE PROCEDURE crta_insert_promdodstana
(IN id INT(10), IN posalnikID INT(10), IN datumod DATE, IN datumdo DATE)
INSERT INTO PromDodStana(PromenaPravaKorID, PoslanikID, DatumOD, DatumDO) 
VALUES(id, posalnikID, datumod, datumdo);

DROP PROCEDURE IF EXISTS crta_insert_promprevsredstva;
CREATE PROCEDURE crta_insert_promprevsredstva
(IN id INT(10), IN posalnikID INT(10), IN datumod DATE, IN datumdo DATE)
INSERT INTO PromPrevSredstva(PromenaPSID, PoslanikID, DatumOD, DatumDO) VALUES(id, posalnikID, datumod, datumdo);

DROP PROCEDURE IF EXISTS crta_insert_promenadepozita;
CREATE PROCEDURE crta_insert_promenadepozita
(IN id INT(10), IN posalnikID INT(10), IN datumod DATE, IN datumdo DATE)
INSERT INTO PromenaDepozita(PromenaDepozitaID, PoslanikID, DatumOD, DatumDO) VALUES(id, posalnikID, datumod, datumdo);

DROP PROCEDURE IF EXISTS crta_insert_promenaopozicije;
CREATE PROCEDURE crta_insert_promenaopozicije
(IN opozicijaID INT(10), IN posalnikID INT(10), IN datumod DATE, IN datumdo DATE, IN id INT(10))
INSERT INTO PromenaOpozicije(OpozicijaID, PoslanikID, DatumOD, DatumDO, PromOpozicijaID) 
VALUES(opozicijaID, posalnikID, datumod, datumdo, id);

DROP PROCEDURE IF EXISTS crta_insert_promenanepokretneimovine;
CREATE PROCEDURE crta_insert_promenanepokretneimovine
(IN id INT(10), IN posalnikID INT(10), IN datumod DATE, IN datumdo DATE)
INSERT INTO PromenaNepokretneImovine(PromenaNIID, PoslanikID, DatumOD, DatumDO) VALUES(id, posalnikID, datumod, datumdo);

DROP PROCEDURE IF EXISTS crta_insert_promenastranke;
CREATE PROCEDURE crta_insert_promenastranke
(IN poslanikID INT(10), IN strankaID INT(10), IN datumod DATE, IN datumdo DATE, IN id INT(10))
INSERT INTO PromenaStranke(PoslanikID, StrankaID, DatumOD, DatumDO, PromenaStrankeID) 
VALUES(poslanikID, strankaID, datumod, datumdo, id);

DROP PROCEDURE IF EXISTS crta_insert_promenaposlanickogkluba;
CREATE PROCEDURE crta_insert_promenaposlanickogkluba
(IN poslanikID INT(10), IN sposlklubID INT(10), IN datumod DATE, IN datumdo DATE, IN id INT(10))
INSERT INTO PromenaPoslanickogKluba(PoslanikID, PoslKlubID, DatumOD, DatumDO, PromenaStrankeID) 
VALUES(poslanikID, sposlklubID, datumod, datumdo, id);

DROP PROCEDURE IF EXISTS crta_insert_republickiprosek;
CREATE PROCEDURE crta_insert_republickiprosek
(IN id INT(20), IN datum varchar(100), IN datumd DATE, IN iznos FLOAT(15)) 
INSERT INTO RepublickiProsek(RepublickiProsekID, Datum, Datumd, Iznos) VALUES(id, datum, datumd, iznos);
