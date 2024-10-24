<?php require_once 'core.php'; ?>
<?php require_once 'models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		body {
			font-family: "Arial";
		}
		input {
			font-size: 1.5em;
			height: 50px;
			width: 200px;
		}
		table, th, td {
		  border:1px solid black;
		}
	</style>
</head>
<body>
<h1>Welcome To Car rental shop, please fill in the information below to rent a car</h1>
	<form action="handleforms.php" method="POST">
		<p>
			<label for="firstname">first name</label> 
			<input type="text" name="firstname">
		</p>
		<p>
			<label for="lastname">last name</label> 
			<input type="text" name="lastname">
		</p>
		<p>
			<label for="carmanufacturer">car manufacturer</label> 
			<input type="text" name="carmanufacturer">
		</p>
		<p>
			<label for="dateofrental">date of rental</label> 
			<input type="date" name="dateofrental">
		</p>
		<p>
			<label for="carmodel">car model</label> 
			<input type="text" name="carmodel">
		</p>
		<p>
			<label for="expectedreturn">expected return</label> 
			<input type="date" name="expectedreturn">
			<input type="submit" name="Btninsert">
		</p>
	</form>

	<?php $getAllWebDevs = getAllWebDevs($pdo); ?>
	<?php foreach ($getAllWebDevs as $row) { ?>
	<div class="container" style="border-style: solid; width: 50%; height: 300px; margin-top: 20px;">
		<h3>FirstName: <?php echo $row['first_name']; ?></h3>
		<h3>LastName: <?php echo $row['last_name']; ?></h3>
		<h3>car manufactuer: <?php echo $row['car_manufacturer']; ?></h3>
		<h3>date of rental: <?php echo $row['date_of_rental']; ?></h3>
		<h3>carmodel: <?php echo $row['car_model']; ?></h3>
		<h3>expected return: <?php echo $row['expected_return']; ?></h3>


		<div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="viewprojects.php?rental_id=<?php echo $row['rental_id']; ?>">View clients</a>
			<a href="editwebdev.php?rental_id=<?php echo $row['rental_id']; ?>">Edit</a>
			<a href="deletewebdev.php?rental_id=<?php echo $row['rental_id']; ?>">Delete</a>

		</div>
		


	</div> 
	<?php } ?>
</body>
</html>