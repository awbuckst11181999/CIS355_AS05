	<?php 
	session_start();
	require '../../database.php';
			$valid = true;
			$selectedPerson = $_POST["personName"];
			$selectedFish = $_POST["fishName"];
			$selectedWeight = $_POST["fishWeight"];
			$selectedLength = $_POST["fishLength"];
			if ($selectedPerson == "--Select Person--"){
				$valid = false;
			}
			if ($selectedFish == "--Select Fish--"){
				$valid = false;
			}
			if ($selectedPerson == null){
				$valid = false;
			}
			if ($selectedFish == null){
				$valid = false;
			}
			
			

			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM AS05_fish";
			$q = $pdo->prepare($sql);
			$q->execute();
			$results = $q->fetchAll();
						
			
			if ($valid){	
			
			
			$sql5 = "SELECT fishID from AS05_fish WHERE fishSpecies = '" . $selectedFish . "'";
			$q5 = $pdo->prepare($sql5);
			$q5->execute();
			$fishID = $q5->fetchAll();
			
			$sql6 = "SELECT fishID from AS05_fish WHERE fishWeight = '" . $selectedWeight . "'";
			$q6 = $pdo->prepare($sql6);
			$q6->execute();
			$fishWeights = $q6->fetchAll();
			
			
			
			
			
			
			
			
			$sql3 = "INSERT INTO AS05_catch (catchPersonID, catchFishID) values(?, ?)";
			$q3 = $pdo->prepare($sql3);
			
		
			$q3->execute(array($_SESSION['personID'],$fishID[0][0]));
			Database::disconnect();
			header("Location: catch.php");
			}
			var_dump($results);
			echo $selectedFish;
			
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create a Catch</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="catch_create.php" method="post">
				
							<select name = "fishName"  onchange = "this.form.submit()">
							<option>--Select Fish--</option>
								<?php foreach ($results as $output) { ?>
								<option><?php echo $output["fishSpecies"];
											  
								?> </option>
								<?php }?>
							</select>
							
							
							
							<select name = "fishWeight">
							<option>--Select Weight--</option>
								<?php foreach ($results as $output) { 
								
									
								
								if (strcmp($output['fishSpecies'],$selectedFish)==0){
									echo "<option>";
										echo $output['fishWeight'];
										echo "</option>";
								}							
								
							}?>
							</select>
							
						<?php
						?>
						
						
						
						
						
			

					  <div class="form-actions">
						  <a class = "btn btn-info" href = "fish_create.php">Add New Fish</a>
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="catch.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>