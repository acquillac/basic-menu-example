<?php

require __DIR__ . '/vendor/autoload.php';

$client = new \Google_Client();
  $client->setApplicationName('Google Shees and PHP');
  $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
  $client->setAccessType('offline');
  $client->setAuthConfig(__DIR__ . './credentials.json');
  $service = new Google_Service_Sheets($client);
  $spreadsheetID = "1EDH-0WPCppDsfTYCAiEcf7mSmfyDf8AnlBXgNizQ4M8";

  $sheetData = [];


  $range = "Sheet1!A:B";
  $response = $service->spreadsheets_values->get($spreadsheetID, $range);
  $values = $response->getValues();
  if(empty($values)){
    print "No data found \n";
  } else {
    
    
    foreach ($values as $row) {
      array_push($sheetData, [$row[0], $row[1]]);
    }
    
    $jsonData = json_encode(array('data'=>$sheetData));

    file_put_contents("data.json", $jsonData);
  }

  ?>