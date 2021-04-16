<?php

// Vehicle class is responsible to perform all required actions and queries to get data from tables based on given params

require(__DIR__.'/classes/Vehicle.php');

//Check if form has been submit then perform required actions
$error = "";
if(isset($_POST['submit'])) {
$zip = $_REQUEST['zip'];
$distance = $_REQUEST['distance'];
if($zip =="" || $distance =="" || !is_numeric($zip)){
	$error = "Please enter valid zip code and distance!";
}else{
	$error = false;
$vehicle = new Vehicle($zip, $distance);

//Check if given coordinates found in database then fetch data from tables otherwise show error message
$coordinates = $vehicle->getCoordinates();
if($coordinates ==false){
$error = "Zip code not exists!";	
}else{
$listings = $vehicle->getListings();	
}
	
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Vehicle Tracking</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css">
   <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>

</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-8">
  <h2>Demo Project</h2>
  <p></p>

<?php if($error !=""){ ?>
  <div class="alert alert-danger" role="alert">
  <?php echo $error; ?>
</div>
 <?php } ?>
  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
      <label for="usr">Zip Code</label>
      <input type="text" name="zip" value="<?php echo $_REQUEST['zip']; ?>" class="form-control" id="zip">
    </div>
    <div class="form-group">
      <label for="pwd">Distance:</label>
      <select  class="form-control" name="distance" id="distance">
      <option value="50" <?php if ($_REQUEST['distance'] == '50') echo ' selected="selected"'; ?>>50 Miles</option>
      <option value="100" <?php if ($_REQUEST['distance'] == '100') echo ' selected="selected"'; ?>>100 Miles</option>
    </select>
    </div>
    <div class="form-group">
    <input type="submit" name="submit" class="btn btn-primary" value="Search" >
	</div>
  </form>
</div>
</div>
</div>
<?php 

// SHOW TABLES DATA IF SUCCESSFULLY POPULATED IN LISTINGS. TABLE IS SHOWN IN A SEAPRATE PARTIALS UI
if(isset($listings)){
require('partials/table.php');	
}


 ?>

</body>
<script type="text/javascript">
  $(document).ready(function() {
      $('#table').dataTable({"processing": true,"serverSide": true,});  
  });
  $(window).load(function(){
  	$("#output").removeClass("hidden");
  })
</script>
</html>
