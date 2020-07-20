<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Smartwatch</title>
<link href="style3.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php

include 'dbsettings.php';
$con = new mysqli($servername, $user, $pw, $db);
if ($con->connect_error) {
    die('Verbindung zur Datenbank ist fehlgeschlagen'.$con->connect_error);
}

function meine_funktion1() {
    // Deine PHP-Funktion, z. B.:
    echo 'Hallo Welt22!';
}
  function meine_funktion() {
      // Deine PHP-Funktion, z. B.:
      echo 'Hallo Welt!'; 
  }

  if(isset($_POST["suche"])) {
      $Herstellerlist = $_POST['Herstellerlist'];
  }

  if(isset($_POST["Apple"])) {
      
      meine_funktion();
  }

  
  function CheckId($Id, $liste)
  {
      if (empty($liste)) {return false;}
      foreach ($liste as $Item) {
        if ($Item == $Id) {return true;}
    }
    return false;    
  }
  

?>


<div id="navigation">
  <div class="wrapper">
  	<p id="menu">
    	<a href="#">Home</a>
    	<a href="#">Über uns</a>
    	<a href="#">Kontakt</a>
    	<a href="#">Impressum</a>
  	</p>
  </div>
</div>


<div id ="banner">
</div>

<!--<form action="newfile2.php" method="post">-->
<form action="" method="post">
<div id = "leftbox">
  <!-- <a href="" onclick="runMyFunction()">Hersteller</a><br>*/ -->
  <p id="hersteller">Hersteller</p>
  <div id="scrollbox">
  	<input type="checkbox" id="Sony" name='Herstellerlist[]' value="Sony" checked>  
  	<label for="Sony">Sony</label><br>
  	<input type="checkbox" id="Apple3" name='Herstellerlist[]' value="Apple">  
  	<label for="Apple">Apple</label><br>
  	<input type="checkbox" id="Huawei" name='Herstellerlist[]' value="Huawei">  
  	<label for="Huawei">Huawei</label><br>
  	<input type="checkbox" id="Samsung" name='Herstellerlist[]' value="Samsung">  
  	<label for="Samsung">Samsung</label><br>
  </div>
  
  <a href="">Fitness</a><br>
  <a href="">Programme</a><br>
  <!--
  <div id = "buttonbox">
    <form action="" method="post">
      <input type="submit" name="suche" value="Absenden"/>
    </form>  
  </div>
  -->
  
 <input type="submit" name="suche" value="Absenden"/>
</div>
</form>  



<div id = "centerbox">
<p>
Hersteller <br> 
Fitness <br> 
<?php
if(empty($Herstellerlist)) {}
  else
  {
      foreach ($Herstellerlist as $Hersteller) {
          echo $Hersteller ."<br>";
      }
  }
  
  if (empty($Herstellerlist)==false) {
    if (CheckId("Sony", $Herstellerlist)) {echo "gefunden.";} else {echo "nicht gefunden";}
  }
  
      
      
?>

</p>
</div>




</body>
</html>