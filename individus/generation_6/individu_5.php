<?php
function generation_6individu_5($x, $a){
$tlancement = microtime(true);
$x++;

while(($x<$a) && ((microtime(true) - $tlancement) < 0.05)){
	$x++;
}

while(($x>$a) && ((microtime(true) - $tlancement) < 0.05)){
	if($x<$a){
	$x--;
if($x!=$a){
	}

}

}

return "retour : ".$x;
}