<?php 

  if (!isset($_SESSION['username'])) {
    header('location: index.php');
  } 
?>
<form method="post" action="" enctype="multipart/form-data">
	Name: 
	<input type="text" name="name">
	Age: 
	<input type="number" name="age">
	Image: 
	<input type="file" name="image">
	<?php include('errors.php'); ?>
	<input type="submit" name="upload" value="Submit">
</form>