<?php
function get_vehicles_by_make($makeID, $orderBy = 4) {
	global $db;
	$query = 'SELECT * FROM vehicles
	WHERE vehicles.vehicleMake = :makeID ORDER BY :orderBy DESC';
	$statement = $db->prepare($query);
	$statement->bindValue(':makeID', $makeID); $statement->bindValue(':orderBy', $orderBy, PDO::PARAM_INT); $statement->execute();
	$vehicles = $statement->fetchAll(); $statement->closeCursor(); return $vehicles;
}
function get_vehicles_by_type($typeID, $orderBy = 4) {
	global $db;
	$query = 'SELECT * FROM vehicles
	WHERE vehicles.vehicleType = :typeID ORDER BY :orderBy DESC';
	$statement = $db->prepare($query);
	$statement->bindValue(':typeID', $typeID); $statement->bindValue(':orderBy', $orderBy, PDO::PARAM_INT); $statement->execute();
	$vehicles = $statement->fetchAll(); $statement->closeCursor(); return $vehicles;
}
function get_vehicles_by_class($classID, $orderBy = 4) {
	global $db;
	$query = 'SELECT * FROM vehicles
	WHERE vehicles.vehicleClass = :classID ORDER BY :orderBy DESC';
	$statement = $db->prepare($query);
	$statement->bindValue(':classID', $classID); $statement->bindValue(':orderBy', $orderBy, PDO::PARAM_INT); $statement->execute();
	$vehicles = $statement->fetchAll(); $statement->closeCursor(); return $vehicles;
}
function get_vehicle($vehicleID) {
	global $db;
	$query = 'SELECT * FROM vehicles WHERE vehicleID = :vehicleID'; $statement = $db->prepare($query);
	$statement->bindValue(':vehicleID', $vehicleID); $statement->execute(); $vehicle = $statement->fetch(); $statement->closeCursor(); return $vehicle;
}
function get_all_vehicles($orderBy = 4) {
	global $db;
	$fetchQuery = 'SELECT * FROM vehicles ORDER BY :orderBy DESC';
	$statement = $db->prepare($fetchQuery);
	$statement->bindValue(':orderBy', $orderBy, PDO::PARAM_INT); $statement->execute();
	return $statement->fetchAll();
}
function delete_vehicle($vehicleID) {
	global $db;
	$query = 'DELETE FROM vehicles
	WHERE vehicleID = :vehicleID'; $statement = $db->prepare($query);
	$statement->bindValue(':vehicleID', $vehicleID); $statement->execute(); $statement->closeCursor();
}
function add_vehicle($vehicleID, $vehicleModel, $vehicleYear, $vehiclePrice, $vehicleMake, $vehicleType, $vehicleClass) {
	global $db;
	$query = 'INSERT INTO vehicles (vehicleID, vehicleModel, vehicleYear, vehiclePrice, vehicleMake, vehicleType, vehicleClass) VALUES
	(:vehicleID, :vehicleModel, :vehicleYear, :vehiclePrice, :vehicleMake, :vehicleType, :vehicleClass)'; $statement = $db->prepare($query);
	$statement->bindValue(':vehicleID', $vehicleID); $statement->bindValue(':vehicleModel', $vehicleModel); $statement->bindValue(':vehicleYear', $vehicleYear); $statement->bindValue(':vehiclePrice', $vehiclePrice); $statement->bindValue(':vehicleMake', $vehicleMake); $statement->bindValue(':vehicleType', $vehicleType); $statement->bindValue(':vehicleClass', $vehicleClass); $statement->execute(); $statement->closeCursor();
} ?>
