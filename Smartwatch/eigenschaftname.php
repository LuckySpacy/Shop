<?php
  class Eigenschaftname {
    public $CheckedListe;
    public $Name;
    public $Checkboxname;
    public $Blaettername;
    public $Listenname;
    public $Labelname;
    public $Id;
    private $ArtikelEigenschaftList = array();
    public function __construct($Name, $Listenname, $Blaettername, $Id, $Labelname){
      $this->ArtikelEigenschaftList = '';
      $this->CheckedListe = '';
      $this->Name = $Name;
      $this->Listenname = $Listenname;
      $this->Checkboxname = $Listenname.'[]';
      $this->Blaettername = $Blaettername;
      $this->Labelname = $Labelname;
      $this->Id = $Id;
    }
    public function FuelleListeFromPost() {
      if (isset($_POST[$this->Listenname])){
        $this->CheckedListe = $_POST[$this->Listenname];
      }

      if (isset($_POST['vor']) or (isset($_POST['zuruck']))) {
        $this->CheckedListe = explode(',', $_POST[$this->Blaettername]);
      }  
      if(empty($this->CheckedListe)== true) {$this->CheckedListe = '';}
    }  

    public function ErzeugeHiddenFeld(){
      $StrListe = '';
      if(empty($this->CheckedListe)== false) {
        $StrListe = implode(",", $this->CheckedListe);
      }
      
      echo('<input type= "hidden" name="'.$this->Blaettername.'" value="'.$StrListe.'">');
      
    }

    function CheckId($Id, $liste)
    {
        if (empty($liste)) {return false;}
        foreach ($liste as $Item) {
            if ($Item == $Id) {return true;}
        }
        return false;
    }


    function ShowCheckbox($Id, $Labelname, $Liste){
        if ($Liste == '') {  $Checked = false;} else {$Checked = true;}
        if ($Checked == true) {$Checked = $this->CheckId($Id, $Liste);}
        
        if ($Checked == true) {
            $s = '<input type="checkbox" onclick="CheckboxKlickEvent(this)"'.' name="'.$this->Checkboxname.'"'.'value="'.$Id.'"'.
                 'checked >'; 
            echo($s);
            echo('<label for="'.$Id.'">'.$Labelname.'</label><br>');
        }
        if ($Checked == false) {
            $s = '<input type="checkbox" onclick="CheckboxKlickEvent(this)"'.' name="'.$this->Checkboxname.'"'.'value="'.$Id.'"'.
                 '>'; 
            echo($s);
            echo('<label for="'.$Id.'">'.$Labelname.'</label><br>');
        }
    }


    function LadeArtikelEigenschaftList($ArtikeleigenschaftGeladeneArtikelList){
      $InListe = $ArtikeleigenschaftGeladeneArtikelList->getInListe($this->Id);

      include 'dbsettings.php';
      $con = new mysqli($servername, $user, $pw, $db);
      if ($con->connect_error) {
        die('Verbindung zur Datenbank ist fehlgeschlagen'.$con->connect_error);}
      $sql = 'select distinct EI_ID, EI_MATCH from eigenschaft'.
             ' join artikeleigenschaft on ae_ei_id = ei_id '. 
             ' where ei_sa_id = 1'.
             ' and ei_id in '.$InListe.
             ' order by ei_match';
            // ' and ei_en_id = '.$this->Id.' order by ei_match';

      $res = $con->query($sql);
      if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          //print_r($row);
          $this->ArtikelEigenschaftList[] = $row;
        }
      }
      $con->close();

    }

    function ErzeugeScrollbox(){
      echo('<div id="scrollbox">');
      foreach($this->ArtikelEigenschaftList as $zeile) {
        if (empty($this->CheckedListe) == true) {$this->ShowCheckbox($zeile["EI_ID"],  utf8_encode($zeile["EI_MATCH"]), '', $this->Checkboxname);}
        if (empty($this->CheckedListe) == false) {$this->ShowCheckbox($zeile["EI_ID"],  utf8_encode($zeile["EI_MATCH"]), $this->CheckedListe, $this->Checkboxname);}
      }
      echo('</div>');
  }

  public function ErzeugeCheckboxen($ArtikeleigenschaftGeladeneArtikelList){
    if ($ArtikeleigenschaftGeladeneArtikelList->getInListe($this->Id) == '') {return;}
    $this->LadeArtikelEigenschaftList($ArtikeleigenschaftGeladeneArtikelList);
    if (empty($this->ArtikelEigenschaftList) == true) {return;}
    echo('<div class="checkbox">');
    echo('<p>'.$this->Labelname.'</p>');  
    $this->ErzeugeScrollbox();
    echo('</div>');
  }

  }
?>