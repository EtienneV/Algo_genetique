<?php
function generation_8individu_22($x, $a){
$tlancement = microtime(true);
$x++;

while(($x<$a) && ((microtime(true) - $tlancement) < 0.05)){
	$x++;
}
while(($x!=$a) && ((microtime(true) - $tlancement) < 0.05)){
	}
if($x!=$a){
	if($x<$a){
	}
}

return "retour : ".$x;
}