<?php
		$filter = 4;
		if(isset($_POST["orderBy"])) {
		    if($_POST["orderBy"] == 'Year') {
				$filter = 3;
			}
		}
		if(isset($_POST["filtered"])) {
		    if($_POST["filtered"] == 'classes') {
					$vehicles = get_vehicles_by_class($_POST["filterClasses"], $filter);
				}
				if($_POST["filtered"] == 'makes') {
					$vehicles = get_vehicles_by_make($_POST["filterMakes"], $filter);
				}
				if($_POST["filtered"] == 'types') {
					$vehicles = get_vehicles_by_type($_POST["filterTypes"], $filter);
				}
				if ($_POST["filtered"] == 'false' || !$_POST["filtered"]) {
					$vehicles = get_all_vehicles($filter);
				}
			} else {
				$vehicles = get_all_vehicles($filter);
			}
			$classes = get_classes();
			$makes = get_makes();
		  	$types = get_types();
			?>

<h4>Filters</h4>

		<form class="FilterClassesForm" action="index.php" method="post">
		<label for="listClasses">Classes: </label>
		<select name="filterClasses" id="filterClasses">
			<?php foreach ($classes as $class) : ?>
				<option value="<?php echo $class['classID']; ?>"><?php echo $class['className']; ?></option>
			<?php endforeach; ?>
			</select>
		<button type="submit" value="Submit">Submit</button>
		<input type="hidden" name="filtered" value="classes">
	</form>

	<form class="FilterMakesForm" action="index.php" method="post">
	<label for="listMakes">Makes: </label>
	<select name="filterMakes" id="filterMakes">
		<?php foreach ($makes as $make) : ?>
			<option value="<?php echo $make['makeID']; ?>"><?php echo $make['makeName']; ?></option>
		<?php endforeach; ?>
		</select>
	<button type="submit" value="Submit">Submit</button>
	<input type="hidden" name="filtered" value="makes">
</form>

<form class="FilterTypesForm" action="index.php" method="post">
<label for="listTypes">Types: </label>
<select name="filterTypes" id="filterTypes">
	<?php foreach ($types as $type) : ?>
		<option value="<?php echo $type['typeID']; ?>"><?php echo $type['typeName']; ?></option>
	<?php endforeach; ?>
</select>
<button type="submit" value="Submit">Submit</button>
<input type="hidden" name="filtered" value="types">
</form>
<br><br>
<h4>Sort By:</h4>

<form class="orderForm" action="index.php" method="post">
	<input type="radio" name = "orderBy" value="Price">Price</input>
	<input type="radio" name = "orderBy" value="Year">Year</input>
	<button type="submit" value="Submit">Submit</button>
</form>

	<form class="clearForm" action="index.php" method="post">
		<button type="submit" value="Submit">Clear Filter</button>
		<input type="hidden" name="filtered" value="false">
	</form>



<header><h1>Zippy Used Auto Vehicles</h1></header>
<main>
	</br>
	<?php if(empty($vehicles)) {?>
		<p><span class="bold">We haven't found any vehicles with those parameters</span></p>
	  <?php };?>
	  <?php foreach ($vehicles as $vehicle) : ?>
		  <section>
			<p><span class="bold">Year:</span> <?php echo $vehicle['vehicleYear']; ?></p>
			<p><span class="bold">Make:</span> <?php echo get_make_name($vehicle['vehicleMake']); ?></p>
			<p><span class="bold">Model:</span> <?php echo $vehicle['vehicleModel']; ?></p>
			<p><span class="bold">Type:</span> <?php echo get_type_name($vehicle['vehicleType']); ?></p>
			<p><span class="bold">Class:</span> <?php echo get_class_name($vehicle['vehicleClass']); ?></p>
			<p><span class="bold">Price: $</span> <?php echo $vehicle['vehiclePrice']; ?>.00</p>
			<form class="DeleteForm" action="index.php" method="post">
			<button type="DeleteButton" name="delete" value=<?php echo $vehicle['vehicleID']; ?>>Delete</button>
			<input type="hidden" name="deleteType" value="vehicle">
			</form>
		  </section>
		  </br>
	  <?php endforeach; ?>
	</br></br>

	<header><h3>Enter New Vehicles Here</h3></header></br>
	    <form class="InsertForm" action="index.php" method="post">
	    <label for="model">Vehicle Model:</label>
	    <input type="text" name="model"><br><br>
	    <label for="year">Vehicle Year:</label>
	    <input type="text" name="year"><br><br>
			<label for="price">Vehicle Price:</label>
			<input type="text" name="price"><br><br>
			<label for="insertMake">Make: </label>
			<select name="insertMake" id="insertMake">
				<?php foreach ($makes as $make) : ?>
					<option value="<?php echo $make['makeID']; ?>"><?php echo $make['makeName']; ?></option>
				<?php endforeach; ?>
				</select>

			<label for="insertType">Type: </label>
			<select name="insertType" id="insertType">
				<?php foreach ($types as $type) : ?>
					<option value="<?php echo $type['typeID']; ?>"><?php echo $type['typeName']; ?></option>
				<?php endforeach; ?>
				</select>
			<label for="insertClass">Class: </label>
			<select name="insertClass" id="insertClass">
				<?php foreach ($classes as $class) : ?>
					<option value="<?php echo $class['classID']; ?>"><?php echo $class['className']; ?></option>
				<?php endforeach; ?>
				</select>
				<br>
	    <button type="submit" value="Submit">Submit</button>
		<input type="hidden" name="submitType" value="vehicle">

	</form>


    </main>
