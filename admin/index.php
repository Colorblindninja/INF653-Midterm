<?php
require('../model/database.php');
require('../model/vehicle_db.php');
require('../model/make_db.php');
require('../model/type_db.php');
require('../model/class_db.php');
include '../view/admin_header.php';

//setup footer logic
$vehiclePageFooter = '<button type="switch" name="view" value="classes">View/Edit Vehicle Classes</button>
    <button type="switch" name="view" value="makes">View/Edit Vehicle Makes</button>
    <button type="switch" name="view" value="types">View/Edit Vehicle Types</button>';
$classPageFooter = '<button type="switch" name="view" value="vehicles">View/Edit Vehicle list</button>
	<button type="switch" name="view" value="makes">View/Edit Vehicle Makes</button>
	<button type="switch" name="view" value="types">View/Edit Vehicle Types</button>';
$makePageFooter = '<button type="switch" name="view" value="vehicles">View/Edit Vehicle list</button>
	<button type="switch" name="view" value="classes">View/Edit Vehicle Classes</button>
	<button type="switch" name="view" value="types">View/Edit Vehicle Types</button>';
$typePageFooter = '<button type="switch" name="view" value="vehicles">View/Edit Vehicle list</button>
	<button type="switch" name="view" value="classes">View/Edit Vehicle Classes</button>
	<button type="switch" name="view" value="makes">View/Edit Vehicle Makes</button>';
$PageFooter = '';
 //Delete logic, deleteType will be populated with what type of data we are going to delete, then handle for vehicle/class/make/type
if(isset($_POST["deleteType"])) {
    if($_POST["deleteType"] == 'vehicle') {
      	delete_vehicle($_POST["delete"]);
		include '../view/admin_vehicle_list.php';
        $PageFooter = $vehiclePageFooter;
    //Delete class logic
  } elseif ($_POST["deleteType"] == 'class') {
      if(count(get_classes()) < 1){
        echo "Cannot delete the class. You must have at least one Class for vehicles.";
      } elseif (get_vehicles_by_class($_POST["delete"])) {
        echo "Cannot delete the class. You can only delete a class if there are no assosciated vehicles";
      } else {
        delete_class($_POST["delete"]);
      }
      include '../view/class_list.php';
      $PageFooter = $classPageFooter;

      //Delete make logic
  } elseif ($_POST["deleteType"] == 'make') {
      if(count(get_makes()) < 1){
        echo "Cannot delete the make. You must have at least one make for vehicles.";
      } elseif (get_vehicles_by_make($_POST["delete"])) {
        echo "Cannot delete the make. You can only delete a make if there are no assosciated vehicles";
      } else {
        delete_make($_POST["delete"]);
      }
  		include '../view/make_list.php';
        $PageFooter = $makePageFooter;
      //Delete type logic
  } elseif ($_POST["deleteType"] == 'type') {
      if(count(get_types()) < 1){
        echo "Cannot delete the type. You must have at least one type for vehicles.";
      } elseif (get_vehicles_by_type($_POST["delete"])) {
        echo "Cannot delete the type. You can only delete a type if there are no assosciated vehicles";
      } else {
        delete_type($_POST["delete"]);
      }
  		include '../view/type_list.php';
        $PageFooter = $typePageFooter;

      //This else is for if some issue occurs, mostly for debug.
  } else {
	  	echo $_POST["deleteType"] . ' ';
	  	echo $_POST["delete"] . ' ';
	 	echo "An error occurred while trying to delete";
  }

  //Adding new data logic, handled in the same order as delete.
} elseif(isset($_POST["submitType"])) {
	if($_POST["submitType"] == 'vehicle'){
		if(isset($_POST["model"]) && isset($_POST["year"]) && isset($_POST["price"]) && isset($_POST["insertMake"]) && isset($_POST["insertType"]) && isset($_POST["insertClass"])) {
		  if ($_POST["model"] && $_POST["year"] && $_POST["price"] && $_POST["insertMake"] && $_POST["insertType"] && $_POST["insertClass"]) {

		  	$inputModel = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING);
        $inputYear = filter_input(INPUT_POST, 'year', FILTER_SANITIZE_STRING);
        $inputPrice = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
        $inputMake = filter_input(INPUT_POST, 'insertMake', FILTER_SANITIZE_STRING);
        $inputType = filter_input(INPUT_POST, 'insertType', FILTER_SANITIZE_STRING);
		  	$inputClass = filter_input(INPUT_POST, 'insertClass', FILTER_SANITIZE_STRING);

        //add_item(NULL, $inputTitle, $inputDescription, $inputCategory);
			add_vehicle(NULL, $inputModel, $inputYear, $inputPrice, $inputMake, $inputType, $inputClass);
		  }	else {
		    echo 'Please Input all fields for your new vehicle.';
		  }

		}
		include '../view/admin_vehicle_list.php';
        $PageFooter = $vehiclePageFooter;

	} elseif ($_POST["submitType"] == 'class') {
		if(isset($_POST["name"])) {
			if ($_POST["name"]) {
				$inputName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
				add_class(NULL, $inputName);
			} else {
				echo 'Your class must have a name.';
			}
		}
		include '../view/class_list.php';
        $PageFooter = $classPageFooter;

	} elseif ($_POST["submitType"] == 'make') {
		if(isset($_POST["name"])) {
			if ($_POST["name"]) {
				$inputName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
				add_make(NULL, $inputName);
			} else {
				echo 'Your make must have a name.';
			}
		}
		include '../view/make_list.php';
        $PageFooter = $makePageFooter;

	} elseif ($_POST["submitType"] == 'type') {
		if(isset($_POST["name"])) {
			if ($_POST["name"]) {
				$inputName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
				add_type(NULL, $inputName);
			} else {
				echo 'Your type must have a name.';
			}
		}
		include '../view/type_list.php';
        $PageFooter = $typePageFooter;
	}


} elseif(isset($_GET["view"])) {
	if($_GET["view"] == 'classes'){
			include '../view/class_list.php';
            $PageFooter = $classPageFooter;
		} elseif($_GET["view"] == 'makes'){
  			include '../view/make_list.php';
            $PageFooter = $makePageFooter;
  	} elseif($_GET["view"] == 'types'){
  			include '../view/type_list.php';
            $PageFooter = $typePageFooter;
  	} else {
			include '../view/admin_vehicle_list.php';
            $PageFooter = $vehiclePageFooter;
		}
} else {
	include '../view/admin_vehicle_list.php';
    $PageFooter = $vehiclePageFooter;
}
include '../view/admin_footer.php';
?>
