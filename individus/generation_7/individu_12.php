<?php
function generation_7individu_12($x, $a){
$tlancement = microtime(true);


while(($x<$a) && ((microtime(true) - $tlancement) < 0.05)){
	$x++;
}
if($x!=$a){
	while(($x>$a) && ((microtime(true) - $tlancement) < 0.05)){
	if($x<$a){
	while(($x<$a) && ((microtime(true) - $tlancement) < 0.05)){
	if($x==$a){
	}

}

}

}

}

return "retour : ".$x;
}