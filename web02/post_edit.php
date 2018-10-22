<?php 

include('server.php');
?>

<?php if ($editPost): ?>
	<?php echo var_dump($editPost) ?>
	<form method="post">
		<input type="hidden" name="id" value="<?php echo $editPost['id'] ?>">
		<label>Title</label>
		<input type="text" name="title" value="<?php echo $editPost['title'] ?>">
		<label>Content</label>
		<textarea type="text" name="content" ><?php echo $editPost['content']?>"</textarea>
		<?php include('errors.php') ?>
		<input type="submit" name="edit_post" value="Change">
	</form>	
<?php endif ?>
