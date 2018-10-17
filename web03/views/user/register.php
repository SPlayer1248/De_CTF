<form method="post" action="?c=user&a=register">
  	
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password">
  	</div>
    <?php
      if(isset($err)){
        echo $err;
      }
     ?>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="register">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="?c=user&a=login">Sign in</a>
  	</p>
  </form>