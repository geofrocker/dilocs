<?php
include_once('OAuth.php');

//$consumer_key = 'X7qkP5jdWaZDBDo2VZfvT9kLRF5wuils';
$consumer_key = 'Rmmfel9l01gdn1nD+G2bzPPwFVTxQbXm';

//$consumer_secret = 'CfaG/O5qj9N/Pn3hgiyfhoPKdtw=';
$consumer_secret = 'cxeLSB4zlY2ioyxSuPpcQuJUmV0=';

//$statusrequestAPI = 'http://demo.pesapal.com/api/QueryPaymentStatus';
$statusrequestAPI = 'https://www.pesapal.com/API/QueryPaymentStatus';

$pesapal_notification_type        = $_GET['pesapal_notification_type'];
$pesapal_transaction_tracking_id  = $_GET['pesapal_transaction_tracking_id'];
$pesapal_merchant_reference       = $_GET['pesapal_merchant_reference'];

if ($pesapal_notification_type == 'CHANGE' && $pesapal_transaction_tracking_id != '') {

    // Pesapal parameters
    $token = $params = NULL;

    $consumer = new OAuthConsumer($consumer_key, $consumer_secret);

    // Get transaction status
    $signature_method = new OAuthSignatureMethod_HMAC_SHA1();
    $request_status = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $statusrequestAPI, $params);
    $request_status -> set_parameter('pesapal_merchant_reference', $pesapal_merchant_reference);
    $request_status -> set_parameter('pesapal_transaction_tracking_id',$pesapal_transaction_tracking_id);
    $request_status -> sign_request($signature_method, $consumer, $token);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $request_status);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    if (defined('CURL_PROXY_REQUIRED')) {
        if (CURL_PROXY_REQUIRED == 'True') {

            $proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
            curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
            curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
            curl_setopt ($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);
        }
    }

   $response = curl_exec($ch);

   $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
   $raw_header  = substr($response, 0, $header_size - 4);
   $headerArray = explode('\r\n\r\n', $raw_header);
   $header      = $headerArray[count($headerArray) - 1];

   // Transaction statusi
   $elements = preg_split('/=/',substr($response, $header_size));
   $status = $elements[1]; // PENDING, COMPLETED or FAILED

   curl_close ($ch);

   if ($status = 'COMPLETED') {

        $db_update_successful = IF_YOUR_DB_UPDATE_IS_SUCCESSFUL_THIS_IS_UPTO_YOU_TO_DETERMINE;

        if ($db_update_successful) {

            // Send Pesapal response only if we were able to update DB
            $resp = 'pesapal_notification_type='.$pesapal_notification_type;
            $resp .= '&pesapal_transaction_tracking_id='.$pesapal_transaction_tracking_id;
            $resp .= '&pesapal_merchant_reference='.$pesapal_merchant_reference;
            ob_start();
            echo $resp;
            ob_flush();
       }
    }
    elseif ($status = 'FAILED') {

        $resp = 'pesapal_notification_type='.$pesapal_notification_type;
        $resp .= '&pesapal_transaction_tracking_id='.$pesapal_transaction_tracking_id;
        $resp .= '&pesapal_merchant_reference='.$pesapal_merchant_reference;
        ob_start();
        echo $resp;
        ob_flush();
    }

    exit;
}
?>