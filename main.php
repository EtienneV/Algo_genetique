<?php
set_time_limit (0);

// Constantes
$depart = 0;
$arrivee = 10;

$taille_adn = 10;

$taille_generation = 40;
$nb_generations = 10;
$nb_parents = 20;

// tournoi, elitisme
$selection_des_parents='tournoi';

$taux_crossover = 90;

$proba_mutation = 100;

// Définition des instructions possibles
$instructions = array('L', 'M', 'O', 'P', 'Q', 'U', 'S', 'T', '}', 'A', 'R', '_');

// Fonctions
function parse_adn($adn)
{
	$timeout = 0.05;

	$in=array(
	           "L", 
	           "M", 
	           "N", 
	           "O", 
	           "P", 
	           "Q", 
	           "U", 
	           "S", 
	           "T", 
	           "}", 
	           "A",
	           "R",
	           "_"
	           );

	$path = 'images/smiley/';
	
	$out=array(
	           'while((1) && ((microtime(true) - $tlancement) < '.$timeout.')){'."\n\t",
	           'if($x<$a){'."\n\t",
	           'if($x>$a){'."\n\t",
	           'if($x==$a){'."\n\t",
	           'if($x!=$a){'."\n\t",
	           'while(($x<$a) && ((microtime(true) - $tlancement) < '.$timeout.')){'."\n\t",
	           'while(($x>$a) && ((microtime(true) - $tlancement) < '.$timeout.')){'."\n\t",
	           'while(($x==$a) && ((microtime(true) - $tlancement) < '.$timeout.')){'."\n\t",
	           'while(($x!=$a) && ((microtime(true) - $tlancement) < '.$timeout.')){'."\n\t",
	           '}'."\n",
	           '$x++;'."\n",
	           '$x--;'."\n",
	           "\n"
	           );

    return str_replace($in,$out,$adn);
}

function generation_individu()
{
	global $taille_adn;
	global $instructions;

	// Création d'un ADN
	$adn = '';
	for ($j=0; $j < $taille_adn; $j++) { 
		$adn .= $instructions[array_rand($instructions)];
	}

	return $adn;
}

function interpreteur_adn($adn, $individu, $generation)
{
	$adn = verifier_adn($adn); // On corrige l'adn

	// On transforme l'adn en code
	$code = parse_adn($adn);

	$header_fonction = '<?php'."\n".'function generation_'.$generation.'individu_'.$individu.'($x, $a){'."\n".'$tlancement = microtime(true);'."\n";
	$footer_fonction = 'return "retour : ".$x;'."\n}";

	$nom_fichier = 'individus/generation_'.$generation.'/individu_'.$individu.'.php';

	$fichier = fopen($nom_fichier, 'r+');
	ftruncate($fichier,0); // On vide le fichier
	fputs($fichier, $header_fonction);
	fputs($fichier, $code);
	fputs($fichier, $footer_fonction);

	fclose($fichier);
}

function position_arrivee($numero, $generation) {
	global $depart;
	global $arrivee;

	// Test de l'individu
	$individu_teste = 'individu_'.$numero;
	$fct_testee = 'generation_'.$generation.'individu_'.$numero;
	include_once('individus/generation_'.$generation.'/'.$individu_teste.'.php');
	$retour = $fct_testee($depart, $arrivee);

	$position_darrivee = str_replace('retour : ', '', $retour);

	if($retour[0] = 'r') return $position_darrivee;
	else return 'erreur_code';
}

function calcul_distance($position)
{
	global $arrivee;

	return abs($arrivee - $position);
}

