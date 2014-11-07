<?php
echo "12345";
/*	for ($i=0; $i<22; $i++) {
		delineation($planet_sign_house[$i]);
		if ($i % 2 != 0) {
			echo "<br />";
		}
	}

// Add information about CSSTO aspects
	$angle = array($sunB,$moonB,$mercuryB,$venusB,$marsB,$jupiterB,$saturnB,$uranusB,$neptuneB,$plutoB,$nnodeB,$cusp01B);
	$planet = array("Sun","Moon","Mercury","Venus","Mars","Jupiter","Saturn","Uranus","Neptune","Pluto","Nnode","ASC","MC");
	$conjuncts = array();
	$sextiles = array();
	$squares = array();
	$trines = array();
	$opposites = array();

		for ($i=0; $i<12; $i++) {
			$planet1 = $planet[$i];
			$angle1 = $angle[$i];
			for ($j=$i; $j<11; $j++) {
				$angle2 = $angle[$j+1];
				$planet2 = $planet[$j+1];
				$conj = planet1_planet2_conjunct($angle1, $angle2, $planet1, $planet2);
				array_push($conjuncts,$conj);
				$sext = planet1_planet2_sextile($angle1, $angle2, $planet1, $planet2);
				array_push($sextiles,$sext);
				$squa = planet1_planet2_square($angle1, $angle2, $planet1, $planet2);
				array_push($squares,$squa);
				$trin = planet1_planet2_trine($angle1, $angle2, $planet1, $planet2);
				array_push($trines,$trin);
				$oppo = planet1_planet2_opposite($angle1, $angle2, $planet1, $planet2);
				array_push($opposites,$oppo);
		}
}
		echo "<b>CONJUNCT ASPECTS</b><br />";
		foreach ($conjuncts as $conjunct) {
			$db_table_name = "field_data_natal_" . $conjunct[0];
			$db_table_value = "natal_" . $conjunct[0] . "_value";
			db_merge($db_table_name)
				->key(array('entity_id' => $nid))
			    ->fields(array(
					'entity_type' => 'node',
					'bundle' => 'natal',
					'entity_id' => $nid,
					$db_table_value => $conjunct[1],
					'delta' => 0,
				))
		    ->execute();
			if ($conjunct[1] != "") {
				if ($conjunct[1] <= 2.0) {
					echo "<span style=\"color:blue\"; >";
					$aspect = $conjunct[0] . " &#177; " . $conjunct[1] ;
					echo "<a href=aspect/" . $conjunct[0] . "> " . $conjunct[0] . " </a>&#177;" . $conjunct[1] . " degrees<br />";
					echo "</span>";
				} else {
					echo "<a href=aspect/" . $conjunct[0] . "> " . $conjunct[0] . " </a>&#177;" . $conjunct[1] . " degrees<br />";
				}
			}
		}

		echo "<br /><b>SEXTILE ASPECTS</b><br />";
		foreach ($sextiles as $sextile) {
			$db_table_name = "field_data_natal_" . $sextile[0];
			$db_table_value = "natal_" . $sextile[0] . "_value";
			db_merge($db_table_name)
				->key(array('entity_id' => $nid))
			    ->fields(array(
					'entity_type' => 'node',
					'bundle' => 'natal',
					'entity_id' => $nid,
					$db_table_value => $sextile[1],
					'delta' => 0,
				))
		    ->execute();
			if ($sextile[1] != "") {
				if ($sextile[1] <= 2.0) {
					echo "<span style=\"color:purple\"; >";
					$aspect = $sextile[0] . " &#177; " . $sextile[1] ;
					echo "<a href=aspect/" . $sextile[0] . "> " . $sextile[0] . " </a>&#177;" . $sextile[1] . " degrees<br />";
					echo "</span>";
				} else {
					echo "<a href=aspect/" . $sextile[0] . "> " . $sextile[0] . " </a>&#177;" . $sextile[1] . " degrees<br />";
				}
			}
		}

		echo "<br /><b>SQUARE ASPECTS</b><br />";
		foreach ($squares as $square) {
			$db_table_name = "field_data_natal_" . $square[0];
			$db_table_value = "natal_" . $square[0] . "_value";
			db_merge($db_table_name)
				->key(array('entity_id' => $nid))
			    ->fields(array(
					'entity_type' => 'node',
					'bundle' => 'natal',
					'entity_id' => $nid,
					$db_table_value => $square[1],
					'delta' => 0,
				))
		    ->execute();
			if ($square[1] != "") {
				if ($square[1] <= 2.0) {
					echo "<span style=\"color:red\"; >";
					$aspect = $square[0] . " &#177; " . $square[1] ;
					echo "<a href=aspect/" . $square[0] . "> " . $square[0] . " </a>&#177;" . $square[1] . " degrees<br />";
					echo "</span>";
				} else {
					echo "<a href=aspect/" . $square[0] . "> " . $square[0] . " </a>&#177;" . $square[1] . " degrees<br />";
				}
			}
		}

		echo "<br /><b>TRINE ASPECTS</b><br />";
		foreach ($trines as $trine) {
			$db_table_name = "field_data_natal_" . $trine[0];
			$db_table_value = "natal_" . $trine[0] . "_value";
			db_merge($db_table_name)
				->key(array('entity_id' => $nid))
			    ->fields(array(
					'entity_type' => 'node',
					'bundle' => 'natal',
					'entity_id' => $nid,
					$db_table_value => $trine[1],
					'delta' => 0,
				))
		    ->execute();
			if ($trine[1] != "") {
				if ($trine[1] <= 2.0) {
					echo "<span style=\"color:blue\"; >";
					$aspect = $trine[0] . " &#177; " . $trine[1] ;
					echo "<a href=aspect/" . $trine[0] . "> " . $trine[0] . " </a>&#177;" . $trine[1] . " degrees<br />";
					echo "</span>";
				} else {
					echo "<a href=aspect/" . $trine[0] . "> " . $trine[0] . " </a>&#177;" . $trine[1] . " degrees<br />";
				}
			}
		}

		echo "<br /><b>OPPOSITE ASPECTS</b><br />";
		foreach ($opposites as $opposite) {	
			$db_table_name = "field_data_natal_" . $opposite[0];
			$db_table_value = "natal_" . $opposite[0] . "_value";
			db_merge($db_table_name)
				->key(array('entity_id' => $nid))
			    ->fields(array(
					'entity_type' => 'node',
					'bundle' => 'natal',
					'entity_id' => $nid,
					$db_table_value => $opposite[1],
					'delta' => 0,
				))
		    ->execute();
			if ($opposite[1] != "") {
				if ($opposite[1] <= 2.0) {
					echo "<span style=\"color:red\"; >";
					$aspect = $opposite[0] . " &#177; " . $opposite[1] ;
					echo "<a href=aspect/" . $opposite[0] . "> " . $opposite[0] . " </a>&#177;" . $opposite[1] . " degrees<br />";
					echo "</span>";
				} else {
					echo "<a href=aspect/" . $opposite[0] . "> " . $opposite[0] . " </a>&#177;" . $opposite[1] . " degrees<br />";

				}
			}
		*/
?>
