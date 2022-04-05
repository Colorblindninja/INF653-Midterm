<?php
$lifetime = 60 * 60 * 24 * 14;
session_set_cookie_params($lifetime, '/');
session_start();

define("ROOT",dirname(__FILE__).'/' );
require(ROOT . '/model/database.php');
require(ROOT . '/model/vehicle_db.php');
require(ROOT . '/model/make_db.php');
require(ROOT . '/model/type_db.php');
require(ROOT . '/model/class_db.php');
include ROOT . '/view/header.php';

if (isset($_GET["firstname"]) && !$_GET["firstname"] == false ) {
	$_SESSION["userid"] = $_GET["firstname"];
} elseif (isset($_GET["register"])) {
	include ROOT . '/view/register.php';
} elseif (isset($_GET["logout"])) {
	include ROOT . '/view/logout.php';
}





  //Delete logic, deleteType will be populated with what type of data we are going to delete, then handle for vehicle/class/make/type
if(isset($_POST["deleteType"])) {
    if($_POST["deleteType"] == 'vehicle') {
      	delete_vehicle($_POST["delete"]);
		include ROOT . '/view/cust_vehicle_list.php';
    //Delete class logic
  } elseif ($_POST["deleteType"] == 'class') {
      if(count(get_classes()) < 1){
        echo "Cannot delete the class. You must have at least one Class for vehicles.";
      } elseif (get_vehicles_by_class($_POST["delete"])) {
        echo "Cannot delete the class. You can only delete a class if there are no assosciated vehicles";
      } else {
        delete_class($_POST["delete"]);
      }
      include ROOT . '/view/class_list.php';
      //Delete make logic
  } elseif ($_POST["deleteType"] == 'make') {
      if(count(get_makes()) < 1){
        echo "Cannot delete the make. You must have at least one make for vehicles.";
      } elseif (get_vehicles_by_make($_POST["delete"])) {
        echo "Cannot delete the make. You can only delete a make if there are no assosciated vehicles";
      } else {
        delete_make($_POST["delete"]);
      }
  		include ROOT . '/view/make_list.php';
      //Delete type logic
  } elseif ($_POST["deleteType"] == 'type') {
      if(count(get_types()) < 1){
        echo "Cannot delete the type. You must have at least one type for vehicles.";
      } elseif (get_vehicles_by_type($_POST["delete"])) {
        echo "Cannot delete the type. You can only delete a type if there are no assosciated vehicles";
      } else {
        delete_type($_POST["delete"]);
      }
  		include ROOT . '/view/type_list.php';
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
		include ROOT . '/view/cust_vehicle_list.php';

	} elseif ($_POST["submitType"] == 'class') {
		if(isset($_POST["name"])) {
			if ($_POST["name"]) {
				$inputName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
				add_class(NULL, $inputName);
			} else {
				echo 'Your class must have a name.';
			}
		}
		include ROOT . '/view/class_list.php';

	} elseif ($_POST["submitType"] == 'make') {
		if(isset($_POST["name"])) {
			if ($_POST["name"]) {
				$inputName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
				add_make(NULL, $inputName);
			} else {
				echo 'Your make must have a name.';
			}
		}
		include ROOT . '/view/make_list.php';

	} elseif ($_POST["submitType"] == 'type') {
		if(isset($_POST["name"])) {
			if ($_POST["name"]) {
				$inputName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
				add_type(NULL, $inputName);
			} else {
				echo 'Your type must have a name.';
			}
		}
		include ROOT . '/view/type_list.php';
	}


} elseif(isset($_GET["view"])) {
	if($_GET["view"] == 'classes'){
			include ROOT . '/view/class_list.php';
		} elseif($_GET["view"] == 'makes'){
  			include ROOT . '/view/make_list.php';
  	} elseif($_GET["view"] == 'types'){
  			include ROOT . '/view/type_list.php';
  	} else {
			include ROOT . '/view/cust_vehicle_list.php';
		}
} else {
	include ROOT . '/view/cust_vehicle_list.php';
}
include ROOT . '/view/footer.php';
?>
