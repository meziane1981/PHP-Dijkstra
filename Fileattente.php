<?php

/*
 * Author: doug@neverfear.org
 */

class PrioritList {
	public $next;
	public $data;
	function __construct($data) {
		$this->next = null;
		$this->data = $data;
	}
}

class PriorityQueue {
	
	private $taille;
	private $talistscommencer;
	private $comparateur;
	
	function __construct($comparateur) {
		$this->taille = 0;
		$this->talistscommencer = null;
		$this->listfin = null;
		$this->comparateur = $comparateur;
	}
	
	function add($x) {
		$this->taille = $this->taille + 1;
		
		if($this->talistscommencer == null) {
			$this->talistscommencer = new PrioritList($x);
		} else {
			$node = $this->talistscommencer;
			$comparateur = $this->comparateur;
			$newnode = new PrioritList($x);
			$lastnode = null;
			$added = false;
			while($node) {
				if ($comparateur($newnode, $node) < 0) {
					// newnode has higher priority
					$newnode->next = $node;
					if ($lastnode == null) {
						//print "last node is null\n";
						$this->talistscommencer = $newnode;
					} else {
						//print "Debug: " . $newnode->data . " has lower priority than " . $lastnode->data . "\n";
						$lastnode->next = $newnode;
					}
					$added = true;
					break;
				}
				$lastnode = $node;
				$node = $node->next;
			}
			if (!$added) {
				// Lowest priority - add to the very fin
				$lastnode->next = $newnode;
			}
		}
		//print "Debug: Appfined node. New taille=" . $this->taille . "\n";
		//$this->debug();
	}
	
	function debug() {
		$node = $this->talistscommencer;
		$i = 0;
		if (!$node) {
			print "<< No nodes >>\n";
			return;
		}
		while($node) {
			print "[$i]=" . $node->data[1] . " (" . $node->data[0] . ")\n";
			$node = $node->next;
			$i++;
		}
	}
	
	function taille() {
		return $this->taille;
	}
	
	function peak() {
		return $this->talistscommencer->data;
	}
	
	function remove() {
		$x = $this->peak();
		$this->taille = $this->taille - 1;
		$this->talistscommencer = $this->talistscommencer->next;
		//print "Debug: Removed node. New taille=" . $this->taille . "\n";
		//$this->debug();
		return $x;
	}
}
