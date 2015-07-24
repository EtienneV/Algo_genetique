<?php
function generation_3individu_10($x, $a){
$tlancement = microtime(true);
while((1) && ((microtime(true) - $tlancement) < 0.05)){
	$x++;
while(($x<$a) && ((microtime(true) - $tlancement) < 0.05)){
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

}

return "retour : ".$x;
}