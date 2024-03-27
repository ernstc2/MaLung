<?php
 include("showContentFunctions.php"); 
// All of this was made with ChatGPT
try {
  $apiUrl = ($_GET['apiUrl']);
  $location = removeEscapeCharacters($_GET['country']);
  $term = removeEscapeCharacters($_GET['type']);
  $sort_by = "best_match";
  $limit = 50;
  $apiKey = "VXKvvQNbY4nXXCX17Y4fhns7wbNGwvE3XMQ_f5iJ0khI6fp8KEXH8ExJQ_LGssh_-qKrLH6xfUPy-THm5wij2BId4V2eix1yJLyA3PwgL337YPqstaUwDoaQMAllZXYx";
  
  // Build the API request URL
  $requestUrl = "$apiUrl?location=$location&term=$term&sort_by=$sort_by&limit=$limit";
  
  // Set up headers (if needed, e.g., for API keys)
  $headers = [
      "Authorization: Bearer $apiKey",
  ];
  
  // Set up stream context options
  $options = [
      'http' => [
          'header' => implode("\r\n", $headers),
          'method' => 'GET',
      ],
  ];
  
  // Create a stream context
  $context = stream_context_create($options); //create a stream with the parameters stored in $options
  
  // Make the API request
  $response = file_get_contents($requestUrl, false, $context); //$requestUrl is api call, false to not include current path, $context is the options sent into the api call i think
  
  // Output the API response
  echo json_encode($response);
} catch (Exception $e) {
  header("HTTP/1.0 500 Server error in fetch.php");
  echo json_encode(array("error" => $e->getMessage()));
}

?>