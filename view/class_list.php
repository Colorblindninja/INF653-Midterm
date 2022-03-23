<?php $classes = get_classes(); ?>
<header><h1>Vehicle Class List</h1></header>
<h4>WARNING: You will not be able to delete a class if there is a vehicle assosciated with that class. </h4>

<main>
	</br>
	  <?php foreach ($classes as $class) : ?>
		  <section>
			<?php if($class['className']) {?>
				  <p><span class="bold">Class Name:</span> <?php echo $class['className']; ?></p>
			<?php };?>
			<form class="DeleteForm" action="index.php" method="post">
			<button type="DeleteButton" name="delete" value=<?php echo $class['classID']; ?>>Delete</button>
			<input type="hidden" name="deleteType" value="class">
			</form>
		  </section>
		  </br>
	  <?php endforeach; ?>
	</br></br>

	<header><h3>Enter New Class</h3></header></br>
	    <form class="InsertForm" action="index.php" method="post">
	    <label for="name">Class Name:</label>
	    <input type="text" name="name"><br><br>
	    <button type="submit" value="Submit">Submit</button>
		<input type="hidden" name="submitType" value="class">

	</form>



    </main>
