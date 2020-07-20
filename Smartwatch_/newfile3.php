<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Smartwatch</title>
<link href="http://localhost/Shop/Smartwatch/style3.css" rel="stylesheet" type="text/css">
<link href="http://localhost/Shop/Smartwatch/style4.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
$servername = '';
$user = '';
$pw = '';
$db = '';
$Herstellerlist = '';
$ProgrammList = '';
$FitnessList = '';
$FitnessModusList = '';
include 'dbsettings.php';

$con = new mysqli($servername, $user, $pw, $db);
if ($con->connect_error) {
    die('Verbindung zur Datenbank ist fehlgeschlagen'.$con->connect_error);
}

if(isset($_POST["suche"])) {
    if (empty($_POST['Herstellerlist']) == false){$Herstellerlist = $_POST['Herstellerlist'];};
    if (empty($_POST['ProgrammList']) == false){$ProgrammList = $_POST['ProgrammList'];};
    if (empty($_POST['FitnessList']) == false){$FitnessList = $_POST['FitnessList'];};
    if (empty($_POST['FitnessModusList']) == false){$FitnessModusList = $_POST['FitnessModusList'];};
}

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
    //GLOBAL $con;
    include 'dbsettings.php';
    $con = new mysqli($servername, $user, $pw, $db);
    if ($con->connect_error) {
        die('Verbindung zur Datenbank ist fehlgeschlagen'.$con->connect_error);}
    $sql = 'select * from eigenschaft where ei_en_id = '.$EnId.' order by ei_match';
    $res = $con->query($sql);
    while($i = $res->fetch_assoc()) {
        if (empty($UebergabeListe) == true) {ShowCheckbox($i["EI_ID"],  utf8_encode($i["EI_MATCH"]), '', $Checkboxname);}
        if (empty($UebergabeListe) == false) {ShowCheckbox($i["EI_ID"],  utf8_encode($i["EI_MATCH"]), $UebergabeListe, $Checkboxname);}
    }
    $con->close();
    echo('</div>');
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

?>


<div id="navigation">
  <div class="wrapper">
  	<p id="menu">
    	<a href="#">Home</a>
    	<a href="#">Über uns</a>
    	<a href="http://smartwatchfilter.com/?page_id=16">Kontakt</a>
    	<a href="#">Impressum</a>
  	</p>
  </div>
</div>

<div id ="banner">
</div>

<form action="" method="post">
  <div id = "leftbox">
    <p id="hersteller">Hersteller</p>
    <?php ErzeugeScrollbox(1, $Herstellerlist, 'Herstellerlist[]');  //include 'herstellerscrollbox.php'; ?>
    <p id="programme">Programme</p>
    <?php ErzeugeScrollbox(2, $ProgrammList, 'ProgrammList[]'); //include 'programmescrollbox.php'; ?>
    <p id="fitness">Fitness</p>
    <?php ErzeugeScrollbox(8, $FitnessList, 'FitnessList[]');//include 'fitnessscrollbox.php'; ?>
    <p id="fitnessmodus">Fitnessmodus</p>
    <?php ErzeugeScrollbox(9, $FitnessModusList, 'FitnessModusList[]');//include 'fitnessscrollbox.php'; ?>
    <input type="submit" name="suche" value="Absenden"/>
  </div>
</form>  

<div id = "centerbox">

<?php
 // print_r($Herstellerlist);
  //$z = InListe($Herstellerlist);
  //echo($z."<br>");    
  //echo($Herstellerlist[0]);
/*
      echo('<div id = "datenzeile">');
     // echo('Hallo');
      echo('<div id = "datenzeilebild">');
      echo('Bild');
        echo('<div id = "datenzeiletext">');
        echo('Text');
        echo('</div>');
        echo('</div>');
      echo('</div>');
      */

  $sql = 'select * from artikel'
         .' join firmaartikel on fa_ar_id = ar_id and fa_fi_id = 1';
         
  $InList = InListe($Herstellerlist);
  if ($InList != '') {
      $sql = $sql.' join artikeleigenschaft on ae_ar_id = ar_id and ae_en_id = 1 and ae_ei_id in '.$InList;    
  }
  
  
  //echo($sql);
  $res = $con->query($sql);
  while($i = $res->fetch_assoc()) {
      echo('<div id = "datenzeile">');
        echo('<div id = "datenzeilebild">');
          echo ('<img src="'.utf8_encode($i["FA_IMAGEURL"]).'" height="200">');
          echo('</div>');
          echo('<div id = "datenzeiletext">');
          echo(utf8_encode($i["AR_MATCH"])."<br>");
          echo('</div>');
          echo('</div>');
      //echo('<br>');
      //break;
  }
  
    
/*
if(empty($Herstellerlist)== false) {
      foreach ($Herstellerlist as $Hersteller) {
          echo $Hersteller ."<br>";
      }
}
*/  
      
?>


</div>


</body>
</html>


