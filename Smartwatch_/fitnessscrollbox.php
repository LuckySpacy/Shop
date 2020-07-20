
<div id="scrollbox">
<?php

$FitnessList = '';

if(isset($_POST["suche"])) {
    if (empty($_POST['FitnessList']) == false){$FitnessList = $_POST['FitnessList'];};
}



include "dbsettings.php";
$con = new mysqli($servername, $user, $pw, $db);
if ($con->connect_error) {
    die('Verbindung zur Datenbank ist fehlgeschlagen'.$con->connect_error);
}
    

$sql = 'select * from eigenschaft where ei_en_id = 8 order by ei_match';
$res1 = $con->query($sql);
while($i = $res1->fetch_assoc()) {
    if (empty($FitnessList) == true) {ShowCheckbox($i["EI_ID"], utf8_encode($i["EI_MATCH"]), '', 'FitnessList[]');}
    if (empty($FitnessList) == false) {ShowCheckbox($i["EI_ID"], utf8_encode($i["EI_MATCH"]), $FitnessList, 'FitnessList[]');}
}
$con->close();


?>
</div>