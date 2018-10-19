<?php 

  if (!isset($_SESSION['username'])) {
    header('location: index.php');
  } 
?>
<h1>Home</h1>

<?php 


$query = "SELECT * from pets";
$result  = mysqli_query($db, $query);
$pets  = array();
if($result){
	while ($row = mysqli_fetch_assoc($result)) {
	array_push($pets,$row);
}
}


?>

<?php foreach ($pets as $pet): ?>
	<p><?php echo $pet['name']; ?></p>
	<p><?php echo $pet['age']; ?></p>
	<p><?php echo $pet['owner']; ?></p>
	<img src="<?php echo $pet['image']; ?>" style="height: 100px; width: 100px;">
	<br><br>
<?php endforeach ?>