function verifier_adn($adn)
{
	$accolades = 0;
	$adn_corrige = '';

	for ($i=0; $i < strlen($adn); $i++) { 
		$allele = $adn[$i];

		switch ($allele) {
			case 'L':
			case 'M':
			case 'N':
			case 'O':
			case 'P':
			case 'Q':
			case 'U':
			case 'S':
			case 'T':
				$accolades++; // Ces allèles correspondent à des accolades ouvrantes
				$adn_corrige .= $allele;
				break;

			case '}':
				if($accolades > 0) // Si des accolades ont été ouvertes
				{
					$accolades--; // on ferme une accolade
					$adn_corrige .= $allele;
				}
				break;
			
			default:
				$adn_corrige .= $allele;
				break;
		}

		
	}

	for ($i=0; $i < $accolades; $i++) { 
		$adn_corrige .= "}\n"; // On ferme toutes les accolades ouvertes
	}

	return $adn_corrige;
}

function affichage_dune_generation($generation, $depart, $arrivee)
{
	echo '<table style="border-collapse: collapse"><tr><th style="border: 1px solid black; padding: 5px;">Individu</th><th style="border: 1px solid black; padding: 5px;">ADN</th><th style="border: 1px solid black; padding: 5px;">Distance</th></tr>';
	foreach ($generation as $key => $individu) {
		echo '<tr>';
		echo '<td style="border: 1px solid black; padding: 5px;">'.$key.'</td><td style="border: 1px solid black; padding: 5px;">';
		echo $individu['adn'];
		echo '</td>';
		echo '<td style="border: 1px solid black; padding: 5px;">'.$individu['distance'].'</td></tr>';
	}
	echo '</table><br>';
}

function selection_tournoi($generation)
{
	global $taille_generation;
	global $nb_parents;

	for ($i=0; $i < $nb_parents; $i++) { 
		$a = rand(0, $taille_generation-1);
		$b = rand(0, $taille_generation-1);
		if($generation[$a]['distance'] < $generation[$b]['distance'])
		{
			$parents[$i] = $generation[$a];
		}
		else
		{
			$parents[$i] = $generation[$b];
		}
	}

	return $parents;
}

function classement_individus($generation, $taille_generation)
{
	// Création d'un tableau des distances 
	for ($i=0; $i < $taille_generation; $i++) { 
		$tab_distances[$i] = $generation[$i]['distance'];
	}

	// Tri par score décroissant
	asort($tab_distances);

	echo '<b>Classement</b><br>';
	foreach ($tab_distances as $key => $value) {
		echo $key.' - '.$value.'<br>';
		$tab_classes[] = $key;
	}

	return $tab_classes;
}

function selection_parents($tab_classes, $generation)
{
	global $nb_parents;

	// Sélection des parents pour la génération 2
	for ($i=0; $i < $nb_parents; $i++) { // On prend les 4 premiers
		$parents[$i] = $generation[$tab_classes[$i]];
	}

	echo '<br><b>ADN des parents</b><br>';
	foreach ($parents as $key => $value) {
		echo $value['adn'];
		echo '<br>';
	}

	echo '<br>';

	return $parents;
}

/**
Programme
**/

// Explications
echo '<b>Signification de l\'ADN : </b><br>';
echo 'L - while(1){<br>';
echo "M - if(x < a){<br>";
echo "N - if(x > a){<br>";
echo 'O - if(x==a)}<br>';
echo 'P - if(x!=a)}<br>';
echo 'Q - while(x < a)}<br>';
echo 'U - while(x > a)}<br>';
echo 'S - while(x==a)}<br>';
echo 'T - while(x!=a)}<br>';
echo '} - }<br>';
echo 'A - x++;<br>';
echo 'R - x--;<br>';
echo '_ - NOP<br>';
echo '<br><br>';


// Définition des instructions possibles
$instructions = array('L', 'M', 'O', 'P', 'Q', 'U', 'S', 'T', '}', 'A', 'R', '_');

echo '<br><br>';

// Création de la première génération d'individus
$individus = array();

