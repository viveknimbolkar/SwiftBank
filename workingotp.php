<?php          

$OTP = rand(1000,9999);
echo $OTP;
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2?authorization=ikYcFbRUadpxgmGEVOInQLfKP7Bo8uM5WrtzSeXJAH0lCD2TZwK4s5bGxWRCh2Nv7qH0gpI61rjwuDfe&sender_id=TXTIND&message=".urlencode('This is a test message')."&route=v3&numbers=".urlencode('8390485100'),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

?>