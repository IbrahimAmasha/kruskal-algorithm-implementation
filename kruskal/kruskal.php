<?php 
 
class graph {

	public $number_of_vertices;
	public $number_of_edges;
	public $edges = [];

}

 class edge  {
	public $source;
	public $dest;
	public $weight;
 }

 class subset {
	public $parent;
	public $rank;

 }

function mygraph ($number_of_edges,$number_of_vertices) {


	$graph1 = new graph(); // making the graph
	$graph1->number_of_edges = $number_of_edges;
	$graph1->number_of_vertices = $number_of_vertices;
	$graph1->$edges = [];

	for ($i=0; $i < $graph1->number_of_edges; $i++) { 
		$graph1->$edges[$i] = new edge(); //filling edges array 
	}
	return $graph1;
}

function find($subs,$k) {
	if($subs[$k]->parent != $k) 
	{
		$subs[$k]->parent = find($subs,$subs[$k]->parent);
	}

	return $subs[$k]->parent;
}

function union($subs,$x,$y ) {
	$xparent = find($subs,$x);
	$yparent = find($subs,$y);

	if ($subs[$xparent]->rank <$subs[$yparent]->rank  ) {
		$subs[$xparent]->parent = $yparent;
	} else if ($subs[$yparent]->rank > $subs[$xparent]->rank  ) {
		$subs[$yparent]->parent = $xparent;
	}
	else {
		$subs[$yparent]->parent = $xparent;
		++$subs[$xparent]->rank;
	}
}

function compare($first,$second){
	return $first->weight > $second->weight;
}




function print_result($result,$e)
{
	for ($i=0; $i< $e ; ++$i) {  ////////////////////////////
	 echo $result[$i]->source . "------" . $result[$i]->dest . "=" .$result[$i]->weight;
}
}


function kruskal_algorithm($graph){
	$number_of_vertices = $number_of_vertices; /////////////
	$result = [];
	$i = $e = 0;

	usort($graph->edges,"compare");

	$subsets = [];

	for ($i=0; $i <$number_of_vertices ; $i++) { 
		 $subsets[$i] = new subset();
		 $subsets[$i]->parent =$i ;
		 $subsets[$i]->rank = 0;
	}

	while ($e < $number_of_vertices -1) {
		$nextEdge = $graph->edges[$i++];
		$x = find($subsets,$nextEdge->source);
		$y= find($subsets,$nextEdge->dest);


		if ($x != $y) 
		{
			$result[$e++] = $nextEdge;
			union($subsets,$x,$y); 
		}

	}
	print_result($result,$e);
}