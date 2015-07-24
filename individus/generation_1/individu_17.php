<?php
function generation_1individu_17($x, $a){
$tlancement = microtime(true);
while(($x!=$a) && ((microtime(true) - $tlancement) < 0.05)){
	if($x<$a){
	
$x--;
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