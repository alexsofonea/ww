<?php
header("Access-Control-Allow-Origin: *"); // Allow requests from any origin
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow specific HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow specific headers

set_time_limit(300); // 5 minutes
function query($input) {
 $apiToken = "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";
 $requestBody = array(
  'inputs' => "poster;" . $input
);

 $curl = curl_init('https://api-inference.huggingface.co/models/AlekseyCalvin/Propaganda_Poster_Schnell_by_doctor_diffusion');

 curl_setopt($curl, CURLOPT_POST, true);
 curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($requestBody));
 curl_setopt($curl, CURLOPT_HTTPHEADER, array(
   'Content-Type: application/json',
   'Authorization: Bearer ' . $apiToken
 ));

 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

 $response = curl_exec($curl);

 $curlError = curl_error($curl);
 curl_close($curl);

  if ($curlError) {
  return 'Error: ' . $curlError;
  } else {
    // Set the appropriate header for image display (e.g., PNG)
    echo base64_encode($response);
  }
}

// Example call to the function
echo query($_GET['gen']);

?>