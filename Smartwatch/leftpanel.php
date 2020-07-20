<script>
	function doalert(checkboxElem){
		/*
  	if(checkboxElem.checked) {
        alert('checked');
    }else{
			alert('unchecked');
    }
		*/
		const myform = document.getElementById('myform');
		myform.addEventListener('submit', function(e) {
			e.preventDefault();
			const formData = new FormData(this);
			fehtch('Smartwatch.php', { method: 'post', body: formData})
			.then(function(response) response.text())
		
		//document.getElementById("smartform").submit();
  }
</script>    

<?php
	/*Global $Herstellerlist;*/
	$Herstellerlist = '';
	$Programmlist = '';
	$Fitnesslist = '';
	$FitnessModusList = '';
	$SensorList = '';
	$KompatibelList = '';
	$UhrengehauseformList = '';
	$UhrengehausedickeList = '';
  $Uhrenmateriallist = '';
  $Uhrenanzeigelist = '';
  $Sonstigelist = '';
  $Speicherlist = '';
  $MaxRow = 3;
  $LastRow = 0;
  $vor= 0;
  $zur= 0;

/*
if(isset($_POST["suche"])) {
    if (empty($_POST['Herstellerlist']) == false){$Herstellerlist = $_POST['Herstellerlist'];};
    if (empty($_POST['Programmlist']) == false){$Programmlist = $_POST['Programmlist'];};
    if (empty($_POST['Fitnesslist']) == false){$Fitnesslist = $_POST['Fitnesslist'];};
    if (empty($_POST['FitnessModusList']) == false){$FitnessModusList = $_POST['FitnessModusList'];};
}
*/

if (isset($_POST['Herstellerlist'])){$Herstellerlist = $_POST['Herstellerlist'];};
if (isset($_POST['Programmlist'])){$Programmlist = $_POST['Programmlist'];};
if (isset($_POST['Fitnesslist'])){$Fitnesslist = $_POST['Fitnesslist'];};
if (isset($_POST['FitnessModusList'])){$FitnessModusList = $_POST['FitnessModusList'];};
if (isset($_POST['SensorList'])){$SensorList = $_POST['SensorList'];};
if (isset($_POST['KompatibelList'])){$KompatibelList = $_POST['KompatibelList'];};
if (isset($_POST['UhrengehauseformList'])){$UhrengehauseformList = $_POST['UhrengehauseformList'];};
if (isset($_POST['UhrengehausedickeList'])){$UhrengehausedickeList = $_POST['UhrengehausedickeList'];};
if (isset($_POST['Uhrenmateriallist'])){$Uhrenmateriallist = $_POST['Uhrenmateriallist'];};
if (isset($_POST['Uhrenanzeigelist'])){$Uhrenanzeigelist = $_POST['Uhrenanzeigelist'];};
if (isset($_POST['Sonstigelist'])){$Sonstigelist = $_POST['Sonstigelist'];};
if (isset($_POST['Speicherlist'])){$Speicherlist = $_POST['Speicherlist'];};
if (isset($_POST['LastRow'])){$LastRow = $_POST['LastRow'];}

//var_dump($_POST);


if (isset($_POST['vor'])) {
	$vor = 1;
}

if (isset($_POST['zuruck'])) {
	$zur = 1;
}

if (isset($_POST['vor']) or (isset($_POST['zuruck']))) {
	$Herstellerlist = explode(',', $_POST['vorzurHerstellerlist']);
	$Programmlist = explode(',', $_POST['vorzurProgrammlist']);
	$Fitnesslist = explode(',', $_POST['vorzurFitnesslist']);
	$FitnessModusList= explode(',', $_POST['vorzurFitnessModuslist']);
	$SensorList= explode(',', $_POST['vorzurSensorlist']);
	$KompatibelList= explode(',', $_POST['vorzurKompatibellist']);
	$UhrengehausedickeList= explode(',', $_POST['vorzurUhrengehausedickelist']);
	$Uhrenmateriallist= explode(',', $_POST['vorzurUhrenmateriallist']);
}


if(empty($Herstellerlist)== true) {$Herstellerlist = '';}
if(empty($Programmlist)== true) {$Programmlist = '';}
if(empty($Fitnesslist)== true) {$Fitnesslist = '';}
if(empty($FitnessModusList)== true) {$FitnessModusList = '';}
if(empty($SensorList)== true) {$SensorList = '';}
if(empty($KompatibelList)== true) {$KompatibelList = '';}
if(empty($UhrengehauseformList)== true) {$UhrengehauseformList = '';}
if(empty($UhrengehausedickeList)== true) {$UhrengehausedickeList = '';}
if(empty($Uhrenmateriallist)== true) {$Uhrenmateriallist = '';}
if(empty($Uhrenanzeigelist)== true) {$Uhrenanzeigelist = '';}
if(empty($Sonstigelist)== true) {$Sonstigelist = '';}
if(empty($Speicherlist)== true) {$Speicherlist = '';}

/*
print_r($SensorList);
print_r($Herstellerlist);
echo('Hallo<br>');
echo($_POST);
var_dump($_POST);
*/


function CheckId($Id, $liste)
{
    if (empty($liste)) {return false;}
    foreach ($liste as $Item) {
        if ($Item == $Id) {return true;}
    }
    return false;
}

function ShowCheckbox($Id, $Labelname, $Liste, $Checkboxname)
{
	/*
    if ($Liste == '') {  $Checked = false;} else {$Checked = true;}
    if ($Checked == true) {$Checked = CheckId($Id, $Liste);}
    
    if ($Checked == true) {
        echo('<input type="checkbox" id='.$Id.' name="'.$Checkboxname. '" value="'.$Id.'" checked>');
        echo('<label for="'.$Id.'">'.$Labelname.'</label><br>');
    }
    if ($Checked == false) {
        echo('<input type="checkbox" id='.$Id.' name="'.$Checkboxname. '" value="'.$Id.'" onchange="doalert(this)">');
        echo('<label for="'.$Id.'">'.$Labelname.'</label><br>');
    }
	*/	
    if ($Liste == '') {  $Checked = false;} else {$Checked = true;}
    if ($Checked == true) {$Checked = CheckId($Id, $Liste);}
    
    if ($Checked == true) {
        echo('<input type="checkbox" id='.$Id.' name="'.$Checkboxname. '" value="'.$Id.'" checked>');
        echo('<label for="'.$Id.'">'.$Labelname.'</label><br>');
    }
    if ($Checked == false) {
        echo('<input type="checkbox" id='.$Id.' name="'.$Checkboxname. '" value="'.$Id.'">');
        echo('<label for="'.$Id.'">'.$Labelname.'</label><br>');
    }
}

function ErzeugeScrollbox($EnId, $UebergabeListe, $Checkboxname) {
    echo('<div id="scrollbox">');
    include 'dbsettings.php';
    $con = new mysqli($servername, $user, $pw, $db);
    if ($con->connect_error) {
        die('Verbindung zur Datenbank ist fehlgeschlagen'.$con->connect_error);}
    $sql = 'select distinct EI_ID, EI_MATCH from eigenschaft'.
			     ' join artikeleigenschaft on ae_ei_id = ei_id '. 
			     ' where ei_en_id = '.$EnId.' order by ei_match';
		global $MaxRow;
    $res = $con->query($sql);
	  $datensatz = $res->fetch_all(MYSQLI_ASSOC);
		foreach($datensatz as $zeile) {
			if (empty($UebergabeListe) == true) {ShowCheckbox($zeile["EI_ID"],  utf8_encode($zeile["EI_MATCH"]), '', $Checkboxname);}
			if (empty($UebergabeListe) == false) {ShowCheckbox($zeile["EI_ID"],  utf8_encode($zeile["EI_MATCH"]), $UebergabeListe, $Checkboxname);}
		}
		
		/*
    $res = $con->query($sql);
    while($i = $res->fetch_assoc()) {
        if (empty($UebergabeListe) == true) {ShowCheckbox($i["EI_ID"],  utf8_encode($i["EI_MATCH"]), '', $Checkboxname);}
        if (empty($UebergabeListe) == false) {ShowCheckbox($i["EI_ID"],  utf8_encode($i["EI_MATCH"]), $UebergabeListe, $Checkboxname);}
    }
    $con->close();
		*/
    echo('</div>');
}


//echo('<form class="form" id="myform">');
echo('<form name="smartform" action="" method="post">');
echo('<div id="leftpanel">');


echo('<div id="FilterbuttonOben">');
echo('<input id="Filterbtn" type="submit" name="suche" value="Filtern"/>');
echo('</div>');


echo('<div class="checkbox">');
echo('<p> Hersteller </p>');  
ErzeugeScrollbox(1, $Herstellerlist, 'Herstellerlist[]');
echo('</div>');


echo('<div class="checkbox">');
echo('<p> Programme </p>');  
ErzeugeScrollbox(2, $Programmlist, 'Programmlist[]');
echo('</div>');

echo('<div class="checkbox">');
echo('<p> Fitness </p>');  
ErzeugeScrollbox(8, $Fitnesslist, 'Fitnesslist[]');
echo('</div>');

echo('<div class="checkbox">');
echo('<p> Fitnessmodus </p>');  
ErzeugeScrollbox(9, $FitnessModusList, 'FitnessModusList[]');
echo('</div>');

echo('<div class="checkbox">');
echo('<p> Sensor </p>');  
ErzeugeScrollbox(12, $SensorList, 'SensorList[]');
echo('</div>');

echo('<div class="checkbox1">');
echo('<p> Kompatibel </p>');  
ErzeugeScrollbox(7, $KompatibelList, 'KompatibelList[]');
echo('</div>');

echo('<div class="checkbox">');
echo('<p> Uhrengehäuseform </p>');  
ErzeugeScrollbox(3, $UhrengehauseformList, 'UhrengehauseformList[]');
echo('</div>');


echo('<div class="checkbox">');
echo('<p> Uhrengehäusedicke </p>');  
ErzeugeScrollbox(6, $UhrengehausedickeList, 'UhrengehausedickeList[]');
echo('</div>');

echo('<div class="checkbox">');
echo('<p> Uhrenmaterial </p>');  
ErzeugeScrollbox(5, $Uhrenmateriallist, 'Uhrenmateriallist[]');
echo('</div>');

echo('<div class="checkbox">');
echo('<p> Uhrenanzeige </p>');  
ErzeugeScrollbox(4, $Uhrenanzeigelist, 'Uhrenanzeigelist[]');
echo('</div>');

/*
echo('<div class="checkbox">');
echo('<p> Sonstige </p>');  
ErzeugeScrollbox(10, $Sonstigelist, 'Sonstigelist[]');
echo('</div>');
*/


echo('<div class="checkbox">');
echo('<p> Speicher </p>');  
ErzeugeScrollbox(4, $Speicherlist, 'Speicherlist[]');
echo('</div>');

echo('<div id="Filterbutton">');
echo('<input id="Filterbtn" type="submit" name="suche" value="Filtern"/>');
echo('</div>');

echo('</form>');



/*
if(empty($Herstellerlist)== false) {
	echo('nicht leer');
}
*/

//var_dump($_POST['Programmlist']);
//echo($HerstellerList);
//print_r($Herstellerlist);

/*
if(empty($Herstellerlist)== false) {
      foreach ($Herstellerlist as $Hersteller) {
          echo $Hersteller ."<br>";
      }
*/

echo('</div>');







/*        
<div id="leftpanel">
	<div class="checkbox">
  	<p> Hersteller </p>    
    <div id="scrollbox">
    	<input type="checkbox" id = 1 name="Amazfit" value="1" onchange="doalert(this)">
      <label for="1">Amazfit<br></label>
      <input type="checkbox" id = 2 name="BANAUS" value="2">
      <label for="2">BANAUS<br></label>
      <input type="checkbox" id = 3 name="Garmin" value="3">
      <label for="3">Garmin<br></label>
      <input type="checkbox" id = 4 name="HUAWEI" value="4">
      <label for="4">HUAWEI<br></label>
      <input type="checkbox" id = 5 name="LG Electronics" value="5">
      <label for="5">LG Electronics<br></label>
      <input type="checkbox" id = 6 name="Polar" value="6">
      <label for="6">Polar<br></label>
      <input type="checkbox" id = 7 name="Samsung" value="7">
      <label for="7">Samsung<br></label>
      <input type="checkbox" id = 8 name="Smartwatch" value="8">
      <label for="8">Smartwatch<br></label>
      <input type="checkbox" id = 9 name="Sony" value="9">
      <label for="9">Sony<br></label>
      <input type="checkbox" id = 10 name="Tickwatch" value="10">
      <label for="10">Tickwatch<br></label>
    </div>                        
  </div>
            
  <div class="checkbox">
  	<p> Programme </p>    
    <div id="scrollbox">
			<input type="checkbox" id = 1 name="Anruf" value="1" onchange="doalert(this)">
			<label for="1">Anrufbeantworter<br></label>
			<input type="checkbox" id = 2 name="Bluetooth" value="2">
			<label for="2">Bluetooth<br></label>
			<input type="checkbox" id = 3 name="EMail" value="3">
			<label for="3">EMail<br></label>
			<input type="checkbox" id = 4 name="Erinnerung" value="4">
			<label for="4">Erinnerung<br></label>
			<input type="checkbox" id = 5 name="Facebook" value="5">
			<label for="5">Facebook<br></label>
			<input type="checkbox" id = 6 name="Geschwind" value="6">
			<label for="6">Geschwindigkeitsmesser<br></label>
			<input type="checkbox" id = 7 name="GoogleKarte" value="7">
			<label for="7">Google Karte<br></label>
			<input type="checkbox" id = 8 name="GooglePay" value="8">
			<label for="8">Google Pay<br></label>
			<input type="checkbox" id = 9 name="GooglePayStore" value="9">
			<label for="9">Google Play Store<br></label>
			<input type="checkbox" id = 10 name="Google Assistent" value="10">
			<label for="10">Google Assistent<br></label>
		</div>                        
	</div>
            
</div>
*/				
				
?>
