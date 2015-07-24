<?php
function generation_7individu_17($x, $a){
$tlancement = microtime(true);
$x++;

if($x<$a){
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