<?php
function get_classes() {
	global $db;
	$query = 'SELECT * FROM classes ORDER BY classID';
	$statement = $db->prepare($query); $statement->execute();
	$categories = $statement->fetchAll(); $statement->closeCursor(); return $categories;
}
function get_class_name($classID) {
	global $db;
	$query = 'SELECT * FROM classes WHERE classID = :classID'; $statement = $db->prepare($query);
	$statement->bindValue(':classID', $classID); $statement->execute();
	$class = $statement->fetch(); $statement->closeCursor();
	$class_name = $class['className']; return $class_name;
}
function delete_class($classID) {
	global $db;
	$query = 'DELETE FROM classes
	WHERE classID = :classID'; $statement = $db->prepare($query);
	$statement->bindValue(':classID', $classID); $statement->execute(); $statement->closeCursor();
}
function add_class($classID, $className) {
	global $db;
	$query = 'INSERT INTO classes (classID, className) VALUES
	(:classID, :className)'; $statement = $db->prepare($query);
	$statement->bindValue(':classID', $classID); $statement->bindValue(':className', $className); $statement->execute(); $statement->closeCursor();
}?>
