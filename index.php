<?php
 require('connection.inc.php');
 require('entities.php');

 $entities = new Entities($connection);
 $entities->fillStationByDB();

?>

<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>TUD - SVG</title>

	<script type="text/javascript" src="jquery/jquery.js"></script>
	<script type="text/javascript" src="jquery/jquery_ui.js"></script>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="jquery.growl/javascripts/jquery.growl.js" type="text/javascript"></script>
	<link href="jquery.growl/stylesheets/jquery.growl.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">

		  var $buspoints;
		  var $start_simulation;
		  var $stop_simulation;
		  var $augmentation_selection;
		  var $augmentation_selection_selected;
		  var $animate_motion;
		  var segmentEndColor = '#FD3441';
		  
		  $(function () {
			
			$buspoints = $('.buspoints');  							//tous les points
			$start_simulation = $('.start_simul');					//les deux boutons
			$stop_simulation = $('#stop_simul');	
			$augmentation_selection = $('#augmentation_selection');	//liste choix facteur augmentation
			$animate_motion = $('animateMotion');					//balise anmate motion
		
			$('#next_station_zone_1').hide();
			$('#next_station_zone_2').hide();
			
			//on cache tout les points
			$buspoints.hide();
			//init bouton et liste
			$start_simulation.removeAttr('disabled');
			$augmentation_selection.removeAttr('disabled');
			$augmentation_selection.val("1");
			
			//choix valeur dans la liste
			$augmentation_selection.change(function () {
				var facteur = $('#augmentation_selection option:selected').val();
				$animate_motion.each(function () {
					var duree = ($(this).attr('dur'));
					$(this).attr('dur',duree/facteur);
				});
			});
			
			$stop_simulation.click(function () {
				location.reload();
				
			});
			
			$start_simulation.click(function () {
				//recup id
				var ligneId = $(this).attr('ligneId');
				//recupération du point
				var $point = $('#buspoint_' + ligneId);
				$point.show();
				
				$('#next_station_zone_' + ligneId).show();
				//bouton et liste locked								
				$(this).attr('disabled','disabled');
				$augmentation_selection.attr('disabled','disabled');
				
			});
		  });
		
		  //fin animation segment
		  function segmentEnd (segmentAnimation) {
		    var $point = $('#'+segmentAnimation.getAttribute('point_id'));
			//$point.attr('fill',segmentEndColor);
		    
		    $.growl.startligne({message: "Arrivée arrêt " + segmentAnimation.getAttribute('station_stop')},segmentAnimation.getAttribute('ligne_id'));
		    
		  }
		
		  function segmentStart (segmentAnimation) {
			  var pointId = segmentAnimation.getAttribute('point_id');
			  var $point = $('#'+pointId);
			  var id_ligne = $point.attr('ligne_id');
				
			  $('#next_station_' + id_ligne).html(segmentAnimation.getAttribute('station_stop'));
				
			  var color = $('#a_segment1_'+ id_ligne).attr('point_color');
			  //$point.attr('fill',color);
				
				
			  $.growl.startligne({ message: "Départ direction " + segmentAnimation.getAttribute('station_stop')},segmentAnimation.getAttribute('ligne_id'));
		  }
	</script>
</head>

