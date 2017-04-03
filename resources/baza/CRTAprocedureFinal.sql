
	-- Unos podataka Stranka
	SET @p0=''; -- id 
	SET @p1=''; -- naziv
	SET @p2=''; -- datum
	CALL crta_insert_stranka(@p0, @p1, @p2);



	-- Unos podataka PoslanickiKlub
	SET @p0=''; -- id 
	SET @p1=''; -- naziv
	SELECT StrankaID INTO @p2 FROM Stranka WHERE Naziv = 'Srpska napredna stranka' LIMIT 1; -- StrankaID
	SET @p3=''; -- Saziv
	CALL crta_insert_poslanickiklub(@p0, @p1, @p2, @p3);



	-- Unos podataka Mest
	SET @p0=''; -- id 
	SET @p1=''; -- naziv
	CALL crta_insert_mesta(@p0, @p1);
	


	-- Unos podataka Ustanova
	SET @p0=''; -- id 
	SET @p1=''; -- naziv
	CALL crta_insert_ustanova(@p0, @p1);
	


	-- Unos podataka IzvorPrihoda
	SET @p0=''; -- id 
	SET @p1=''; -- naziv
	CALL crta_insert_izvorprihoda(@p0, @p1);
	


	-- Unos podataka IzvorPrihoda
	SET @p0=''; -- id 
	SET @p1=''; -- izvor
	SET @p2=''; -- drzava
	SET @p3=''; -- ime
	SET @p4=''; -- prezime
	SET @p5=''; -- pol
	SELECT StrankaID INTO @p6 FROM Stranka WHERE Naziv = '' LIMIT 1; -- StrankaID
	SELECT PoslKlubID INTO @p7 FROM PoslanickiKlub WHERE Naziv ='' LIMIT 1; -- PoslKlubID
	SELECT MestoID INTO @p8 FROM Mesto WHERE Naziv ='' LIMIT 1; -- MestoPoslID
	SELECT OpozicijaID INTO @p9 FROM Opozicija WHERE OpozicijaID = '' LIMIT 1; -- OpozicijaID
	SET @p10=''; -- Slika
	CALL crta_insert_poslanik(@p0, @p1, @p2, @p3, @p4, @p5, @p6, @p7, @p8, @p9, @p10);



	-- Unos podataka Funkcija
	SET @p0=''; -- id 
	SET @p1=''; -- naziv
	SET @p6=''; -- intervalf 
	SET @p3=''; -- prihodi
	SET @p4=''; -- vremeod
	SET @p5=''; -- vremedo
	SELECT PoslanikID INTO @p7 FROM Poslanik WHERE PoslanikID = '' LIMIT 1; -- PoslanikID
	SELECT UstanovaID INTO @p2 FROM Ustanova WHERE Naziv ='' LIMIT 1; -- ustanova id
	SELECT IzvorPrihodaID INTO @p9 FROM IzvorPrihoda WHERE Naziv ='' LIMIT 1; -- izvorprihodaid
	SET @p8=''; -- valuta
	CALL crta_insert_funkcija(@p0, @p1, @p2, @p3, @p4, @p5, @p6, @p7, @p8, @p9);



	-- Unos podataka Funkcija
	SET @p0=''; -- id 
	SET @p1=''; -- tip
	SET @p2=''; -- struktura 
	SET @p3=''; -- povrsina
	SET @p4=''; -- jedinica
	SET @p5=''; -- udeo
	SET @p6=''; -- sticanje
	SELECT PoslanikID INTO @p7 FROM Poslanik WHERE PoslanikID = '' LIMIT 1; -- PoslanikID
	SELECT PromenaNIID INTO @p8 FROM PromenaNepokretneImovine WHERE NazPromenaNIIDiv ='' LIMIT 1; -- promenaNIID, treba ispraviti uslov da uzima poslednji interval
	CALL crta_insert_nepokretnaimovina(@p0, @p1, @p2, @p3, @p4, @p5, @p6, @p7, @p8);

