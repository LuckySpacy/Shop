<?php
  include 'artikel.php';
  include 'artikeleigenschaftlist.php';

  class Artikellist {
    public $Liste = array();
    public $ArtikelEigenschaftList;
    public function __construct(){
      $this->ArtikelEigenschaftList = new Artikeleigenschaftlist();
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
      $sql = 'select distinct AR_ID, AR_MATCH, FA_NR, FA_WEBSEITE, FA_IMAGEURL from artikel'
      .' join firmaartikel on fa_ar_id = ar_id and fa_fi_id = 1';

      foreach($EigenschaftnameList as $EigenschaftListe) {
        $sql = $this->SqlJoin($sql, $EigenschaftListe->CheckedListe, $EigenschaftListe->Id);
      }

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
      }
    } 
  }  
?>