<body>
      
	  <div style="margin-left:20px;margin-top:30px;">
	  	<div class="page-header">
			<h1>Projet TUD-SVG <small> Simulation réseau de bus</small></h1>
		</div>
		
		<label for="reduction_selection">Facteur d'augmentation de la vitesse</label>
	    <select class="form-control" id="augmentation_selection" style="width:100px;margin-bottom:10px;">
			<option value="1">Aucun</option>
			<option value="20">20x</option>
			<option value="10">10x</option>
			<option value="5">5x</option>
			<option value="2">2x</option>
		</select>
		
		<form class="form-inline" role="form">
			<div class="form-group">
				<button id="start_simul_l1" type="button" class="btn btn-default start_simul" ligneId="1" id="start_simul_l1">Départ ligne 1</button>
			</div>
			<div class="form-group">
				<h4 id="next_station_zone_1">Prochain arrêt: <span id="next_station_1" class="label label-default"></span></h4>
			</div>
		</form>
		
		<form class="form-inline" role="form">
			<div class="form-group">
				<button id="start_simul_l2" type="button" class="btn btn-default start_simul" ligneId="2" id="start_simul_l2">Départ ligne 2</button>
			</div>
			<div class="form-group">
				<h4 id="next_station_zone_2">Prochain arrêt: <span id="next_station_2" class="label label-default"></span></h4>
			</div>
		</form>
		<button type="button" class="btn btn-default" id="stop_simul">Stopper simulation</button>
	  
		<!-- zone svg -->
	 	 <div style="margin-left:20px;margin-top:30px;">
		 	 <svg width="1440" height="777" style="border:1px solid black;">
        
	          <image
	             y="0"
	             x="0"
	             id="image3194"
	             xlink:href="carte_delemont.jpg"
	             height="777"
	             width="1440" />

	          <defs>
	            <image
	                  id="bus_stop"
	                  xlink:href="icon_bus.png"
	                  height="20"
	                  width="20" />
	          </defs>

<?php
	$stations = $entities->getStations();
	foreach($stations as $station){
	  echo '<use id="'.$station->getId().'" y="'.$station->getPosY().'" x="'.$station->getPosX().'" xlink:href="#bus_stop"/>';
	}
?>

		          
          

<?php
	$relationsByLignes = $entities->getRelations();
	
	$dureeArret 		= 3;
	$currentRetaltion   = 1;
	
	//ligne par ligne
	foreach($relationsByLignes as $relationsPourLigne){
		
		$cpt 				= 1;
		//echo '<h1>id:' . $cpt .'</h1>';
		//relations de la ligne
		foreach($relationsPourLigne as $relation){
			
			$begin = "start_simul_l". $relation->getLigne()->getId() .".click";
			if($cpt > 1){
				$begin = 'segment' . ($cpt-1) . '_' .$relation->getLigne()->getId() .'stop.end';
				
			}else if($cpt == 1){
				echo '<g id="ligne' . $relation->getLigne()->getId() .'">
						<text x="-10" y="-10" font-family="Verdana" font-weight="bold" font-size="16" fill="black">' . $relation->getLigne()->getNom() .'</text>
						<circle class="buspoints" ligne_id="' . $relation->getLigne()->getId() .'" id="buspoint_' . $relation->getLigne()->getId() .'" cx="0" cy="0" r="5" fill="' . $relation->getLigne()->getCouleur() .'"></circle>';
			}
			
			echo '<animateMotion id="a_segment'.$cpt. '_' .$relation->getLigne()->getId() . '" onend="segmentEnd(this)" onbegin="segmentStart(this)"
							path="'.$relation->getSvgPath().'" station_start="'. $relation->getStationDepart().'" 
							station_stop="'. $relation->getStationArrivee().'"
							point_color="' . $relation->getLigne()->getCouleur() .'"
							point_id="buspoint_' . $relation->getLigne()->getId() .'"
							ligne_id="'. $relation->getLigne()->getId() .'"
							begin="'.$begin.'"  dur="'.$relation->getDuree().'" repeatCount="1" fill="freeze"/>';
							
			echo '<animateTransform id="segment' .$cpt . '_' .$relation->getLigne()->getId() . 'stop" attributeName="transform"
									type="scale"
									from="1" to="3"
									begin="a_segment'.$cpt. '_' .$relation->getLigne()->getId() . '.end"  dur="1" station="'.$relation->getStationArrivee().'"
									repeatCount="'. $dureeArret .'"/>';
									
			$cpt++;
			
			
		}
		
		echo '</g>';
	}
	
?>

          

        
      </svg>
	  </div>
	
</body>
</html>
