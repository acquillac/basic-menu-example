<?php

require __DIR__ . '/vendor/autoload.php';

$client = new \Google_Client();
  $client->setApplicationName('Google Shees and PHP');
  $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
  $client->setAccessType('offline');
  $client->setAuthConfig(__DIR__ . './credentials.json');
  $service = new Google_Service_Sheets($client);
 
 //https://docs.google.com/spreadsheets/d/  ID should be here /edit#gid=0   
  $spreadsheetID = "Google Speadsheet ID Here";

  $sheetData = [];
  $range = "Sheet1!A:B";
  $response = $service->spreadsheets_values->get($spreadsheetID, $range);
  $values = $response->getValues();
  if(empty($values)){
    print "No data found \n";
  } else {
    
  // adding sheet data to an empty array     
    foreach ($values as $row) {
      array_push($sheetData, [$row[0], $row[1]]);
    }
    
  // writing sheet data to json file     
    $jsonData = json_encode(array('data'=>$sheetData));
    file_put_contents("data.json", $jsonData);
  }

  ?>
