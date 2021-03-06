<?php 
	
	//require 'database.php';
require 'class.customer.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}

	if ( null==$id ) {
		header("Location: index.php");
	}

	if ( !empty($_POST)) {
		// keep track validation errors
		$dateError = null;
		$descriptionError = null;
		$priceError = null;

		// keep track post values
		$date = $_POST['date'];
		$description = $_POST['description'];
		$price = $_POST['price'];

		// validate input
		$valid = true;
		if (empty($date)) {
			$dateError = 'Please enter a Date';
			$valid = false;
		}

		if (empty($description)) {
			$descriptionError = 'Please enter a description';
			$valid = false;
		}

		if (empty($price)) {
			$priceError = 'Please enter a price';
			$valid = false;
		}

		// update data
		if ($valid) {
            $customer = new Customer($date, $description, $price);
            $customer->id = $id;
            $customer->save();
            //$customer->save();
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM purchase where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$date = $data['date'];
		$description = $data['description'];
		$price = $data['price'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="js/validate_update.js.js" type="text/javascript"></script>
	<script>
		$( function() {
			$( "#datepicker" ).datepicker();
		} );
	</script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Update a Purchase</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post" onsubmit="return(validate());">
						<div class="control-group <?php echo !empty($dateError)?'error':'';?>">
							<label class="control-label">Date</label>
							<div class="controls">
								<input id="datepicker" name="date" type="text"  value="<?php echo !empty($date)?$date:'';?>">
								<?php if (!empty($dateError)): ?>
									<span class="help-inline"><?php echo $dateError;?></span>
								<?php endif; ?>
								<div id="datepickerinfo" class="info"></div>
								<br />
							</div>
						</div>
						<div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
							<label class="control-label">Description</label>
							<div class="controls">
								<input id="description" name="description" type="text" value="<?php echo !empty($description)?$description:'';?>">
								<?php if (!empty($descriptionError)): ?>
									<span class="help-inline"><?php echo $descriptionError;?></span>
								<?php endif;?>
								<div id="descriptioninfo" class="info"></div>
								<br />
							</div>
						</div>
						<div class="control-group <?php echo !empty($priceError)?'error':'';?>">
							<label class="control-label">Price</label>
							<div class="controls">
								<input id="price" name="price" type="number" step="0.01" min="0" value="<?php echo !empty($price)?$price:'';?>">
								<?php if (!empty($priceError)): ?>
									<span class="help-inline"><?php echo $priceError;?></span>
								<?php endif;?>
								<div id="priceinfo" class="info"></div>
								<br />
							</div>
						</div>
						<!--<div class="form-actions">
							<button type="submit" class="btn btn-success">Create</button>
							<a class="btn" href="index.php">Back</a>
						</div>-->
					</form>
					<div class="form-actions">
						<button id="absenden" type="submit" class="btn btn-success">Create</button>
						<button id="zurueck" class="btn">Zurücksetzen</button>
						<a class="btn" href="index.php">Back</a>
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>