<?php
  include 'artikel.php';
  include 'artikeleigenschaftlist.php';

  class Artikellist {
    public $Liste = array();
    public $ArtikelEigenschaftList;
    public $AnzahlDatensaetze;
    public function __construct(){
      $this->ArtikelEigenschaftList = new Artikeleigenschaftlist();
      $this->AnzahlDatensaetze = 0;
      //$ArtikelEigenschaftList = null;
      //$this->Liste = empty;
    }


    function InListe($UebergabeList) {
      $ret = '';
      if (empty($UebergabeList) == true) {
        return $ret;
      }
      $Anzahl = count($UebergabeList);
      $z = '0';
      while ($z < $Anzahl) {
          if ($ret != '')  {$ret = $ret.','.$UebergabeList[$z];}
          if ($ret == '') {$ret = $UebergabeList[$z];}
          $z++;
      }
      if ($ret != '') {$ret = '('.$ret.')';}
          
      return $ret;
    }

    function AddInListe($UebergabeList) {
      $ret = '';
      if (empty($UebergabeList) == true) {
        return $ret;
      }
      $Anzahl = count($UebergabeList);
      $z = '0';
      while ($z < $Anzahl) {
          if ($ret != '')  {$ret = $ret.','.$UebergabeList[$z];}
          if ($ret == '') {$ret = $UebergabeList[$z];}
          $z++;
      }
      return $ret;
    }


    function SqlJoin($sql, $Liste, $Id) {
      if(empty($Liste)== true) {
        return $sql;
      }
      $Check = implode(",", $Liste);
      if($Check == '') {
        //echo('Leer <br>');
        return $sql;
      }
      
      //echo('InListe');
      $InList =$this->InListe($Liste);
      //echo($InList .'<br>');
      
      $sql = $sql.' join artikeleigenschaft t'.$Id.' on'.
                  ' t'.$Id.'.ae_ar_id = ar_id and t'.$Id.'.ae_en_id = '.$Id.' and t'.$Id.'.ae_ei_id in '.$InList;	
      return $sql;
    }  

    public function LeseArtikel($EigenschaftnameList){
      $InListe2 = '';
      foreach($EigenschaftnameList as $EigenschaftListe) {
        if ($InListe2 == '') {
          $InListe2 = $this->AddInListe($EigenschaftListe->CheckedListe);
        }
        else {
          $ret = $this->AddInListe($EigenschaftListe->CheckedListe);
          if ($ret > '') {$InListe2 = $InListe2.','.$ret;}
        }
      }
      $AnzahlInListe = 0;
      if ($InListe2 > '') {
        $InListeArray = explode(',', $InListe2);
        $AnzahlInListe = count($InListeArray);
        $InListe2 = '('.$InListe2.')';
      }
      $sql = 'select distinct AR_ID, AR_MATCH, FA_NR, FA_WEBSEITE, FA_IMAGEURL from artikel'.
              ' join firmaartikel on fa_ar_id = ar_id and fa_fi_id = 1';
      if ($AnzahlInListe > 0) {
        $sql = $sql.' where ar_id in (select ae_ar_id from artikeleigenschaft where ae_ei_id in '.
                $InListe2.' group by ae_ar_id having count(*) >='.$AnzahlInListe.')'; 
      }
      //echo('Sql2='.$sql2.'<br>');
      //echo('AnzahlInListe='.$AnzahlInListe.'<br>');

      include 'dbsettings.php';
      $con = new mysqli($servername, $user, $pw, $db);
      if ($con->connect_error) {
        die('Verbindung zur Datenbank ist fehlgeschlagen'.$con->connect_error);}
      
      //echo($sql);
      $res = $con->query($sql);
      $datas = array();
      if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          $datas[] = $row;
          $Artikel = new Artikel();
          $Artikel->Match = utf8_encode($row["AR_MATCH"]);
          $Artikel->FirmenNr = $row["FA_NR"];
          $Artikel->Webseite = $row["FA_WEBSEITE"];
          $Artikel->ImageUrl = $row["FA_IMAGEURL"];
          $Artikel->Id = $row["AR_ID"];
          array_push($this->Liste, $Artikel);
          $ArtikelEigenschaftList = $Artikel->getEigenschaftListe();
         
          if (empty($ArtikelEigenschaftList) == true) {continue;}
          foreach($ArtikelEigenschaftList->Liste as $Artikeleigenschaft) {
            $this->ArtikelEigenschaftList->AddToListe($Artikeleigenschaft->Id, $Artikeleigenschaft->EnId, $Artikeleigenschaft->EiId);
          } 
          
        }
        $this->AnzahlDatensaetze = count($this->Liste);         
      }
    } 
  }  
?>