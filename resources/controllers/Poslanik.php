<?php
	class Poslanik {
	    public static function hello2() {
	        echo 'hello world dva!';
	    }

	    public static function sviPoslanici($param)
	    {
	    	$conn = Flight::db();
        	$data = $conn->prepare("SELECT * FROM `Poslanik` as p inner join PoslKlub as pk on p.poslKlubId = pk.poslKlubId  ");
        	$data->execute();
        	$result = $data->fetchAll(PDO::FETCH_ASSOC);
		 				
		 				print_r('<pre>');
		 				print_r($param->pass['as']);
		 				print_r('</pre>');
		 				
		 	print_r("<br>");
		 	print_r(json_encode($result));
        
	    }

	    public static function novPoslanik($param = "")
	    {
	    	$conn = Flight::db();

	    	//treba  uzeti podatke i srediti ih
        	/*$data = $conn->prepare("INSERT INTO `Poslanik`(poslanikId, izvorPodataka,Drzava, Ime, prezime) values(1,'ne znam','srbija','tomislav','nikolic') ");*/
        	$data = $conn->prepare("INSERT INTO `Poslanik` values(null, 'ne znam','srbija','tomislav','nikolic', null, null, null, null, null, null) ");
        	$res = $data->execute();
        	/*$result = $data->fetchAll(PDO::FETCH_ASSOC);*/
		 				
		 		
		 	print_r(json_encode($res));
        
	    }

	    public static function izbrisi($id = "")
	    {
	    	$conn = Flight::db();

	    	//treba  uzeti podatke i srediti ih
        	/*$data = $conn->prepare("INSERT INTO `Poslanik`(poslanikId, izvorPodataka,Drzava, Ime, prezime) values(1,'ne znam','srbija','tomislav','nikolic') ");*/
        	$data = $conn->prepare("DELETE FROM `Poslanik` where poslanikId = ? ");
        	$res = $data->execute( array($id));
        	/*$result = $data->fetchAll(PDO::FETCH_ASSOC);*/
		 				
		 		
		 	print_r(json_encode($res));
        
	    }

	    public static function select($id = "")
	    {
	    	$conn = Flight::db();

	    	//treba  uzeti podatke i srediti ih
        	/*$data = $conn->prepare("INSERT INTO `Poslanik`(poslanikId, izvorPodataka,Drzava, Ime, prezime) values(1,'ne znam','srbija','tomislav','nikolic') ");*/
        	$data = $conn->prepare("SELECT * from `Poslanik` where poslanikId = ? ");
        	$res = $data->execute( array($id));
        	$result = $data->fetchAll(PDO::FETCH_ASSOC);
		 				
		 		
		 	print_r(json_encode($result));
        
	    }
	    public static function brojPoslanikaPoPolu($pol){
	    	$conn = Flight::db();	    				

	    	/*select * from poslanik where pol = 2*/
	    	$data = $conn->prepare("SELECT * FROM Poslanik WHERE pol = ?");
	    	$res = $data->execute(array($pol));
	    	$result = $data->fetchAll(PDO::FETCH_ASSOC);

	    	print_r(json_encode($result));

	    }
	    public static function prosecanPrihod(){
	    	$conn = Flight::db();
	    	
	    	/*select avg(prihodi) from funkcija
			inner join poslanik on poslanik.poslanikID = funkcija.poslanikID*/
			$data = $conn->prepare("SELECT avg(prihodi) FROM funkcija
			INNER JOIN poslanik ON poslanik.poslanikID = funkcija.poslanikID");
			$res = $data->execute();
			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			print_r(json_encode($result));
	    }
	    public static function prosecanPrihodPoPolu($pol){
	    	$conn = Flight::db();

	    	/*select avg(prihodi) from funkcija
			inner join poslanik on poslanik.poslanikID = funkcija.poslanikID
			where pol = 1*/
			$data = $conn->prepare("SELECT avg(prihodi) FROM funkcija
			INNER JOIN poslanik ON poslanik.poslanikID = funkcija.poslanikID
			WHERE pol = ?");
			$res = $data->execute($pol);
			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			print_r(json_encode($result));

	    }
	    public static function ukupanPrihodPoslanika(){
	    	$conn = Flight::db();

	    	/*select sum(prihodi) from funkcija
			inner join poslanik on poslanik.poslanikID = funkcija.poslanikID*/
	    	$data = $conn->prepare("SELECT sum(prihodi) FROM funkcija
			INNER JOIN poslanik ON poslanik.poslanikID = funkcija.poslanikID");
			$res = $data->execute();
			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			print_r(json_encode($result));

	    }
	    public static function ukupanPrihodPoslanikaPoPolu($pol){
	    	$conn = Flight::db();

	    	/*select sum(prihodi) from funkcija
			inner join poslanik on poslanik.poslanikID = funkcija.poslanikID
			where pol =1*/
			$data = $conn->prepare("SELECT sum(prihodi) FROM funkcija
			INNER JOIN poslanik ON poslanik.poslanikID = funkcija.poslanikID
			WHERE pol = ?");
			$res = $data->execute();
			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			print_r(json_encode($result));
	    }
	    public static function testMetoda(){
	    	$test = array("1" => "Prvi", "2" => "Drugi", "3" => "Treci");

	    	echo json_encode($test);
	    }
	    public static function ukupnaPrimanjaPoGodini(){
	    	$conn = Flight::db();

	    	/*SELECT Ime, Prezime, Funkcija.Naziv, Prihodi  FROM Poslanik
			INNER JOIN Funkcija ON Funkcija.PoslanikID = Poslanik.PoslanikID
			inner join PoslKlub on Poslanik.PoslKlubID = PoslKlub.PoslKlubID
			where ( Funkcija.VremeOD > (curdate() -  interval 2 YEAR) )
			group by Poslanik.PoslanikID*/
			$data = $conn->prepare("SELECT Ime, Prezime, Funkcija.Naziv, Prihodi  FROM Poslanik
			INNER JOIN Funkcija ON Funkcija.PoslanikID = Poslanik.PoslanikID
			inner join PoslKlub on Poslanik.PoslKlubID = PoslKlub.PoslKlubID
			where ( Funkcija.VremeOD > (curdate() -  interval 2 YEAR) )
			group by Poslanik.PoslanikID");
			$res = $data->execute();
			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			print_r(json_encode($result));
	    }


	    public static function prihodiPoOpstinama(){
	 	$conn = Flight::db();

	 	/*SELECT  Ime, Prezime, Mesto.Opstina, Mesto.Naziv, round(avg(Funkcija.Prihodi),2) as Mesecno FROM Poslanik
		INNER JOIN Funkcija ON Funkcija.PoslanikID = Poslanik.PoslanikID
		inner join Mesto on Mesto.MestoID = Poslanik.MestoID
		where  Funkcija.VremeOD > (curdate() -  interval 2 YEAR) and Funkcija.IntervalF like 'Mese%no'
		group by Ime, Prezime*/

		$data = $conn->prepare(
		"SELECT  Ime, Prezime, Mesto.Opstina, Mesto.Naziv, round(avg(Funkcija.Prihodi),2) as Mesecno FROM Poslanik
		INNER JOIN Funkcija ON Funkcija.PoslanikID = Poslanik.PoslanikID
		inner join Mesto on Mesto.MestoID = Poslanik.MestoID
		where  Funkcija.VremeOD > (curdate() -  interval 2 YEAR) and Funkcija.IntervalF like 'Mese%no'
		group by Ime, Prezime");

		$res = $data->execute();
		$result = $data->fetchAll(PDO::FETCH_ASSOC);

		print_r(json_encode($result));

	 }


	 public static function povrsinaStambenihJedinica(){
		$conn = Flight::db();

		/*select Poslanik.Ime, Poslanik.Prezime, round(sum(Povrsina),0) from NepokretnaImovina 
		INNER JOIN Poslanik ON Poslanik.PoslanikID = NepokretnaImovina.PoslanikID
		where (NepokretnaImovina.Tip  like 'ku%a') or (NepokretnaImovina.Tip like 'stan') 
		group BY Poslanik.PoslanikID*/

		$data = $conn->prepare(
			"SELECT Poslanik.Ime, Poslanik.Prezime, round(sum(Povrsina),0) from NepokretnaImovina 
			INNER JOIN Poslanik ON Poslanik.PoslanikID = NepokretnaImovina.PoslanikID
			where (NepokretnaImovina.Tip  like 'ku%a') or (NepokretnaImovina.Tip like 'stan') 
			group BY Poslanik.PoslanikID");
		$res = $data->execute();
		$result = $data->fetchAll(PDO::FETCH_ASSOC);

		print_r(json_encode($result));

		//sjhadkjshd
	}
	public static function izlistajPolove(){
        $db = Flight::db();
        $a=0;
        foreach($db->query('SELECT * FROM PoslKlub') as $row) {
            $a++;
        	$nazivstranke = $row['Naziv'];
        	$id_stranke=$row['PoslKlubID'];
        	$polz = 1;
        	$polm = 0;
        	$stmt = $db->prepare("SELECT * FROM Poslanik WHERE PoslKlubID=:poslklub_id AND Pol=:pol");
        	$stmt->bindValue(':poslklub_id', $id_stranke, PDO::PARAM_INT);
        	$stmt->bindValue(':pol', $polz, PDO::PARAM_INT);
        	$stmt->execute();
        	$row_countz = $stmt->rowCount();
        	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        	$stmt1 = $db->prepare("SELECT * FROM Poslanik WHERE PoslKlubID=:poslklub_id AND Pol=:pol");
        	$stmt1->bindValue(':poslklub_id', $id_stranke, PDO::PARAM_INT);
        	$stmt1->bindValue(':pol', $polm, PDO::PARAM_INT);
        	$stmt1->execute();
        	$row_countm = $stmt1->rowCount();
        	$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        	$arraypolz=array(
            "Pol" => 'z',
            "broj" =>  $row_countz
        );
        $arraypolm=array(
            "Pol" => 'm',
            "broj" => $row_countm
        );
        $arraypol = array(
            $arraypolm,$arraypolz
        );
        $array[/*$a*/] = array(
    		"PoslKlub" => $nazivstranke,
    		"brojpol" => $arraypol,
		);


 /*
U suštini za svaku stranku selekttovati poslanike,pol gdje je vrijednost z i izbrjati
U suštini za svaku stranku selekttovati poslanike,pol gdje je vrijednost m i izbrjati
                   */
		}
		$jsonencode = json_encode($array, true);
        echo $jsonencode;
      }
    
	/*public static function stringZaKvartal($param)
	{
		return "select (year($param)-2008)*4+quarter($param) as Kvartal, Poslanik.PoslanikID from PromenaOpozicije
		inner join Poslanik On Poslanik.PoslanikID = PromenaOpozicije.PoslanikID
		where year($param) > 2007
		order by Poslanik.PoslanikID";
	}*/

      public static function kvartalniIzvestaj(){
      	$conn = Flight::db();
      	$data = $conn->prepare("SELECT concat(Poslanik.Ime,' ', Poslanik.Prezime) AS Poslanik, (year(DatumOD)-2008)*4+quarter(DatumOD) AS Kvartal, Poslanik.PoslanikID FROM PromenaOpozicije
								INNER JOIN Poslanik ON Poslanik.PoslanikID = PromenaOpozicije.PoslanikID
								WHERE year(DatumOD) > 2007
								ORDER BY Poslanik.PoslanikID");
      	$res = $data->execute();
      	$result = $data(PDO::FETCH_ASSOC);

      	print_r(json_encode($result));

      }
      /*public static function prihodiPoKvartalu()
      {
      	$conn = Flight::db();
      	$data = $conn->prepare("SELECT CONCAT(Poslanik.Ime, ' ', Poslanik.Prezime) AS Poslanik, (year(MIN(VremeOd))-2008)*4+quarter(MIN(VremeOd)) AS PrviKvartal, (year(MAX(VremeOd))-2008)*4+quarter(MAX(VremeOd)) AS PoslednjiKvartal,Funkcija.Naziv, Funkcija.Prihodi , Poslanik.PoslanikID FROM Funkcija
		INNER JOIN Poslanik ON Poslanik.PoslanikID = Funkcija.PoslanikID
		WHERE year(VremeOd) > 2007
		GROUP BY Funkcija.Prihodi
		ORDER BY Poslanik.PoslanikID");
      	$res = $data->execute();
      	$result = $data->fetchAll(PDO::FETCH_ASSOC);

      	print_r(json_encode($result));
      }*/
      public static function nepokretnaImovinaPoKvartalima()
      {
      	$conn = Flight::db();
      	$data = $conn->prepare("SELECT concat(Poslanik.Ime,' ', Poslanik.Prezime) as Poslanik, (year(MIN(PromenaNepokretneImovine.DatumOd))-2008)*4+quarter(MIN(PromenaNepokretneImovine.DatumOd)) as PrviKvartal,(year(MAX(PromenaNepokretneImovine.DatumOd))-2008)*4+quarter(MAX(PromenaNepokretneImovine.DatumOd)) as PoslednjiKvartal, Tip, Povrsina, jedinicaMerePovrsine FROM NepokretnaImovina 
		INNER JOIN Poslanik on NepokretnaImovina.PoslanikID = Poslanik.PoslanikID
		INNER JOIN PromenaNepokretneImovine on PromenaNepokretneImovine.NekretninaID = NepokretnaImovina.NepokretnaImovinaID
		WHERE year(PromenaNepokretneImovine.DatumOd) > 2007
		GROUP BY PromenaNepokretneImovine.NekretninaID
		ORDER BY Poslanik.PoslanikID");
      	$res = $data->execute();
		$result = $data->fetchAll(PDO::FETCH_ASSOC);

		print_r(json_encode($result));
      }


 

    public static function prihodiPoKvartalima()
      { 
      	$conn = Flight::db();
      	$data = $conn->prepare("SELECT Poslanik.PoslanikID AS id, Poslanik.Ime AS ime, Poslanik.Prezime AS prezime, Poslanik.Pol AS pol, Profesija.naziv AS profesija, Poslanik.godiste AS godiste, Poslanik.OpozicijaID AS opozicija, PoslanickiKlub.kratak AS stranka, SUM(  `Prihod` ) AS UkupnaPlata, Kvartal
FROM  `GrupisanePlate` 
INNER JOIN Poslanik ON GrupisanePlate.PoslanikID = Poslanik.PoslanikID
INNER JOIN PoslanickiKlub ON Poslanik.PoslKlubID = PoslanickiKlub.PoslKlubID
INNER JOIN Profesija ON Profesija.ProfesijaId = Poslanik.profesija
GROUP BY GrupisanePlate.PoslanikID, Kvartal");
      	$res = $data->execute();
		$result = $data->fetchAll(PDO::FETCH_ASSOC);

		$noviRez = self::sredjivanje($result);
		

		print_r(json_encode($noviRez));
      }

   	public static function prosekPoKvartalima()
      { 
      	$conn = Flight::db();
      	$data = $conn->prepare("
      		select avg (UkupnaPlata) as UkupnaPlata, Kvartal from 
(SELECT Poslanik.Ime as ime, Poslanik.Prezime as prezime, Poslanik.Pol as pol, Poslanik.PoslanikID as id, SUM(`Prihod`) AS UkupnaPlata, Kvartal FROM `GrupisanePlate` 
		INNER JOIN Poslanik ON GrupisanePlate.PoslanikID = Poslanik.PoslanikID
		GROUP BY GrupisanePlate.PoslanikID, Kvartal
                ) as grupisano
                
  GROUP BY grupisano.Kvartal 

      		");
      	$res = $data->execute();
		$result = $data->fetchAll(PDO::FETCH_ASSOC);

		$noviRez = array("ime" => "Prosek","plate" =>$result);
		

		print_r(json_encode($noviRez ));
      } 

     public static function prosekPoPolu()
      { 
      	$conn = Flight::db();
      	$data = $conn->prepare("
      		select avg (UkupnaPlata) as UkupnaPlata, Kvartal, pol from 
(SELECT Poslanik.Ime as ime, Poslanik.Prezime as prezime, Poslanik.Pol as pol, Poslanik.PoslanikID as id, SUM(`Prihod`) AS UkupnaPlata, Kvartal FROM `GrupisanePlate` 
		INNER JOIN Poslanik ON GrupisanePlate.PoslanikID = Poslanik.PoslanikID
		GROUP BY GrupisanePlate.PoslanikID, Kvartal
                ) as grupisano
                
  GROUP BY grupisano.Kvartal , grupisano.pol

      		");
      	$res = $data->execute();
		$result = $data->fetchAll(PDO::FETCH_ASSOC);

		$muskarci = array_filter($result, function ($unos='')
		{
			return intval($unos['pol'])  == 1;
		});

		$zene = array_filter($result, function ($unos='')
		{
			return intval($unos['pol'])  == 2;
		});

		$noviRez[] = array("ime" => "Polovi" , "prezime" => "muskarci","plate" => array_values($muskarci));
		$noviRez[] = array("ime" => "Polovi" , "prezime" => "zene","plate" =>  array_values($zene) );
		

		print_r(json_encode($noviRez ));
      } 


      public static function prosekPoOpoziciji()
      { 
      	$conn = Flight::db();
      	$data = $conn->prepare("
      		SELECT AVG( UkupnaPlata ) AS UkupnaPlata, Kvartal,  `OpozicijaID` as opo
FROM (

SELECT Poslanik.Ime AS ime, Poslanik.Prezime AS prezime, Poslanik.Pol AS pol, Poslanik.PoslanikID AS id, Poslanik.OpozicijaID, SUM(  `Prihod` ) AS UkupnaPlata, Kvartal
FROM  `GrupisanePlate` 
INNER JOIN Poslanik ON GrupisanePlate.PoslanikID = Poslanik.PoslanikID
GROUP BY GrupisanePlate.PoslanikID, Kvartal
) AS grupisano
GROUP BY grupisano.Kvartal, grupisano.OpozicijaID

      		");
      	$res = $data->execute();
		$result = $data->fetchAll(PDO::FETCH_ASSOC);

		$vlast = array_filter($result, function ($unos='')
		{
			return intval($unos['opo'])  == 1;
		});

		$opozicija = array_filter($result, function ($unos='')
		{
			return intval($unos['opo'])  == 2;
		});

		$noviRez[] = array("ime" => "Opozicija" , "prezime" => "Vlast","plate" => array_values($vlast));
		$noviRez[] = array("ime" => "Opozicija" , "prezime" => "Opozicija","plate" =>  array_values($opozicija) );
		

		print_r(json_encode($noviRez ));
      } 

      
private static function razvrstajKlubove($sqlNiz)
{

	$noviRez = array( );//inicijalizacija

	$kljucevi = range(0,15); //mali hack -treba upit sa identifikatorima posanickih grupa


	for ($brojac = 0, $lon = count($kljucevi); $brojac < $lon ; $brojac++) { 
		
		$tempArrayGrup = array_filter( $sqlNiz, function ($el) use (&$brojac)
					{													
					return  intval($el['klubId'])  == $brojac; //$brojac;
					} );

					
		if (count($tempArrayGrup) < 1 ) continue;
		$tempArrayGrup = array_values($tempArrayGrup);
		$podaci = $tempArrayGrup[0];

		$tempArrayGrup = array_map(function ($el='')
		{
			return array("UkupnaPlata"=>$el['UkupnaPlata'], "Kvartal"=>$el["Kvartal"]);
		}, $tempArrayGrup);
							
					
		$tempPoslanik = array( "ime"=> "Klub", "prezime"=>$podaci['naziv'],"klubId"=>$podaci['klubId']  ,'plate' => $tempArrayGrup);	
		$noviRez[] = $tempPoslanik;
	}
	return $noviRez;
	
}



private static function razvrstajProfesije($sqlNiz)
{

	$noviRez = array( );//inicijalizacija

	$nizProfesija = array('inženjer' ,'ekonmista' ,'lekar' ,'penzioner' ,'politikolog','pravnik' ,'preduzetnik' ,'profesor' ,'profesor univerziteta' ,'student'  );
	//$kljucevi = range(0,10); //mali hack -treba upit sa identifikatorima profesija


	for ($brojac = 0, $lon = count($nizProfesija); $brojac < $lon ; $brojac++) { 
		
		$tempArrayGrup = array_filter( $sqlNiz, function ($el) use (&$brojac, $nizProfesija)
					{													
					return  $el['profesija']  == $nizProfesija[$brojac]; //$brojac;
					} );

					
		if (count($tempArrayGrup) < 1 ) continue;
		$tempArrayGrup = array_values($tempArrayGrup);
		$podaci = $tempArrayGrup[0];

		$tempArrayGrup = array_map(function ($el='')
		{
			return array("UkupnaPlata"=>$el['UkupnaPlata'], "Kvartal"=>$el["Kvartal"]);
		}, $tempArrayGrup);
							
					
		$tempPoslanik = array( "ime"=> "Profesija", "prezime"=>$podaci['profesija'], "profesija"=> $podaci['profesija']  ,'plate' => $tempArrayGrup);	
		$noviRez[] = $tempPoslanik;
	}
	return $noviRez;
	
}

 public static function prosekPoKlubovima()
      { 
      	$conn = Flight::db();
      	$data = $conn->prepare("
      		SELECT AVG( UkupnaPlata ) AS UkupnaPlata, Kvartal,  kratak AS naziv, klubId 
FROM (

SELECT Poslanik.Ime AS ime, Poslanik.Prezime AS prezime, Poslanik.Pol AS pol, Poslanik.PoslanikID AS id, Poslanik.OpozicijaID, Poslanik.`PoslKlubID` as klubId , SUM( `Prihod` ) AS UkupnaPlata, Kvartal
FROM  `GrupisanePlate` 
INNER JOIN Poslanik ON GrupisanePlate.PoslanikID = Poslanik.PoslanikID
GROUP BY GrupisanePlate.PoslanikID, Kvartal
) AS grupisano
INNER JOIN PoslanickiKlub ON PoslanickiKlub.PoslKlubID = grupisano.klubId
GROUP BY grupisano.Kvartal, grupisano.klubId

      		");
      	$res = $data->execute();
		$result = $data->fetchAll(PDO::FETCH_ASSOC);

		$noviRez = self::razvrstajKlubove($result)	;	
		

		print_r(json_encode($noviRez ));
      } 



 public static function prosekPoProfesijama()
      { 
      	$conn = Flight::db();
      	$data = $conn->prepare("
      		SELECT AVG( UkupnaPlata ) AS UkupnaPlata, Kvartal, profesija
FROM (

SELECT Poslanik.Ime AS ime, Poslanik.Prezime AS prezime, Poslanik.Pol AS pol, Poslanik.PoslanikID AS id, Poslanik.OpozicijaID, Profesija.naziv as profesija , SUM( `Prihod` ) AS UkupnaPlata, Kvartal
FROM  `GrupisanePlate` 
INNER JOIN Poslanik ON GrupisanePlate.PoslanikID = Poslanik.PoslanikID
INNER JOIN Profesija ON Profesija.ProfesijaId = Poslanik.profesija
GROUP BY GrupisanePlate.PoslanikID, Kvartal
) AS grupisano
where profesija in ('inženjer' ,'ekonmista' ,'lekar' ,'penzioner' ,'politikolog','pravnik' ,'preduzetnik' ,'profesor' ,'profesor univerziteta' ,'student')
GROUP BY grupisano.Kvartal, grupisano.profesija

      		");
      	$res = $data->execute();
		$result = $data->fetchAll(PDO::FETCH_ASSOC);

		$noviRez = self::razvrstajProfesije($result)	;	
		

		print_r(json_encode($noviRez ));
      } 

    


private static function razvrstajGodista($sqlNiz='')
{
	$noviRez = array( );//inicijalizacija

	$kljucevi = range(0,12); //mali hack -treba upit sa brojem opsega


	for ($brojac = 0, $lon = count($kljucevi); $brojac < $lon ; $brojac++) { 
		
		$tempArrayGrup = array_filter( $sqlNiz, function ($el) use (&$brojac)
					{													
					return  intval($el['idGodista'])  == $brojac; //$brojac;
					} );

					
		if (count($tempArrayGrup) < 1 ) continue;
		$tempArrayGrup = array_values($tempArrayGrup);
		$podaci = $tempArrayGrup[0];

		$tempArrayGrup = array_map(function ($el='')
		{
			return array("UkupnaPlata"=>$el['UkupnaPlata'], "Kvartal"=>$el["Kvartal"]);
		}, $tempArrayGrup);
							
					
		$tempPoslanik = array("idGodista"=>$podaci['idGodista'], "opseg"=> $podaci['opseg'], /*"broj"=> $podaci['vrsnjaci'],*/'plate' => $tempArrayGrup);	
		$noviRez[] = $tempPoslanik;
	}
	return $noviRez;
}

 public static function prosekPoGodinama()
      { 
      	$conn = Flight::db();
      	// count(*) as vrsnjaci
      	$data = $conn->prepare("
      		SELECT AVG( UkupnaPlata ) AS UkupnaPlata, Kvartal,  concat( (god*10) ,'-',(god*10+9)) as opseg, god as idGodista
FROM (

SELECT Poslanik.PoslanikID AS id, Poslanik.OpozicijaID,  floor( (Poslanik.`Godiste`-1900)/10) as god, SUM(  `Prihod` ) AS UkupnaPlata, Kvartal
FROM  `GrupisanePlate` 

INNER JOIN Poslanik ON GrupisanePlate.PoslanikID = Poslanik.PoslanikID
GROUP BY GrupisanePlate.PoslanikID, Kvartal, godiste
) AS grupisano

GROUP BY grupisano.Kvartal, god


      		");
      	$res = $data->execute();
		$result = $data->fetchAll(PDO::FETCH_ASSOC);

		$noviRez = self::razvrstajGodista($result)	;	
		

		print_r(json_encode($noviRez ));
      } 





      public static function prihodiPoTestu()
      {
      	$conn = Flight::db();
      	$id = $_GET['PoslanikID'];
      	$data = $conn->prepare("SELECT Poslanik.Ime, Poslanik.Prezime, Poslanik.Pol, SUM(`Prihod`) AS UkupnaPlata, Kvartal FROM `GrupisanePlate` 
		INNER JOIN Poslanik ON GrupisanePlate.PoslanikID = Poslanik.PoslanikID
		WHERE PoslanikID = $id
		GROUP BY GrupisanePlate.PoslanikID, Kvartal");
      	$res = $data->execute();
		$result = $data->fetchAll(PDO::FETCH_ASSOC);

		print_r(json_encode($result));
      } 


	}
?>