
<?php

//include 'artikellist.php';

/*
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
*/
/*
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
}*/

/*
function SqlInList($Uebergabelist, $Id) {
	global $sql;
	if(empty($Uebergabelist)== false) {
  	$InList = InListe($Uebergabelist);
  	if ($InList != '') {
			$sql = $sql.' join artikeleigenschaft on ae_ar_id = ar_id and ae_en_id = '.$Id.' and ae_ei_id in '.$InList;    
  	}
	}
}


echo('<div id="rightpanel">');
	
 $sql = 'select distinct AR_MATCH, FA_NR, FA_WEBSEITE, FA_IMAGEURL from artikel'
         .' join firmaartikel on fa_ar_id = ar_id and fa_fi_id = 1';


foreach($EigenschaftnameList as $Liste) {
	$sql = SqlJoin($sql, $Liste->CheckedListe, $Liste->Id);
}
	
*/
//$Artikellist->LeseArtikel($EigenschaftnameList);
foreach($Artikellist->Liste as $Artikel) {
	echo('<div class = "datenzeile">');
		echo('<div class = "datenzeilebild">');
			echo ('<img src="'.$Artikel->ImageUrl.'" width="100" height="100">');
		echo('</div>');
		echo('<div id = "datenzeiletext">');
			echo('<p>');
				echo($Artikel->Match);
			echo('</p>');
		echo('</div>');
	echo('</div>');
}



/*
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
*/

include('blaettern.php');

echo('</div>');

	
?>
