<?php
include_once('OAuth.php');

// Pesapal parameters
$token = $params = null;


//$consumer_key = 'X7qkP5jdWaZDBDo2VZfvT9kLRF5wuils';
$consumer_key = 'Rmmfel9l01gdn1nD+G2bzPPwFVTxQbXm';

//$consumer_secret = 'CfaG/O5qj9N/Pn3hgiyfhoPKdtw=';
$consumer_secret = 'cxeLSB4zlY2ioyxSuPpcQuJUmV0=';

//$iframelink = 'http://demo.pesapal.com/api/PostPesapalDirectOrderV4';
$iframelink = 'https://www.pesapal.com/API/PostPesapalDirectOrderV4';
                   
// Get form details
$amount         = (integer) $_POST['amount'];
$desc           = $_POST['description'];
$type           = $_POST['type'];                      
$reference      = $_POST['reference'];                 
$first_name     = $_POST['first_name'];                
$last_name      = $_POST['last_name'];                 
$email          = $_POST['email'];
$phonenumber    = '';                                  


$callback_url = 'http://127.0.0.1/PesaPal/pesapal_callback.php';


$post_xml = '<?xml version="1.0" encoding="utf-8"?>';
$post_xml .= '<PesapalDirectOrderInfo ';
$post_xml .= 'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" ';
$post_xml .= 'xmlns:xsd="http://www.w3.org/2001/XMLSchema" ';
$post_xml .= 'Amount="'.$amount.'" ';
$post_xml .= 'Description="'.$desc.'" ';
$post_xml .= 'Type="'.$type.'" ';
$post_xml .= 'Reference="'.$reference.'" ';
$post_xml .= 'FirstName="'.$first_name.'" ';
$post_xml .= 'LastName="'.$last_name.'" ';
$post_xml .= 'Email="'.$email.'" ';
$post_xml .= 'PhoneNumber="'.$phonenumber.'" ';
$post_xml .= 'xmlns="http://www.pesapal.com" />';
$post_xml = htmlentities($post_xml);

$consumer = new OAuthConsumer($consumer_key, $consumer_secret);

// Construct the OAuth Request URL & post transaction to pesapal
$signature_method = new OAuthSignatureMethod_HMAC_SHA1();
$iframe_src = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $iframelink, $params);
$iframe_src -> set_parameter('oauth_callback', $callback_url);
$iframe_src -> set_parameter('pesapal_request_data', $post_xml);
$iframe_src -> sign_request($signature_method, $consumer, $token);

// Display pesapal iframe and pass in iframe_src
?>
<iframe src="<?php echo $iframe_src; ?>" width="100%" height="800px"  scrolling="no" frameBorder="0">
    <p>Browser unable to load iFrame</p>
</iframe>