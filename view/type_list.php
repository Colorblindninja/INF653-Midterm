<?php $types = get_types(); ?>
<header><h1>Vehicle Types List</h1></header>
<h4>WARNING: You will not be able to delete a type if there is a vehicle assosciated with that type. </h4>

<main>
	</br>
	  <?php foreach ($types as $type) : ?>
		  <section>
			<?php if($type['typeName']) {?>
				  <p><span class="bold">Type Name:</span> <?php echo $type['typeName']; ?></p>
			<?php };?>
			<form class="DeleteForm" action="index.php" method="post">
			<button type="DeleteButton" name="delete" value=<?php echo $type['typeID']; ?>>Delete</button>
			<input type="hidden" name="deleteType" value="type">
			</form>
		  </section>
		  </br>
	  <?php endforeach; ?>
	</br></br>

	<header><h3>Enter New Type</h3></header></br>
	    <form class="InsertForm" action="index.php" method="post">
	    <label for="name">Type Name:</label>
	    <input type="text" name="name"><br><br>
	    <button type="submit" value="Submit">Submit</button>
		<input type="hidden" name="submitType" value="type">

	</form>






    </main>
