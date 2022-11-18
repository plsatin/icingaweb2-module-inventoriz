<?php

// getting the baseURL from the request
$baseURL = $_REQUEST['url'];

$headers = apache_request_headers();  

// getting the request method sent in to the proxy
function getRequestMethod() {
    return $_SERVER["REQUEST_METHOD"]; 
}

// getting the POST data from a POST request
function getPostData() {
    return http_build_query($_POST);
}




function makeGetRequest($baseURL, $headers) {
    $ch = curl_init();
    $fullURL = $baseURL;

    $token = $headers['Authorization'];;
    $headersOut = array( 
        "Authorization: " . $token,
    ); 

    curl_setopt($ch, CURLOPT_URL, $fullURL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headersOut);

    $response = curl_exec($ch);
    curl_close($ch);
  
    if($e = curl_error($ch)) {
        echo $e;
    } else {
        // $json = json_decode($response, true);
        // return print_r($json);
        return $response;
    }
}

function makePostRequest($baseURL, $headers) {
    $ch = curl_init();
    $data = http_build_query($_POST);

    $token = $headers['Authorization'];;
    $headersOut = array( 
        "Authorization: " . $token,
    ); 


    curl_setopt($ch, CURLOPT_URL, $baseURL);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headersOut);

    $response = curl_exec($ch);
    curl_close($ch);

    if($e = curl_error($ch)) {
        echo $e;
    } else {
        // $json = json_decode($response, true);
        // return print_r($json);
        return $response;
    }
}

$response = "";
switch (getRequestMethod()) {
    case 'GET':
        $response = makeGetRequest($baseURL);
        break;
    case 'POST':
        $response = makePostRequest($baseURL);
        break;
    default:
        echo "There has been an error";
        return;
}

/*
access-control-allow-headers →Content-Type, Authorization, Origin
access-control-allow-methods →POST, GET, OPTIONS, PUT, DELETE
access-control-allow-origin →*
access-control-max-age →3600
*/
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization, Origin');
header('Access-Control-Max-Age: 3600');
header('Content-Type: application/json');
echo $response;

?>