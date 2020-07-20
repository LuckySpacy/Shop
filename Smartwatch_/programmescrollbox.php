
<div id="scrollbox">
<?php

$ProgrammList = '';

if(isset($_POST["suche"])) {
    if (empty($_POST['ProgrammList']) == false){$ProgrammList = $_POST['ProgrammList'];};
}

function CheckId_Programme($Id, $liste)
{
    if (empty($liste)) {return false;}
    foreach ($liste as $Item) {
        if ($Item == $Id) {return true;}
    }
    return false;
}


include "dbsettings.php";
$con = new mysqli($servername, $user, $pw, $db);
if ($con->connect_error) {
    die('Verbindung zur Datenbank ist fehlgeschlagen'.$con->connect_error);
}
    

$sql = 'select * from eigenschaft where ei_en_id = 2 order by ei_match';
$res1 = $con->query($sql);
while($i = $res1->fetch_assoc()) {
    if (empty($ProgrammList) == true) {ShowCheckbox($i["EI_ID"],  utf8_encode($i["EI_MATCH"]), '', 'ProgrammList[]');}
    if (empty($ProgrammList) == false) {ShowCheckbox($i["EI_ID"],  utf8_encode($i["EI_MATCH"]), $ProgrammList, 'ProgrammList[]');}
}
$con->close();


?>
</div>