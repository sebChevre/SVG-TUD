<?php

class Ligne{
	
	private $id;
	private $nom;
	private $couleur;
	
	function __construct($id,$nom,$couleur) {
        $this->id = $id;
		$this->nom = $nom;
		$this->couleur = $couleur;
    }
    
    public function __toString(){
	    return 'ok';
    }
    
    public function getId(){
	    return $this->id;
    }
    
    public function getNom(){
	    return $this->nom;
    }
    
    public function getCouleur(){
	    return $this->couleur;
    }
}
?>