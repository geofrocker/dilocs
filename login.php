<?php
include('base.php');
?>
<?php startblock('body') ?>
<?php
include('config.php');
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['password']) && !empty($_POST['password'])){
	    $username = mysql_escape_string($_POST['name']);
	    $password = mysql_escape_string($_POST['password']);
	    $sql= "SELECT username, password, active FROM users WHERE username='".$username."' AND password='".$password."' AND active='0'";
	    $search = mysqli_query($db, $sql); 
	    $match  = mysqli_num_rows($search);
	    if($match > 0){
		    session_register("myusername");
	        $_SESSION['login_user'] = $username;
	        header('Location: home.php');
		}else{
		    $msg = 'Login Failed! Please make sure that you enter the correct details and that you have activated your account.';
		    $_SESSION['errMsg'] = "Invalid username or password";
         	header('Location: login.php');
		}
	}
}
?>
<div class="jumbotron col-md-6">
	<form method="POST">
	  <div class="form-group">
	    <input type="text" class="form-control" placeholder="Username" name="name">
	  </div>
	  <div class="form-group">
	    <input type="password" class="form-control" placeholder="Password" name="password">
	  </div>
	  <button type="submit" class="btn btn-default">Sign in</button>
	</form>
</div>
<?php endblock() ?>