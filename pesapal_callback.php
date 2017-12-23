<?php
include('config.php');
$reference = null;
$pesapal_tracking_id = null;

if(isset($_GET['pesapal_merchant_reference'])) {

    $reference = $_GET['pesapal_merchant_reference'];
}

if(isset($_GET['pesapal_transaction_tracking_id'])) {

    $pesapal_tracking_id = $_GET['pesapal_transaction_tracking_id'];
}

$sql = "INSERT INTO transactions (id,reference,trackingId) VALUES ('','$reference','$pesapal_tracking_id')";

      if (mysqli_query($db,$sql) === TRUE) {
        echo "<label>Transaction successful</label>";
        header('Refresh: 3;url=index.html');
          }
      else{
      	echo "<label>Transaction not successful</label>";
        header('Refresh: 3;url=index.html');
      }

?>