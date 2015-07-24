<?php
function generation_3individu_12($x, $a){
$tlancement = microtime(true);
$x++;

$x--;
while(($x==$a) && ((microtime(true) - $tlancement) < 0.05)){
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