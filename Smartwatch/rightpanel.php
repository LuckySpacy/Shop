
<?php

//include 'artikellist.php';


//$Artikellist->LeseArtikel($EigenschaftnameList);
echo('Zur='.$zur.'<br>');
$SatzZaehler = 0;
$SatzZaehler2 = 0;

if ($zur == 1 ){
	$LastRow = $LastRow - ($MaxRow*2);
	if ($LastRow < 0) {$LastRow = 0;}
}	

foreach($Artikellist->Liste as $Artikel) {
	$SatzZaehler++;
	if ($SatzZaehler <= $LastRow) {continue;}
	$SatzZaehler2++;
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
	if ($SatzZaehler2 >= $MaxRow) {break;}
}


$LastRow = $SatzZaehler;


include('blaettern.php');

echo('</div>');

	
?>
