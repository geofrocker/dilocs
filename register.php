<?php
include('base.php');
?>
<?php startblock('body') ?>
<?php
    #error_reporting(0);
	include('config.php');
	#require('PHPMailer.php');
	#require('SMTP.php');
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['email']) && !empty($_POST['email'])){
		    $name = mysql_real_escape_string($_POST['name']);
		    $email = mysql_real_escape_string($_POST['email']);
		    if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
			    // Return Error - Invalid Email
			    $msg = 'The email you have entered is invalid, please try again.';
			}else{
			    // Return Success - Valid Email
			    $hash = md5( rand(0,1000) );
			    $password = rand(1000,5000);
			    $sql = "INSERT INTO users (username, password, email, hash) VALUES(
					'". mysql_real_escape_string($name) ."', 
					'". mysql_real_escape_string($password) ."', 
					'". mysql_real_escape_string($email) ."', 
					'". mysql_real_escape_string($hash) ."')";

				$result = mysqli_query($db,$sql);
				if ($result) {
					$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
					$to      = $email; // Send email to our user
					$subject = 'Signup | Verification'; // Give the email a subject 
					$message = '
					 
					Thanks for signing up!
					Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
					 
					------------------------
					Username: '.$name.'
					Password: '.$password.'
					------------------------
					 
					Please click this link to activate your account:
					http://127.0.0.1/IdealTrips/verify.php?email='.$email.'&hash='.$hash.'
					 
					'; // Our message above including the link
					$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
					$mess = wordwrap($message, 70, "\r\n");
					mail($to, $subject, $mess); // Send our email
					                     
					// $mail = new PHPMailer();

					// $mail->IsSMTP(); // telling the class to use SMTP
					// $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
					//                                            // 1 = errors and messages
					//                                            // 2 = messages only
					// $mail->SMTPAuth   = true;                  // enable SMTP authentication
					// $mail->SMTPSecure = "tls";                 
					// $mail->Host       = "smtp.gmail.com";      // SMTP server
					// $mail->Port       = 587;                   // SMTP port
					// $mail->Username   = "geofrocker@gmail.com";  // username
					// $mail->Password   = "bikongozo";            // password

					// $mail->addAddress($to);

					// $mail->Subject = $subject;

					// $mail->MsgHTML($message);

					// if(!$mail->Send()) {
					//   echo "Mailer Error: " . $mail->ErrorInfo;
					// } else {
					//   echo "Message sent!";
					// }


					header('Location: login.php');
				} else {
					$msg = 'Account Registration Failed... try to sign up later';
					header('Location: register.php');
				}
			}
		}
    }

?>


<div class="jumbotron col-md-6">
	<?php 
	    if(isset($msg)){
	        echo '<div class="statusmsg">'.$msg.'</div>';
	    } 
	?>
	<form method="POST">
	  <div class="form-group">
	    <input type="text" class="form-control" placeholder="Username" name="name" required="TRUE">
	  </div>
	  <div class="form-group">
	    <input type="email" class="form-control" placeholder="Email" name="email" required="TRUE">
	  </div>
	  <button type="submit" class="btn btn-default">Register</button>
	</form>
</div>
<?php endblock() ?>
