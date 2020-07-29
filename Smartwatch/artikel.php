<?php
  //include 'artikeleigenschaftlist.php';
  //include 'artikeleigenschaft.php';

  class Artikel {
    public $Match;
    public $FirmenNr;
    public $Id;
    public $Webseite;
    public $ImageUrl;
    public $Artikeleigenschaftlist;
    public function __construct(){
      $this->Match = '';
      $this->FirmenNr = '';
      $this->Id = 0;
      $this->Webseite = '';
      $this->ImageUrl = '';
      $this->Artikeleigenschaftlist = null;
    }

    public function getEigenschaftListe() {
      //if (empty($this->Artikeleigenschaftlist) == false) {return $this->Artikeleigenschaftlist;}
      $this->Artikeleigenschaftlist = new Artikeleigenschaftlist();
      $this->Artikeleigenschaftlist->LeseArtikelEigenschaft($this->Id);
      return $this->Artikeleigenschaftlist;  
    }

  }  

?>