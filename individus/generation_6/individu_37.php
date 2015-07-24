<?php
function generation_6individu_37($x, $a){
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