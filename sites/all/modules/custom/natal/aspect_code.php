<?php
global $user;
$title = drupal_get_title();  // e.g., "mercury_saturn_square"
$components = explode('_',$title);
$planet_0 = ucfirst($components[0]);
$planet_1 = ucfirst($components[1]);
$angle = $components[2];

$field = "natal_" . $title . "_value";  // e.g.,: "natal_mercury_saturn_square_value"
$table = "field_data_natal_" . $title ;  // e.g., "field_data_natal_mercury_saturn_square"

echo "<b>Other people with this aspect include:</b><br /><br />";

$result = db_query("SELECT entity_id, $field FROM {$table}")->fetchAll(PDO::FETCH_ASSOC);

// select all the entries in the table that are not NULL, i.e., a major aspect exists
foreach ($result as $record) {
	if($record[$field] != NULL) {
		$result2 = db_query("SELECT nid, title, type FROM {node}")->fetchAll(PDO::FETCH_ASSOC);		
		foreach ($result2 as $record2) {
			if(($record2['type'] == 'natal') && ($record2['nid'] == $record['entity_id'])) {
				$full = explode('_',$record2['title']);
				$first = ucfirst($full[1]);
				$last = ucfirst($full[0]);
				$nid = $record2['nid'];
				
				$t3 = explode("_", $table);
				$table3 = "field_data_natal_" . $t3[3]. "_house";  // e.g., "field_data_natal_mercury_house"
				$column3 = "natal_" . $t3[3]. "_house_value";  // e.g., "natal_mercury_house_value" 
				$result3 = db_query("SELECT $column3 FROM {$table3} WHERE entity_id = $nid")->fetchField();

				// code for permission to view "Other people with this aspect include:"
				// Get a single value out of the database (Public or Private).
				$pub_pri = db_query("SELECT natal_pub_pri_value FROM {field_data_natal_pub_pri} WHERE entity_id = $nid")->fetchField();

				if ($user->uid == 0) { // When uid=0, then the user is "anonymous" ==> only view public records
					if ($pub_pri == "Public") {
//						echo $nid . "<br />";
						echo "<a href=\"../natal/" . $record2['title'] . "\"";
						echo "<span class=\"fullname\" ; >"  . $first . " " . $last . ":</span></a>";
						echo " " . $planet_0 . " " . $angle . " ". $planet_1 . " angle: " . $record[$field] . "&deg;<br /><br />";
					}
				} else { // When (uid != 0), then the user has logged in ==> can view both private and public records
					if (($pub_pri == "Private") || ($pub_pri == "Public")) {
//						echo $nid . "<br />";
						echo "<a href=\"../natal/" . $record2['title'] . "\"";
						echo "<span class=\"fullname\" ; >"  . $first . " " . $last . ":</span></a>";
						echo " " . $planet_0 . " in " . $result3 . " " . $angle . " ". $planet_1 . " angle: " . $record[$field] . "&deg;<br /><br />";
					}
				}
				
			}
		}
	}
}

// echo "planet1 = " . $planet_0 . "<br />";  // e.g., "Mercury"
// echo "planet2 = " . $planet_1 . "<br />";  // e.g., "Saturn"
// echo "aspect = " . $angle . "<br />";  // e.g., "square"

?>