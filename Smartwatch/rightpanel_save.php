
<?php

function SqlJoin($sql, $Liste, $Id) {
	if(empty($Liste)== true) {
		return $sql;
	}
	$Check = implode(",", $Liste);
	if($Check == '') {
  	//echo('Leer <br>');
		return $sql;
	}
	
	//echo('InListe');
  $InList = InListe($Liste);
	//echo($InList .'<br>');
	
	$sql = $sql.' join artikeleigenschaft t'.$Id.' on'.
		          ' t'.$Id.'.ae_ar_id = ar_id and t'.$Id.'.ae_en_id = '.$Id.' and t'.$Id.'.ae_ei_id in '.$InList;	
	return $sql;
}


function InListe($UebergabeList) {
    $ret = '';
    if (empty($UebergabeList) == true) {
      return $ret;
    }
    $Anzahl = count($UebergabeList);
    //echo($Anzahl."<br>");
    $z = '0';
    while ($z < $Anzahl) {
        if ($ret != '')  {$ret = $ret.','.$UebergabeList[$z];}
        if ($ret == '') {$ret = $UebergabeList[$z];}
        $z++;
    }
    if ($ret != '') {$ret = '('.$ret.')';}
        
    return $ret;
}


function SqlInList($Uebergabelist, $Id) {
	global $sql;
	if(empty($Herstellerlist)== false) {
  	$InList = InListe($Herstellerlist);
  	if ($InList != '') {
			$sql = $sql.' join artikeleigenschaft on ae_ar_id = ar_id and ae_en_id = '.$Id.' and ae_ei_id in '.$InList;    
  	}
	}
}

global $Funktionenlist;
global $Fitnesslist;
global $Ausstattunglist;
global $SensorList;

/*
global $FitnessModusList;
global $KompatibelList;
global $UhrengehausedickeList;
global $Uhrenmateriallist;
*/
echo('<div id="rightpanel">');
	
//if(empty($Herstellerlist)== true) {echo('leer');};

 $sql = 'select distinct AR_MATCH, FA_NR, FA_WEBSEITE, FA_IMAGEURL from artikel'
         .' join firmaartikel on fa_ar_id = ar_id and fa_fi_id = 1';


//print_r($Programmlist);
$sql = SqlJoin($sql, $Herstellerlist, 1);
$sql = SqlJoin($sql, $Funktionenlist, 2);
$sql = SqlJoin($sql, $Ausstattunglist, 3);
$sql = SqlJoin($sql, $SensorList, 4);

/*
$sql = SqlJoin($sql, $Fitnesslist, 8);
$sql = SqlJoin($sql, $FitnessModusList, 9);
$sql = SqlJoin($sql, $SensorList, 12);
$sql = SqlJoin($sql, $KompatibelList, 7);
$sql = SqlJoin($sql, $UhrengehausedickeList, 6);
$sql = SqlJoin($sql, $Uhrenmateriallist, 5);
*/


SqlInList($Herstellerlist, 1);
SqlInList($Funktionenlist, 2);
SqlInList($Ausstattunglist, 3);
SqlInList($SensorList, 4);


/*

if(empty($Herstellerlist)== false) {
  $InList = InListe($Herstellerlist);
  if ($InList != '') {
      $sql = $sql.' join artikeleigenschaft on ae_ar_id = ar_id and ae_en_id = 1 and ae_ei_id in '.$InList;    	
  }
}

if(empty($Funktionenlist)== false) {
  $InList = InListe($Funktionenlist);
  if ($InList != '') {
      $sql = $sql.' join artikeleigenschaft on ae_ar_id = ar_id and ae_en_id = 2 and ae_ei_id in '.$InList;   
	}
}

if(empty($Ausstattunglist)== false) {
  $InList = InListe($Ausstattunglist);
  if ($InList != '') {
      $sql = $sql.' join artikeleigenschaft on ae_ar_id = ar_id and ae_en_id = 3 and ae_ei_id in '.$InList;   
	}
}



global $Fitnesslist;
if(empty($Fitnesslist)== false) {
  $InList = InListe($Fitnesslist);
  if ($InList != '') {
      $sql = $sql.' join artikeleigenschaft on ae_ar_id = ar_id and ae_en_id = 8 and ae_ei_id in '.$InList;   
	}
}


global $FitnessModusList;
if(empty($FitnessModusList)== false) {
//print_r($FitnessModusList);
  $InList = InListe($FitnessModusList);
  if ($InList != '') {
      $sql = $sql.' join artikeleigenschaft on ae_ar_id = ar_id and ae_en_id = 9 and ae_ei_id in '.$InList;   
	}
}


global $SensorList;
if(empty($SensorList)== false) {
//print_r($FitnessModusList);
  $InList = InListe($SensorList);
  if ($InList != '') {
      $sql = $sql.' join artikeleigenschaft on ae_ar_id = ar_id and ae_en_id = 12 and ae_ei_id in '.$InList;   
	}
}

global $KompatibelList;
if(empty($KompatibelList)== false) {
  $InList = InListe($KompatibelList);
  if ($InList != '') {
      $sql = $sql.' join artikeleigenschaft on ae_ar_id = ar_id and ae_en_id = 12 and ae_ei_id in '.$InList;   
	}
}

*/


