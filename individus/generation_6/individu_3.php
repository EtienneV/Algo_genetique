<?php
function generation_6individu_3($x, $a){
$tlancement = microtime(true);
$x++;

if($x<$a){
	$x++;
}
if($x!=$a){
	while(($x>$a) && ((microtime(true) - $tlancement) < 0.05)){
	if($x!=$a){
	if($x<$a){
	}
}

}

}

return "retour : ".$x;
}