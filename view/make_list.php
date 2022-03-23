<?php $makes = get_makes(); ?>
<header><h1>Vehicle Make List</h1></header>
<h4>WARNING: You will not be able to delete a make if there is a vehicle assosciated with that make. </h4>

<main>
	</br>
	  <?php foreach ($makes as $make) : ?>
		  <section>
			<?php if($make['makeName']) {?>
				  <p><span class="bold">Make Name:</span> <?php echo $make['makeName']; ?></p>
			<?php };?>
			<form class="DeleteForm" action="index.php" method="post">
			<button type="DeleteButton" name="delete" value=<?php echo $make['makeID']; ?>>Delete</button>
			<input type="hidden" name="deleteType" value="make">
			</form>
		  </section>
		  </br>
	  <?php endforeach; ?>
	</br></br>

	<header><h3>Enter New Make</h3></header></br>
	    <form class="InsertForm" action="index.php" method="post">
	    <label for="name">Make Name:</label>
	    <input type="text" name="name"><br><br>
	    <button type="submit" value="Submit">Submit</button>
		<input type="hidden" name="submitType" value="make">

	</form>






    </main>
