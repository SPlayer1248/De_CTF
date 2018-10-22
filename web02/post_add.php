<?php 
include('server.php');
?>

<form method="post">
	
	<label>Title</label>
	<input type="text" name="title" required>
	<label>Content</label>
	<textarea name="content"></textarea>
	<?php include('errors.php') ?>
	<input type="submit" name="add_post" value="post">
</form>