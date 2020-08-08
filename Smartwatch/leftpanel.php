<?php
  $MaxRow = 10;
  $LastRow = 0;
  $vor= 0;
  $zur= 0;

	
	foreach($EigenschaftnameList as $Liste) {
		$Liste->FuelleListeFromPost();
	}
	
		if (isset($_POST['LastRow'])){$LastRow = $_POST['LastRow'];}

		//echo('LastRow = '.$LastRow.'<br>');


	//var_dump($_POST);


	if (isset($_POST['vor'])) {
		$vor = 1;
	}

	if (isset($_POST['zuruck'])) {
		$zur = 1;
	}

	$Artikellist->LeseArtikel($EigenschaftnameList);
	//echo($Artikellist->ArtikelEigenschaftList->getInListe(2).'<br>');
	/*
	foreach($Artikellist->ArtikelEigenschaftList->Liste as $Artikeleigenschaft) {
		echo($Artikeleigenschaft->EiId.'<br>');
	} */


echo('<form id="smartformid" name="smartform" action="" method="post">');
echo('<div id="leftpanel">');

/*
echo('<div id="FilterbuttonOben">');
echo('<input id="Filterbtn" type="submit" name="suche" value="Filtern"/>');
echo('</div>');
*/

foreach($EigenschaftnameList as $Liste) {
	$Liste->ErzeugeCheckboxen($Artikellist->ArtikelEigenschaftList);
	$Liste->SetzeCheckboxHoehe();
}


//$EigenschaftnameList[1]->SetzeCheckboxHoehe();

/*
echo('<div id="Filterbutton">');
echo('<input id="Filterbtn" type="submit" name="suche" value="Filtern"/>');
echo('</div>');
*/

echo('</form>');


echo('</div>');







				
?>