------------------------------------------- End 8


	-- Unos podataka Opozicija
	SET @p0=''; -- id 
	SET @p1=''; -- OPOZICIJA
	CALL crta_insert_opozicija(@p0, @p1);



	-- Unos podataka Depozit
	SET @p0=''; -- id 
	SELECT PromenaDepozitaID INTO @p1 FROM PromenaDepozita WHERE PromenaDepozitaID = '' LIMIT 1; -- promenaDepozitaID, prepraviti da uslov bude poslednji interval za datog poslanika
	SET @p2=''; -- ima
	SELECT PoslanikID INTO @p3 FROM Poslanik WHERE PoslanikID = '' LIMIT 1; -- poslanikID
	CALL crta_insert_depozit(@p0, @p1, @p2, @p3);



	-- Unos podataka Prevozno Sredstvo
	SET @p0=''; -- id 
	SET @p1=''; -- tip
	SET @p2=''; -- godiste
	SET @p3=''; -- osnovsticanja
	SELECT PoslanikID INTO @p4 FROM Poslanik WHERE PoslanikID = '' LIMIT 1; -- poslanikID
	SELECT PromenaPSID INTO @p5 FROM PromPrevSredstva WHERE PromenaPSID = '' LIMIT 1; -- PromenaPSID, prepraviti da uslov bude poslednji interval za datog poslanika
	CALL crta_insert_prevoznosredstvo(@p0, @p1, @p2, @p3, @p4, @p5);



	-- Unos podataka Dodeljen Stan
	SET @p0=''; -- id 
	SELECT MestoID INTO @p1 FROM Mesto WHERE Naziv ='' LIMIT 1; -- mestoID
	SET @p2=''; -- struktura
	SET @p3=''; -- povrsina
	SET @p4=''; -- osnovdodele
	SELECT PromenaPravaKorID INTO @p5 FROM PromDodStana WHERE PromenaPravaKorID = '' LIMIT 1; -- promenapkID, odraditi uslov sa intervalom
	SELECT PoslanikID INTO @p6 FROM Poslanik WHERE PoslanikID = '' LIMIT 1; -- poslanik ID
	CALL crta_insert_dodeljenstan(@p0, @p1, @p2, @p3, @p4, @p5, @p6);



	-- Unos podataka promena dodeljenog stana
	SET @p0=''; -- id 
	SELECT PoslanikID INTO @p1 FROM Poslanik WHERE PoslanikID = '' LIMIT 1; -- poslanik ID
	SET @p2=''; -- datumod
	SET @p3=''; -- datumdo
	CALL crta_insert_promdodstana(@p0, @p1, @p2, @p3);



	-- Unos podataka promena prevoznog sredstva
	SET @p0=''; -- id 
	SELECT PoslanikID INTO @p1 FROM Poslanik WHERE PoslanikID = '' LIMIT 1; -- poslanik ID
	SET @p2=''; -- datumod
	SET @p3=''; -- datumdo
	CALL crta_insert_promprevsredstva(@p0, @p1, @p2, @p3);



	-- Unos podataka promena depozita
	SET @p0=''; -- id 
	SELECT PoslanikID INTO @p1 FROM Poslanik WHERE PoslanikID = '' LIMIT 1; -- poslanik ID
	SET @p2=''; -- datumod
	SET @p3=''; -- datumdo
	CALL crta_insert_promenadepozita(@p0, @p1, @p2, @p3);



	-- Unos podataka promena depozita
	SELECT OpozicijaID INTO @p0 FROM Opozicija WHERE Opozicija =''; -- opozicijaID 
	SELECT PoslanikID INTO @p1 FROM Poslanik WHERE PoslanikID = '' LIMIT 1; -- poslanik ID
	SET @p2=''; -- datumod
	SET @p3=''; -- datumdo
	SET @p4=''; -- id
	CALL crta_insert_promenaopozicije(@p0, @p1, @p2, @p3);



	-- Unos podataka promena nepokretne imovine
	SET @p0=''; -- id 
	SELECT PoslanikID INT @p1 FROM Poslanik WHERE PoslanikID = '' LIMIT 1; -- poslanik ID
	SET @p2=''; -- datumod
	SET @p3=''; -- datumdo
	CALL crta_insert_promenanepokretneimovine(@p0, @p1, @p2, @p3);



	-- Unos podataka promena nepokretne imovine
	SELECT PoslanikID INT @p0 FROM Poslanik WHERE PoslanikID = '' LIMIT 1; -- poslanik ID
	SELECT StrankaID INT @p1 FROM Stranka WHERE Naziv = '' LIMIT 1; -- stranka ID
	SET @p2=''; -- datumod
	SET @p3=''; -- datumdo
	SET @P4=''; -- id
	CALL crta_insert_promenastranke(@p0, @p1, @p2, @p3);



	-- Unos podataka promena nepokretne imovine
	SELECT PoslanikID INT @p0 FROM Poslanik WHERE PoslanikID = '' LIMIT 1; -- poslanik ID
	SELECT PoslKlubID INT @p1 FROM PoslanickiKlub WHERE Naziv = '' LIMIT 1; -- posl klub ID
	SET @p2=''; -- datumod
	SET @p3=''; -- datumdo
	SET @P4=''; -- id
	CALL crta_insert_promenaposlanickogkluba(@p0, @p1, @p2, @p3);
