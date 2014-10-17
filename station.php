<?php

class Station {

	private $id;
	private $nom;
	private $pos_x;
	private $pos_y;

	function __construct($id, $nom, $pos_x, $pos_y) {
        $this->id = $id;
		$this->nom = $nom;
		$this->pos_x = $pos_x;
		$this->pos_y = $pos_y;
    }
	
	public function getId(){
		return $this->id;
	}
	
	public function getNom(){
		return $this->nom;
	}
	public function getPosX(){
		return $this->pos_x;
	}
	
	public function getPosY(){
		return $this->pos_y;
	}
}
?>