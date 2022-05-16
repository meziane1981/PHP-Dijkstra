<?php

/*
 * Author: doug@neverfear.org
 */

require("Dijkstra.php");

function runTest() {
	$g = new Graph();
	$g->addbord("a", "b", 4);
	$g->addbord("a", "d", 1);

	$g->addbord("b", "a", 74);
	$g->addbord("b", "c", 2);
	$g->addbord("b", "e", 12);

	$g->addbord("c", "b", 12);
	$g->addbord("c", "j", 12);
	$g->addbord("c", "f", 74);

	$g->addbord("d", "g", 22);
	$g->addbord("d", "e", 32);

	$g->addbord("e", "h", 33);
	$g->addbord("e", "d", 66);
	$g->addbord("e", "f", 76);

	$g->addbord("f", "j", 21);
	$g->addbord("f", "i", 11);

	$g->addbord("g", "c", 12);
	$g->addbord("g", "h", 10);

	$g->addbord("h", "g", 2);
	$g->addbord("h", "i", 72);

	$g->addbord("i", "j", 7);
	$g->addbord("i", "f", 31);
	$g->addbord("i", "h", 18);

	$g->addbord("j", "f", 8);


	list($distances, $prev) = $g->paths_from("a");
	
	$path = $g->paths_to($prev, "i");
	
	print_r($path);
	
}


runTest();

