<?php
// This file is the place to store all basic functions

// absoulute degree calculations
function angle($s, $d, $m) {
	$degree = round(($d + ($m / 60)),1);

	if ($s == "ARI") {	
		$sign = (0);
	} elseif ($s == "TAU") { 
		$sign = (30);
	} elseif ($s == "GEM") {
		$sign = (60);
	} elseif ($s == "CAN") {
		$sign = (90);
	} elseif ($s == "LEO") {
		$sign = (120);
	} elseif ($s == "VIR") {
		$sign = (150);
	} elseif ($s == "LIB") {
		$sign = (180);
	} elseif ($s == "SCO") {
		$sign = (210);
	} elseif ($s == "SAG") {
		$sign = (240);
	} elseif ($s == "CAP") {
		$sign = (270);
	} elseif ($s == "AQU") {
		$sign = (300);
	} elseif ($s == "PIS")  { 
		$sign = (330); 
	} else {
		$sign = (99999); 
	}
	$result = $sign + $degree;
	return $result;
}

// determine node ID (nid) and capture full name
function get_nid($full_name) {
	$table2 = 'node';
	$field2 = 'nid';
	$query = db_select($table2, $field2)
	    ->fields($field2)
		->condition('type', 'natal','=')
		->condition('title', $full_name,'=')
	    ->execute()
	    ->fetchAssoc();
	$nid = $query[$field2];
	return $nid;
}

//determines if there is an aspect present
function ab($a, $b) { 
	$orb = $_POST['orb'];
	$x = abs($a - $b);
	if (((($x) >= 0) && (($x) < $orb) || (($x) > (360-$orb)) && (($x) < (360+$orb)))) {
		$result = "conjunct";
	} elseif (((($x) > (60-$orb)) && (($x) < (60+$orb)) || (($x) > (300-$orb)) && (($x) < (300+$orb)))) {
		$result =  "sextile";
	} elseif (((($x) > (90-$orb)) && (($x) < (90+$orb)) || (($x) > (270-$orb)) && (($x) < (270+$orb)))) {
		$result =  "square";
	} elseif (((($x) > (120-$orb)) && (($x) < (120+$orb)) || (($x) > (240-$orb)) && (($x) < (240+$orb)))) {
		$result =  "trine";
	} elseif ((($x) > (180-$orb)) && (($x) < (180+$orb))) {
		$result =  "opposite";
	} else {
		$result = NULL; 
	} 
	return $result;
}

// TRANSIT: displays data from 'node' and 'field_data_body' tables
function transit($condition1) {
$table1 = 'node';
$field1 = 'nid';
//$condition1 = 'sun_moon_sextile';
$query = db_select($table1, $field1)
    ->fields($field1)
	->condition('title', $condition1,'=')
    ->execute()
    ->fetchAssoc();
$result = $query[$field1];
$entity_id = $result;

$table2 = 'field_data_body';
$field2 = 'body_value';
$condition2 = $entity_id;
$query = db_select($table2, $field2)
    ->fields($field2)
	->condition('entity_id', $condition2,'=')
    ->execute()
    ->fetchAssoc();
$result = $query[$field2];

$table3 = 'field_data_field_description';
$field3 = 'field_description_value';
$condition3 = $entity_id;
$query = db_select($table3, $field3)
    ->fields($field3)
	->condition('entity_id', $condition3,'=')
    ->execute()
    ->fetchAssoc();
$result3 = $query[$field3];
$description = $result3;

echo '<span style="color:rgb(0,102,229);font-size:18px;font-weight:bold">' . $description . '</span><br />' . $result . '<br /><br />';
}

// NATAL DELINEATION: displays data from 'node' and 'field_data_body' tables
function delineation($x) {
$table1 = 'node';
$field1 = 'nid';
$query = db_select($table1, $field1)
    ->fields($field1)
	->condition('title', $x,'=')
    ->execute()
    ->fetchAssoc();
$result = $query[$field1];
$entity_id = $result;
echo '<b>' . $x . '</b><br />';

$table2 = 'field_data_body';
$field2 = 'body_value';
$condition2 = $entity_id;
$query = db_select($table2, $field2)
    ->fields($field2)
	->condition('entity_id', $condition2,'=')
    ->execute()
    ->fetchAssoc();
$result = $query[$field2];
echo $result . '<br />';

$table3 = 'field_data_field_description';
$field3 = 'field_description_value';
$condition3 = $entity_id;
$query = db_select($table3, $field3)
    ->fields($field3)
	->condition('entity_id', $condition3,'=')
    ->execute()
    ->fetchAssoc();
$result3 = $query[$field3];
$description = $result3;
}

// "un-abbreviates" signs
function sign_long($s){
	switch ($s) {
		case 'ARI':
			return 'Aries';
			break;
		case 'TAU':
			return 'Taurus';
			break;
		case "GEM":
			return "Gemini";
			break;
		case "CAN":
			return "Cancer";
			break;
		case "LEO":
			return "Leo";
			break;
		case "VIR":
			return "Virgo";
			break;
		case "LIB":
			return "Libra";
			break;
		case "SCO":
			return "Scorpio";
			break;
		case 'SAG':
			return 'Sagittarius';
			break;
		case "CAP":
			return "Capricorn";
			break;
		case "AQU":
			return "Aquarius";
			break;
		case "PIS":
			return "Pisces"; 
			break;
		default:
			return "?????"; 
			break;
	}
}

// cusp sign fix
function cusp_fix($cf){
	switch ($cf) {
		case 'ARI':
			return 'LIB';
			break;
		case 'TAU':
			return 'SCO';
			break;
		case "GEM":
			return "SAG";
			break;
		case "CAN":
			return "CAP";
			break;
		case "LEO":
			return "AQU";
			break;
		case "VIR":
			return "PIS";
			break;
		case "LIB":
			return "ARI";
			break;
		case "SCO":
			return "TAU";
			break;
		case 'SAG':
			return 'GEM';
			break;
		case "CAP":
			return "CAN";
			break;
		case "AQU":
			return "LEO";
			break;
		case "PIS":
			return "VIR"; 
			break;
		default:
			echo "?????"; 
			break;
	}
}


?>