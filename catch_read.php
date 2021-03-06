<?php 
	require '../../database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: assignments.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM AS05_catch where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
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
		    			<h3>Read an Assignment</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">Person ID</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['catchPersonID'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">FishID</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['catchFishID'];?>
						    </label>
					    </div>
					  </div>	
					</div>
				</div>
				
				
    </div> <!-- /container -->
	<div class="span10 offset12">
	<button type="button" class = "btn" onclick="history.back();">Back</button>
	</div>
  </body>
</html>