<?php

function query($input) {
 $apiToken = "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";
 $requestBody = array('inputs' => $input);

 $curl = curl_init('https://api-inference.huggingface.co/models/Shakker-Labs/FLUX.1-dev-LoRA-Logo-Design');

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
    header('Content-Type: image/png');
    echo $response;
  }
}

// Example call to the function
echo query($_GET['gen']);

?>