<?php
function generation_8individu_30($x, $a){
$tlancement = microtime(true);
$x++;

while(($x<$a) && ((microtime(true) - $tlancement) < 0.05)){
	$x++;
}
if($x!=$a){
	while(($x>$a) && ((microtime(true) - $tlancement) < 0.05)){
	if($x!=$a){
	if($x==$a){
	while(($x!=$a) && ((microtime(true) - $tlancement) < 0.05)){
	}

}

}

}

}

return "retour : ".$x;
}