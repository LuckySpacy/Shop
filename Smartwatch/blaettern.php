<?php

global $LastRow;
global $zur;
global $MaxRow;
global $AnzahlDatensaetze;
global $Programmlist;
global $Fitnesslist;
global $FitnessModusList;
global $SensorList;
global $KompatibelList;
global $UhrengehausedickeList;
global $Uhrenmateriallist;

echo('<form name="vorzurueck" action="" method="post">');

if(empty($Herstellerlist)== false) {
	$StrHerstellerlist = implode(",", $Herstellerlist);
}

if(empty($Programmlist)== false) {
	$StrProgrammlist = implode(",", $Programmlist);
}

if(empty($Fitnesslist)== false) {
	$StrFitnesslist = implode(",", $Fitnesslist);
}

if(empty($FitnessModusList)== false) {
	$StrFitnessModuslist = implode(",", $FitnessModusList);
}

if(empty($SensorList)== false) {
	$StrSensorList = implode(",", $SensorList);
}

if(empty($KompatibelList)== false) {
	$StrKompatibelList = implode(",", $KompatibelList);
}

if(empty($UhrengehausedickeList)== false) {
	$StrUhrengehausedickeList = implode(",", $UhrengehausedickeList);
}

if(empty($Uhrenmateriallist)== false) {
	$StrUhrenmateriallist = implode(",", $Uhrenmateriallist);
}



//print_r($FitnessModusList);




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
if(empty($Herstellerlist)== true) {echo('<input type= "hidden" name="vorzurHerstellerlist" value="">');}
if(empty($Herstellerlist)== false) {echo('<input type= "hidden" name="vorzurHerstellerlist" value="'.$StrHerstellerlist.'">');}
if(empty($Programmlist)== true) {echo('<input type= "hidden" name="vorzurProgrammlist" value="">');}
if(empty($Programmlist)== false) {echo('<input type= "hidden" name="vorzurProgrammlist" value="'.$StrProgrammlist.'">');}
if(empty($Fitnesslist)== true) {echo('<input type= "hidden" name="vorzurFitnesslist" value="">');}
if(empty($Fitnesslist)== false) {echo('<input type= "hidden" name="vorzurFitnesslist" value="'.$StrFitnesslist.'">');}
if(empty($FitnessModusList)== true) {echo('<input type= "hidden" name="vorzurFitnessModuslist" value="">');}
if(empty($FitnessModusList)== false) {echo('<input type= "hidden" name="vorzurFitnessModuslist" value="'.$StrFitnessModuslist.'">');}
if(empty($SensorList)== true) {echo('<input type= "hidden" name="vorzurSensorlist" value="">');}
if(empty($SensorList)== false) {echo('<input type= "hidden" name="vorzurSensorlist" value="'.$StrSensorList.'">');}
if(empty($KompatibelList)== true) {echo('<input type= "hidden" name="vorzurKompatibellist" value="">');}
if(empty($KompatibelList)== false) {echo('<input type= "hidden" name="vorzurKompatibellist" value="'.$StrKompatibelList.'">');}
if(empty($UhrengehausedickeList)== true) {echo('<input hidden= "text" name="vorzurUhrengehausedickelist" value="">');}
if(empty($UhrengehausedickeList)== false) {echo('<input hidden= "text" name="vorzurUhrengehausedickelist" value="'.$StrUhrengehausedickeList.'">');}
if(empty($Uhrenmateriallist)== true) {echo('<input type= "hidden" name="vorzurUhrenmateriallist" value="">');}
if(empty($Uhrenmateriallist)== false) {echo('<input type= "hidden" name="vorzurUhrenmateriallist" value="'.$StrUhrenmateriallist.'">');}

//echo('<input type= "text" name="vorzurProgrammlist" value="">');

//echo($zur.'<br>');
echo('<input type= "hidden" name="LastRow" value="'.$LastRow.'"');
echo('<input type= "hidden" name="LastRow" value="'.$LastRow.'"');
echo('</div>');


echo('</form>');

/*
echo('<div id="steuerung">');
echo('Hurra');
//echo('<input type="submit" name="zuruck" value="Zurück"/>');
//echo('<input type="submit" name="vor" value="Weiter"/>');
echo('</div>');
*/


?>