//echo($sql);


/*
echo('<div class = "datenzeile">');
echo('<div class = "datenzeilebild">');
echo('Bild');
echo('</div>');
echo('<div class = "datenzeiletext">');
echo('Zeilentext');
echo('</div>');
echo('</div>');
*/	

include 'dbsettings.php';
$con = new mysqli($servername, $user, $pw, $db);
if ($con->connect_error) {
  die('Verbindung zur Datenbank ist fehlgeschlagen'.$con->connect_error);}

//echo($sql);
$res = $con->query($sql);
$datas = array();
if (mysqli_num_rows($res) > 0) {
	while ($row = mysqli_fetch_assoc($res)) {
		$datas[] = $row;
	}
}

//$datensatz = $res->fetch_all(MYSQLI_ASSOC);
$z1 = 0;
$z2 = 0;
$Row = 0; 
$AnzahlDatensaetze = count($datas);
echo('Anzahl Datensätze ='.$AnzahlDatensaetze);
global $MaxRow;
global $LastRow;
global $vor;
global $zur;
if ($zur != 1) {
	foreach($datas as $zeile) {
		$Row ++;
		$z2 ++;
		if ($z2 < $LastRow) {continue;}
		$z1 ++;
		if ($z1 > $MaxRow) {break;}
		//echo($z1);
  	echo('<div class = "datenzeile">');
  		echo('<div class = "datenzeilebild">');
				echo ('<img src="'.utf8_encode($zeile["FA_IMAGEURL"]).'" width="100" height="100">');
			echo('</div>');
			echo('<div id = "datenzeiletext">');
				echo('<p>');
					echo(utf8_encode($zeile["AR_MATCH"]));
				echo('</p>');
			echo('</div>');
		echo('</div>');
	}
}



if ($zur == 1) {
	$LastRow = $LastRow - $MaxRow;
	$LastRow = $LastRow - $MaxRow;
	$LastRow = $LastRow - 1;
	foreach($datas as $zeile) {
		$Row ++;
		$z2 ++;
		if ($z2 < $LastRow) {continue;}
		$z1 ++;
		if ($z1 > $MaxRow) {break;}
  	echo('<div class = "datenzeile">');
  		echo('<div class = "datenzeilebild">');
				echo ('<img src="'.utf8_encode($zeile["FA_IMAGEURL"]).'" width="100" height="100">');
			echo('</div>');
			echo('<div id = "datenzeiletext">');
				echo(utf8_encode($zeile["AR_MATCH"]));
			echo('</div>');
		echo('</div>');
	}
}

$LastRow = $Row;
//echo('LastRow'.$LastRow);


/*
while($i = $res->fetch_assoc()) {
  echo('<div class = "datenzeile">');
  echo('<div class = "datenzeilebild">');
	//echo('Bild');
  echo ('<img src="'.utf8_encode($i["FA_IMAGEURL"]).'" width="100" height="100">');
	echo('</div>');
//  echo ('<img src="'.utf8_encode($i["FA_IMAGEURL"]).'" height="100">');
	//echo(utf8_encode($i["AR_MATCH"])."<br>");
  echo('<div id = "datenzeiletext">');
	//echo('datenzeile');
	echo(utf8_encode($i["AR_MATCH"]));
	echo('</div>');
	echo('</div>');
	}	
*/  
include('blaettern.php');

echo('</div>');



/*
<p> 
	
	Hallo6 <br>
	Hallo5 <br>
	Hallo4 <br>
	Hallo3 <br>
	Hallo2 <br>
	Hallo1 <br>
</p>
*/

	
?>
