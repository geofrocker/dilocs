<?php
include('base.php');
?>
<?php startblock('body') ?>
<?php
    #error_reporting(0);
    include('config.php');
    if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    	// Verify data
	    $email = mysql_escape_string($_GET['email']); // Set email variable
	    $hash = mysql_escape_string($_GET['hash']); // Set hash variable
	  	$sql = "SELECT email, hash, active FROM users WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
	  	$result = mysqli_query($db, $sql);
	    $match  = mysqli_num_rows($result);
	    
	    if($match > 0){
	        // We have a match, activate the account
	        $sql = "UPDATE users SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
	        $result = mysqli_query($db, $sql);
	        echo '<div class="jumbotron">Your account has been activated, you can now login</div>';
	    }else{
	        // No match -> invalid url or account has already been activated.
	        echo '<div class="jumbotron">The url is either invalid or you already have activated your account.</div>';
	    }
                 
	}else{
	    // Invalid approach
	    echo '<div class="jumbotron">Invalid approach, please use the link that has been send to your email.</div>';
	}
?>
<?php endblock() ?>