<?php
require('station.php');
require('relation.php');
require('ligne.php');

class Entities{

	private $stations = array();
	
	private $connection = null; 
	private $relationsByLignes = array();
	
	
	function __construct($connection) {
        $this->connection = $connection;
    }
	
	public function addStation ($station) {
		$this->stations[] = $station;
	}
	
	public function fillStationByDB () {
		$select = $this->connection->query("SELECT st.stat_nom as station_depart_nom, 
											st.stat_id as station_depart_id,
											st.stat_svg_x as pos_x,
											st.stat_svg_y as pos_y,
											st2.stat_nom as station_arrivee_nom, 
											st2.stat_id as station_arrivee_id,
											rel.rela_duree as duree,
											rel.rela_svg_path as path,
											ligne.lign_nom as nom,
											ligne.lign_id as ligne_id,
											ligne.lign_color_code as couleur_ligne
											FROM tud.station st 
											inner join tud.relation rel on (st.stat_id = rel.station_depart_id)
											inner join tud.station st2 on (rel.station_arrivee_id1 = st2.stat_id)
											inner join tud.ligne ligne on (ligne.lign_id = rel.ligne_lign_id)
											order by ligne.lign_id,rel.rela_ordre;");
											
		$select->setFetchMode(PDO::FETCH_OBJ);
		
		$currentLigne = 0;
		$relations = array();
		
		while( $obj = $select->fetch() ){
		
			if($currentLigne == 0){
				$currentLigne = $obj->ligne_id;
			}
			
			//différent, nouvelle ligne parce que ordré par ligne
			//print($currentLigne .':');
			//print($obj->ligne_id."<br />");
			//print('diff: '. (bool)($currentLigne != ($obj->ligne_id))."<br />");
			
			if($currentLigne != $obj->ligne_id){
				$this->relationsByLignes[$currentLigne] = $relations;
				$relations = array();
				$currentLigne = $obj->ligne_id;
			}
			$ligne = new Ligne($obj->ligne_id,$obj->nom,$obj->couleur_ligne);
			//print("<pre>");
			//var_dump($ligne);
			//print("</pre>");
			$relations[] = new Relation($obj->path, $obj->duree,$obj->station_depart_nom,$obj->station_arrivee_nom,$ligne);
			$this->stations[$obj->station_depart_id] = new Station($obj->station_depart_id,$obj->station_depart_nom,$obj->pos_x,$obj->pos_y);
		}
		$this->relationsByLignes[$currentLigne] = $relations;
		//print("<pre>");
		//print_r($this->relationsByLignes);
		//print("</pre>");
	}
	
	public function getStations () {
		return $this->stations;
	}
	
	public function getRelationsForLigne ($ligne_id) {
		return $this->relationsByLignes[$ligne_id];
	}
	
	public function getRelations () {
		return $this->relationsByLignes;
	}
	
}
?>