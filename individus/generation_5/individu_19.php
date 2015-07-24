<?php
function generation_5individu_19($x, $a){
$tlancement = microtime(true);
$x++;

if($x<$a){
	$x++;
}
if($x!=$a){
	while(($x>$a) && ((microtime(true) - $tlancement) < 0.05)){
	if($x<$a){
	$x--;
if($x!=$a){
	}

}

}

}

return "retour : ".$x;
}