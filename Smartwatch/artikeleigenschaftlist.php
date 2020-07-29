<?php
    include 'artikeleigenschaft.php';
    
    class Artikeleigenschaftlist {
    public $Liste;
    public function __construct(){
      $this->Liste = array();
    }

    function EigenschaftInListe($EiId){
      foreach($this->Liste as $Eigenschaft) {
        if ($EiId == $Eigenschaft->EiId) {return true;}
      }
      return false;
    }

    public function LeseArtikelEigenschaft($ArId){
      if (empty($this->Liste) == false){
        return;
      }
      include 'dbsettings.php';
      $con = new mysqli($servername, $user, $pw, $db);
      if ($con->connect_error) {
        die('Verbindung zur Datenbank ist fehlgeschlagen'.$con->connect_error);}
      
      $sql = 'select * from artikeleigenschaft where ae_ar_id = '.$ArId.' order by ae_en_id, ae_ei_id';
      $res = $con->query($sql);
      $this->Liste = array();
      if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          $Artikeleigenschaft = new Artikeleigenschaft();
          $Artikeleigenschaft->Id = $row["AE_ID"];
          $Artikeleigenschaft->EnId = $row["AE_EN_ID"];
          $Artikeleigenschaft->EiId = $row["AE_EI_ID"];
          array_push($this->Liste, $Artikeleigenschaft);
        }
      }
    }

    public function AddToListe($Id, $EnId, $EiId){
      if ($this->EigenschaftInListe($EiId) == true) {return;}
      $Artikeleigenschaft = new Artikeleigenschaft();
      $Artikeleigenschaft->Id = $Id;
      $Artikeleigenschaft->EnId = $EnId;
      $Artikeleigenschaft->EiId = $EiId;
      array_push($this->Liste, $Artikeleigenschaft);
    }

    public function getInListe($EnId) {
      $res = '';
      foreach($this->Liste as $Artikeleigenschaft){
        if ($EnId != $Artikeleigenschaft->EnId) {continue;}
        if ($res == '') {
          $res = $Artikeleigenschaft->EiId;
        }
        else {
          $res = $res.', '.$Artikeleigenschaft->EiId;
        }
      }
      if ($res > '') {
        $res = '('.$res.')';
      }
      return $res;
    }

  }  
  
?>