<?php

function SetzeHidden ($Liste, $HiddenName) {
	$StrListe = '';
  if(empty($Liste)== false) {
	  $StrListe = implode(",", $Liste);
  }
	
  echo('<input type= "hidden" name="'.$HiddenName.'" value="'.$StrListe.'">');
	
}

global $LastRow;
global $zur;
global $MaxRow;
global $AnzahlDatensaetze;


echo('<form name="vorzurueck" action="" method="post">');

echo('<div id="steuerung">');
$CheckAnzahl = $LastRow - $MaxRow;
if ($CheckAnzahl > 1) {
	echo('<input type="submit" name="zuruck" value="Zurück"/>');
}  

if ($LastRow < $AnzahlDatensaetze) {
	echo('<input type="submit" name="vor" value="Weiter"/>');
}

echo('</div>');


echo('<div id="hiddentext">');
//echo('1');

foreach($EigenschaftnameList as $Liste) {
	$Liste->ErzeugeHiddenFeld();
}


echo('<input type= "hidden" name="LastRow" value="'.$LastRow.'"');
echo('<input type= "hidden" name="LastRow" value="'.$LastRow.'"');
echo('</div>');


echo('</form>');


?>