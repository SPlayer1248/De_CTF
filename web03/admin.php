

<?php include('server.php') ?>
<?php 
    if (!isset($_SESSION['level']) || $_SESSION['level'] != '1') {
    	header('location: index.php');
    }
    ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Manage messages</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <?php if(isset($all_mess)): ?>
        	
        <div class="container">
        	
            <div class="row">
            	<?php foreach ($all_mess as $mess):  ?>
                <div class="col-md-8">
                    <div class="comments-list">
                        <div class="media">
                            <p class="pull-right"><small><?php echo $mess['date'] ?></small></p>
                            <p class="media-heading user_name" href="#">
                            	<?php echo $mess['sender'] ?> To <?php echo $mess['receiver'] ?>
                            	<form method="post" style=" border: none;">
                            		<input name="id" value="<?php echo $mess['id'] ?>" style='display: none;'>
                            		<input type="submit" name="del_mess" value="Delete">
                            	</form>
                            </p>

                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $mess['title'] ?></h4>
                                <?php echo $mess['content'] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <?php endforeach ?>
            </div>
        
        </div>
        <?php endif ?>
    </body>
</html>

