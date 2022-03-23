<?php
function get_makes() {
	global $db;
	$query = 'SELECT * FROM makes ORDER BY makeID';
	$statement = $db->prepare($query); $statement->execute();
	$makes = $statement->fetchAll(); $statement->closeCursor(); return $makes;
}
function get_make_name($makeID) {
	global $db;
	$query = 'SELECT * FROM makes WHERE makeID = :makeID'; $statement = $db->prepare($query);
	$statement->bindValue(':makeID', $makeID); $statement->execute();
	$make = $statement->fetch(); $statement->closeCursor();
	$make_name = $make['makeName']; return $make_name;
}
function delete_make($makeID) {
	global $db;
	$query = 'DELETE FROM makes
	WHERE makeID = :makeID'; $statement = $db->prepare($query);
	$statement->bindValue(':makeID', $makeID); $statement->execute(); $statement->closeCursor();
}
function add_make($makeID, $makeName) {
	global $db;
	$query = 'INSERT INTO makes (makeID, makeName) VALUES
	(:makeID, :makeName)'; $statement = $db->prepare($query);
	$statement->bindValue(':makeID', $makeID); $statement->bindValue(':makeName', $makeName); $statement->execute(); $statement->closeCursor();
}?>
