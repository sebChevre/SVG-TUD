<?php

class Relation {

	private $duree;
	private $svgpath;
	private $stationDepart;
	private $stationArrivee;
	private $ligne;
	
	
	
	function __construct($svgpath,$duree,$stationDepart,$stationArrivee,$ligne) {
        $this->svgpath = $svgpath;
		$this->duree = $duree;
		$this->stationArrivee = $stationArrivee;
		$this->stationDepart = $stationDepart;
		$this->ligne = $ligne;
		
    }
	
	public function getLigne(){
		return $this->ligne;
	}
	
	
	public function getDuree () {
		return $this->duree;
	}
	
	public function getSvgPath(){
		return $this->svgpath;
	}
	
	public function getStationDepart(){
		return $this->stationDepart;
	}
	
	public function getStationArrivee(){
		return $this->stationArrivee;
	}
}

?>