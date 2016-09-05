<?php
function getArtikelName($idx){
	$title = "";
	if ($idx == 2) {
		$title = "Artikel";
	}elseif ($idx == 3){
		$title = "Referensi";
	}elseif ($idx == 4){
		$title = "Wisata Pulau";
	}elseif ($idx == 5){
		$title = "Serba-Serbi Pulau";
	}elseif ($idx == 6){
		$title = "PPKT";
	}elseif ($idx == 8){
		$title = "Produk";
	}
	
	return $title;
}

function getArtikelType($idx){
	$type = "";
	if($idx == 2){
		$type = "A";
	}elseif ($idx == 3){
		$type = "R";
	}elseif ($idx == 4){
		$type = "J";
	}elseif ($idx == 5){
		$type = "S";
	}elseif ($idx == 6){
		$type = "P";
	}elseif ($idx == 8){
		$type = "D";
	}
	
	return $type;
}