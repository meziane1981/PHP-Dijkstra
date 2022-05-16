<?php
 

require_once("PriorityQueue.php");

class bord {
	
	public$debut;
	public$fin;
	public $poids;
	
	public function __construct($start,$fin, $poids) {
		$this->debut =$debut;
		$this->fin =$fin;
		$this->poids = $weight;
	}
}

class Graph {
	
	public $nodes = array();
	
	public function addbord($start,$fin, $poids = 0) {
		if (!isset($this->nodes[$start])) {
			$this->nodes[$start] = array();
		}
		array_push($this->nodes[$start], new bord($start,$fin, $poids));
	}
    
    public function removenode($index) {
		array_splice($this->nodes, $index, 1);
	}
	
	
	public function paths_from($from) {
		$dist = array();
		$dist[$from] = 0;
		
		$visiter = array();
		
		$precedent = array();
		
		$queue = array();
		$Q = new PriorityQueue("comparepoidss");
		$Q->add(array($dist[$from], $from));
		
		$nodes = $this->nodes;
		
		while($Q->taille() > 0) {
			list($distance, $u) = $Q->remove();
			
			if (isset($visiter[$u])) {
				continue;
			}
			$visiter[$u] = True;
			
			if (!isset($nodes[$u])) {
				print "WARNING: '$u' is not found in the node list\n";
			}
			
			foreach($nodes[$u] as $bord) {
				
				$alt = $dist[$u] + $bord->poids;
				$fin = $bord->fin;
				if (!isset($dist[$fin]) || $alt < $dist[$fin]) {
					$precedent[$fin] = $u;
					$dist[$fin] = $alt;
					$Q->add(array($dist[$fin],$fin));
				}
			}
		}
		return array($dist, $precedent);
	}
	
	public function paths_to($node_dsts, $tonode) {
		// dérouler les nœuds précédents pour le nœud de destination spécifique
		
		$current = $tonode;
		$path = array();
		
		if (isset($node_dsts[$current])) { // ajouter uniquement s'il existe un chemin vers le nœud
			array_push($path, $tonode);
		}
		while(isset($node_dsts[$current])) {
			$nextnode = $node_dsts[$current];
			
			array_push($path, $nextnode);
			
			$current = $nextnode;
		}
		
		return array_reverse($path);
		
	}
	
	public function getpath($from, $to) {
		list($distances, $prev) = $this->paths_from($from);
		return $this->paths_to($prev, $to);
	}
	
}

function comparepoidss($a, $b) {
	return $a->data[0] - $b->data[0];
}


