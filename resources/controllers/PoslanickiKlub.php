<?php
	class PoslanickiKlub {
	   public static function hello() {
	        echo "Mi smo stranka";
	    }
	public static function sviKlubovi ($param){

		$conn = Flight::db();
        $data = $conn->prepare("SELECT * FROM `PoslanickiKlub`");
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
		 				
		 	print_r('<pre>');
		 	print_r($param->pass['as']);
		 	print_r('</pre>');
		 				
		print_r("<br>");
		print_r(json_encode($result));
	}
	public static function noviKlub($param = "")
	    {
	    	$conn = Flight::db();

	    	//treba  uzeti podatke i srediti ih
        	/*$data = $conn->prepare("INSERT INTO `crta`.`PoslanickiKlub` (`PoslKlubID`, `Naziv`, `StrankaID`, `Saziv`) VALUES ('1', 'Srpska napredna stranka', '1', '2012 - 2014')");*/
        	$data = $conn->prepare("INSERT INTO `PoslanickiKlub` values(null, 'srpska napredna stranka','1', '2012 - 2014') ");
        	$res = $data->execute();
        	/*$result = $data->fetchAll(PDO::FETCH_ASSOC);*/
		 				
		 		
		 	print_r(json_encode($res));
        
	    }
	public static function izbrisi($id = "")
	    {
	    	$conn = Flight::db();

	    	//treba  uzeti podatke i srediti ih
        	/*$data = $conn->prepare("DELETE FROM `PoslanickiKlub` WHERE `PoslKlubID`= 2");*/
        	$data = $conn->prepare("DELETE FROM `PoslanickiKlub` where PoslKlubID = ? ");
        	$res = $data->execute( array($id));
        	/*$result = $data->fetchAll(PDO::FETCH_ASSOC);*/
		 				
		 		
		 	print_r(json_encode($res));
        
	    }
	 public static function select($id = "")
	    {
	    	$conn = Flight::db();

	    	//treba  uzeti podatke i srediti ih
        	/*$data = $conn->prepare("INSERT INTO `crta`.`Stranka` (`StrankaID`, `Naziv`, `DatumOsnivanja`) VALUES ('1', 'SNS', '2008-10-21')");*/
        	$data = $conn->prepare("SELECT * FROM `PoslanickiKlub` WHERE `PoslKlubID` = ? ");
        	$res = $data->execute( array($id));
        	$result = $data->fetchAll(PDO::FETCH_ASSOC);
		 				
		 		
		 	print_r(json_encode($result));
        
	    }

	 public static function pretraga($param){
	 		$conn = Flight::db();

	 		$data = $conn->prepare("SELECT * FROM `PoslanickiKlub` WHERE $param ");
	 		$res = $data->execute( array($param));
	 		$result = $data->fetchAll(PDO::FETCH_ASSOC);

	 		print_r(json_encode($result));

	 }
	 public static function poslaniciUKlubu($id){
	 		$conn = Flight::db();
	 		//select Ime, Prezime from Poslanik 
   /*inner join PoslanickiKlub on Poslanik.PoslKlubID = PoslanickiKlub.PoslKlubID
   where PoslanickiKlub.PoslKlubID = 1;*/
	 		$data = $conn->prepare("SELECT * FROM `Poslanik` INNER JOIN `PoslanickiKlub` ON Poslanik.PoslKlubID = PoslanickiKlub.PoslKlubID WHERE PoslanickiKlub.PoslKlubID = ?");
	 		$res = $data->execute (array($id));
	 		$result = $data->fetchAll(PDO::FETCH_ASSOC);

	 		print_r(json_encode($result));

	 }
	 public static function poslaniciZenskogPola($klub){
	 		$conn = Flight::db();
	 		 
	 		$data = $conn->prepare("SELECT * FROM poslanik 
			INNER JOIN poslanickiKlub ON poslanik.poslKlubID = poslanickiKlub.poslKlubID
			WHERE poslanik.pol = 2 AND poslanickiKlub.naziv = ?;");
	 		$res = $data->execute (array($klub));
	 		$result = $data->fetchAll(PDO::FETCH_ASSOC);

	 		print_r(json_encode($result));

	 }
	 public static function funkcijeUKlubu($klub){
	 		$conn = Flight::db();
	 		 

	 		$data = $conn->prepare("SELECT * FROM poslanik
			INNER JOIN funkcija ON funkcija.poslanikID = poslanik.poslanikID
			INNER JOIN poslanickiKlub ON poslanik.PoslKlubID = poslanickiKlub.PoslKlubID
			WHERE poslanickiKlub.Naziv = ?");
	 		$res = $data->execute (array($klub));
	 		$result = $data->fetchAll(PDO::FETCH_ASSOC);

	 		print_r(json_encode($result));

	 }
	  public static function brojFunkcijaUKlubu($klub){
	 		$conn = Flight::db();
	 		 

	 		$data = $conn->prepare("SELECT COUNT(*) FROM poslanik
			INNER JOIN funkcija ON funkcija.poslanikID = poslanik.poslanikID
			INNER JOIN poslanickiKlub ON poslanik.PoslKlubID = poslanickiKlub.PoslKlubID
			WHERE poslanickiKlub.Naziv = ?");
	 		$res = $data->execute (array($klub));
	 		$result = $data->fetchAll(PDO::FETCH_ASSOC);

	 		print_r(json_encode($result));

	 }
	  public static function prosecniPrihodiUKlubu($klub){
	 		$conn = Flight::db();
	 		 
   			
			
			//$kratki = ($klub->pass['klub']);
			
	 		$data = $conn->prepare(
	 		"SELECT Poslanik.pol, PoslanickiKlub.kratak, Round(AVG( Prihodi ), 2) AS prihodi
			FROM Poslanik
			INNER JOIN Funkcija ON Funkcija.PoslanikID = Poslanik.PoslanikID
			INNER JOIN PoslanickiKlub ON Poslanik.PoslKlubID = PoslanickiKlub.PoslKlubID
			where ( Funkcija.VremeOD > (curdate() -  interval 2 YEAR) )
			GROUP BY PoslanickiKlub.kratak, Poslanik.pol");
	 		$res = $data->execute (/*array($kratki)*/);
	 		$result = $data->fetchAll(PDO::FETCH_ASSOC);

	 		print_r(json_encode($result));

	 }
	  public static function ukupniPrihodiUKlubu($klub){
	 		$conn = Flight::db();
	 		 
	 		$data = $conn->prepare("SELECT sum(prihodi) FROM poslanik
			INNER JOIN funkcija ON funkcija.poslanikID = poslanik.poslanikID
			INNER JOIN poslanickiKlub ON poslanik.PoslKlubID = poslanickiKlub.PoslKlubID
			WHERE poslanickiKlub.Naziv = ?");
	 		$res = $data->execute (array($klub));
	 		$result = $data->fetchAll(PDO::FETCH_ASSOC);

	 		print_r(json_encode($result));

	 }
	 public static function prosecniPrihodiUKlubuPoPolu($klub, $pol){
	 		$conn = Flight::db();

	 		$data = $conn->prepare("SELECT avg(prihodi) FROM poslanik
			INNER JOIN funkcija ON funkcija.poslanikID = poslanik.poslanikID
			INNER JOIN poslanickiKlub ON poslanik.PoslKlubID = poslanickiKlub.PoslKlubID
			WHERE poslanickiKlub.Naziv = ? AND pol = ?");
	 		$res = $data->execute (array($klub,$pol));
	 		$result = $data->fetchAll(PDO::FETCH_ASSOC);

	 		print_r(json_encode($result));

	 }
	 public static function ukupniPrihodiUKlubuPoPolu($klub, $pol){
	 		$conn = Flight::db();

	 		$data = $conn->prepare("SELECT sum(prihodi) FROM poslanik
			INNER JOIN funkcija ON funkcija.poslanikID = poslanik.poslanikID
			INNER JOIN poslanickiKlub ON poslanik.PoslKlubID = poslanickiKlub.PoslKlubID
			WHERE poslanickiKlub.Naziv = ? AND pol = ?");
	 		$res = $data->execute (array($klub, $pol));
	 		$result = $data->fetchAll(PDO::FETCH_ASSOC);

	 		print_r(json_encode($result));
	 	}

	 public static function prosecniPrihodiPoVremenu(){
	 		$conn = Flight::db();

			$data = $conn->prepare(
			"SELECT PoslKlub.kratak, ROUND(AVG( Prihodi ), 2)AS prihodi, year( Funkcija.VremeOD ) as godina
			FROM Poslanik
			INNER JOIN Funkcija ON Funkcija.PoslanikID = Poslanik.PoslanikID
			INNER JOIN PoslKlub ON Poslanik.PoslKlubID = PoslKlub.PoslKlubID
			where  Funkcija.VremeOD > (curdate() -  interval 5 YEAR) and Funkcija.IntervalF like 'Mese%no'
			GROUP BY PoslKlub.kratak, year(Funkcija.VremeOD)");
			$res = $data->execute();
			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			//print_r($result);
			print_r(json_encode($result));

	 }
	 public static function strukturaPoGodinama() {
	 		$conn = Flight::db();

	 		$data = $conn->prepare("SELECT godiste, count(*) as broj FROM `Poslanik` group by godiste");
	 		$res = $data->execute();
			$result = $data->fetchAll(PDO::FETCH_ASSOC);

			print_r(json_encode($result));
	 }


	 
}


?>