<div id="scrollbox">
<?php

$Herstellerlist = '';
$ProgrammList = '';


if(isset($_POST["suche"])) {
    if (empty($_POST['Herstellerlist']) == false){$Herstellerlist = $_POST['Herstellerlist'];};
}


//var_dump($Herstellerlist);

$sql = 'select * from eigenschaft where ei_en_id = 1 order by ei_match';
$res = $con->query($sql);
while($i = $res->fetch_assoc()) {
    if (empty($Herstellerlist) == true) {ShowCheckbox($i["EI_ID"],  utf8_encode($i["EI_MATCH"]), '', 'Herstellerlist[]');}
    if (empty($Herstellerlist) == false) {ShowCheckbox($i["EI_ID"],  utf8_encode($i["EI_MATCH"]), $Herstellerlist, 'Herstellerlist[]');}
}
$con->close();

?>
</div>
