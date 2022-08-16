<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'vendor/autoload.php';
require __DIR__ . '/functions.php';

use function GuzzleHttp\json_encode;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__); 
$dotenv->load();

//Test here
get_api_user();

function get_api_user()
{
    $token = get_uuid();
    $apiKey = $_ENV['API_KEY'];

      $headers = [
        'X-Reference-Id' => $token,
        'Ocp-Apim-Subscription-Key' => $apiKey,
        'Content-Type' => 'application/json'
      ];

      $client = new GuzzleHttp\Client(['headers' => $headers]);

      $body = '{
        "providerCallbackHost": "https://webhook.site/37b4b85e-8c15-4fe5-9076-b7de3071b85d"
      }';   

    try {
       
        $response = $client->request('POST','https://sandbox.momodeveloper.mtn.com/v1_0/apiuser', 
        array("body" => $body));

        print_r($response->getBody()->getContents());

    } catch (\GuzzleHttp\Exception\RequestException $e) {
        // handle exception or api errors.
        print_r($e->getMessage());
    }


}

?>