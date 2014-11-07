<?php
$title = drupal_get_title();  // e.g., "mercury_saturn_square"
$components = explode('_',$title);
$planet_0 = ucfirst($components[0]);
$planet_1 = ucfirst($components[1]);
$angle = $components[2];

echo "planet1 = " . $planet_0 . "<br />";  // e.g., "Mercury"
echo "planet2 = " . $planet_1 . "<br />";  // e.g., "Saturn"
echo "aspect = " . $angle . "<br />";  // e.g., "square"

$field = "natal_" . $title . "_value";  // e.g.,: "natal_mercury_saturn_square_value"
$table = "field_data_natal_" . $title ;  // e.g., "field_data_natal_mercury_saturn_square"

echo "<b>Other people with this aspect include:</b><br /><br />";

$result = db_query("SELECT entity_id, $field FROM {$table}")->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $record) {
	if($record[$field] != NULL) {
		$result2 = db_query("SELECT nid, title, type FROM {node}")->fetchAll(PDO::FETCH_ASSOC);
		foreach ($result2 as $record2) {
			if(($record2['type'] == 'natal') && ($record2['nid'] == $record['entity_id'])) {
				$full = explode('_',$record2['title']);
				$first = ucfirst($full[1]);
				$last = ucfirst($full[0]);
				echo "<a href=\"../natal/" . $record2['title'] . "\"";
				echo "<span class=\"fullname\" ; >"  . $first . " " . $last . ":</span></a>";
				echo " " . $planet_0 . " " . $angle . " ". $planet_1 . " angle: " . $record[$field] . "&deg;<br /><br />";
			}
		}
	}
}
?>