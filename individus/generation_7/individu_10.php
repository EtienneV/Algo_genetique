<?php
function generation_7individu_10($x, $a){
$tlancement = microtime(true);
$x++;

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