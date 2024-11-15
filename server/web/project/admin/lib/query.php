<?php

function query($input, $tokens) {
 $apiToken = "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";
 $requestBody = array('inputs' => $input); //, 'parameters' => array('max_new_tokens' => $tokens)

 $curl = curl_init('https://api-inference.huggingface.co/models/meta-llama/Meta-Llama-3-8B-Instruct');

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
   $response = json_decode($response, true);
   $response = str_replace($input, "", $response[0]['generated_text']);
   if (str_contains($response, "Best regards"))
    return query($input, $tokens / 2);
   else
    return $response;
 }
}

echo query("Generate 5 names for a business specializing \"ai\". Return only a JSON array with the keywords with no other content, like this: {\"keywords\": [\"word1\", \"word2\", \"word3\"]}.", 5);

?>