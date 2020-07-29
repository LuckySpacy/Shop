<?php
  include 'eigenschaftname.php';
  include 'artikellist.php';
  $EigenschaftnameList = array();

  function AddEigenschaftList($Name, $Variablename, $Id){
    global $EigenschaftnameList;
    $Eigenschaftname = new Eigenschaftname($Name, $Variablename.'list', 'vorzur'.$Variablename.'list', $Id, $Name);
    array_push($EigenschaftnameList, $Eigenschaftname);
  }
  
  AddEigenschaftList('Hersteller','Hersteller', 1);
  AddEigenschaftList('Funktionen','Funktionen', 2);
  AddEigenschaftList('Ausstattung', 'Ausstattung', 3);
  AddEigenschaftList('Sensoren', 'Sensoren', 4);
  AddEigenschaftList('Konnektivität', 'Konnekt', 5);
  AddEigenschaftList('Gehäuseform', 'Gehauseform', 6);
  AddEigenschaftList('Gehäusematerial', 'Gehausematerial', 7);
  AddEigenschaftList('Armband Material', 'ArmbandMaterial', 8);
  AddEigenschaftList('Armband Typ', 'ArmbandTyp', 9);
  AddEigenschaftList('Betriebssysteme', 'Betriebssysteme', 10);
  AddEigenschaftList('Arbeitsspeicher', 'Arbeitsspeicher', 11);
  AddEigenschaftList('Speicher (Intern)', 'SpeicherIntern', 12);
  AddEigenschaftList('Speicher (Erweiterbar)', 'SpeicherErweiterbar', 13);
  AddEigenschaftList('Display Technologie', 'DisplayTechnologie', 14);
  AddEigenschaftList('Display Farbe', 'DisplayFarbe', 15);
  AddEigenschaftList('Display Größe Zoll', 'DisplayGroßeZoll', 16);
  AddEigenschaftList('Geschlecht', 'Geschlecht', 17);
  AddEigenschaftList('Gesundheit', 'Gesundheit', 18);
  AddEigenschaftList('App', 'App', 19);
  AddEigenschaftList('Anwendungsart', 'Anwendungsart', 20);

  $Artikellist = new Artikellist();

?>