<?php
function generation_3individu_25($x, $a){
$tlancement = microtime(true);


while(($x==$a) && ((microtime(true) - $tlancement) < 0.05)){
	while(($x!=$a) && ((microtime(true) - $tlancement) < 0.05)){
	while(($x<$a) && ((microtime(true) - $tlancement) < 0.05)){
	}
while(($x>$a) && ((microtime(true) - $tlancement) < 0.05)){
	if($x<$a){
	$x--;
}
}

}

}

return "retour : ".$x;
}