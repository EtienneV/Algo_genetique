<?php
function generation_9individu_14($x, $a){
$tlancement = microtime(true);


while(($x<$a) && ((microtime(true) - $tlancement) < 0.05)){
	$x++;
}
if($x!=$a){
	while(($x>$a) && ((microtime(true) - $tlancement) < 0.05)){
	if($x<$a){
	$x--;
}
}

}

return "retour : ".$x;
}