for ($i=0; $i < $taille_generation; $i++) { 
	//echo 'individu '.$i.' : ';

	// Création d'un ADN
	$adn = generation_individu();

	//echo '<br>'.$adn;

	$individus[0][$i]['adn'] = $adn;
	interpreteur_adn($adn, $i, 0);
	$individus[0][$i]['position_finale'] = position_arrivee($i, 0);

	//echo '<br>position : '.$individus[0][$i]['position_finale'].'<br>';

	$individus[0][$i]['distance'] = calcul_distance($individus[0][$i]['position_finale']);

	//echo 'distance : '.$individus[0][$i]['distance'];
	//echo '<br><br>';
}

// Affichage de la génération
echo '<br><b>Generation 0</b><br>';
affichage_dune_generation($individus[0], $depart, $arrivee);

/**
Pas sur au delà
**/



// On simule plusieurs générations
for ($g=0; $g < $nb_generations; $g++) { 
	// Tournoi
	$parents = selection_tournoi($individus[$g]);

	// Elitisme
	//$tab_classes = classement_individus($individus[$g], $taille_generation);
	//$parents = selection_parents($tab_classes, $individus[$g]);

	echo '<br><b>Reproduction : </b>'.$nb_parents.' parents choisis par tournoi<br>';
	echo '<table style="border-collapse: collapse"><tr>';

	for ($j=0; $j < $taille_generation; $j++) {
		// Crossover
		$crossover = rand(0, $taille_adn-1); // Où la coupure se passera
		$pere = $parents[rand(0, $nb_parents-1)]['adn'];
		$mere = $parents[rand(0, $nb_parents-1)]['adn'];

		$adn_fils = '';

		for ($i=0; $i < $taille_adn; $i++) { 
			if($i < $crossover) // On prend du père
			{
				$adn_fils .= $pere[$i];
			}
			else
			{
				$adn_fils .= $mere[$i];
			}
		}

		// Mutations
		$mut = rand(0, $proba_mutation);
		$place_mutation = $taille_adn + 10;

		if (($mut == 0) && ($proba_mutation != 0)) { // 1% de chance de mutation
			$place_mutation = rand(0, $taille_adn-1);
			$adn_fils[$place_mutation] = $instructions[array_rand($instructions)];
			//echo 'MUTATION : '.$place_mutation.'<br>';
		}

		$individus[$g+1][$j]['adn'] = $adn_fils;
		interpreteur_adn($adn_fils, $j, $g+1);
		$individus[$g+1][$j]['position_finale'] = position_arrivee($j, $g+1);

		//echo 'Pos '.$j.' : '.$individus[$g+1][$j]['position_finale'].'<br>';
		$individus[$g+1][$j]['distance'] = calcul_distance($individus[$g+1][$j]['position_finale']);

		// Affichage du processus
		echo '<td style="border: 1px solid black; padding: 5px;">';
		
		echo '<span style="color:green">';
		for($i=0; $i < $taille_adn; $i++) {
			if($i == $crossover) echo '</span>';
			echo $pere[$i];
		}
		echo '<br>';
		for($i=0; $i < $taille_adn; $i++) {
			if($i == $crossover) echo '<span style="color:green">';
			echo $mere[$i];
		}
		echo '</span><br> _______ ';
		for($i=0; $i < $taille_adn; $i++) {
			if($i == $crossover) echo '';
			if($i == $place_mutation) echo '<span style="color:red"><u>';
			echo $adn_fils[$i];
			if($i == $place_mutation) echo '</u></span>';
		}
		echo '<br><br>';

		echo '</td>';
	}

	echo '</tr></table>';

	echo '<br><hr>';

	// Affichage de la génération 
	echo '<br><b>Generation '.($g+1).'</b><br>';
	affichage_dune_generation($individus[$g+1], $depart, $arrivee);
}

// Affichage du dernier algo
echo '<b>ADN Choisi : '.$individus[$nb_generations][$taille_generation-1]['adn'].'</b><br>';

$fichier = fopen('individus/generation_'.($nb_generations).'/individu_'.($taille_generation-1).'.php', 'r+');

while (($buffer = fgets($fichier, 4096)) !== false) {
    echo $buffer.'<br>';
}

fclose($fichier);