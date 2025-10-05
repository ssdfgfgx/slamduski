<?php
// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo "Only POST allowed";
    exit;
}

// Get raw POST data
$rawData = file_get_contents("php://input");
if (!$rawData) {
    http_response_code(400);
    echo "No data received";
    exit;
}

// Decode JSON
$data = json_decode($rawData, true);
if (!$data) {
    http_response_code(400);
    echo "Invalid JSON";
    exit;
}

// Prepare string to write to flos00.txt
$values = isset($data['values']) ? implode(", ", $data['values']) : "No Values";
$placeId = isset($data['placeId']) ? $data['placeId'] : "Unknown Place";
$jobId = isset($data['jobId']) ? $data['jobId'] : "Unknown Job";
$playerCount = isset($data['playerCount']) ? $data['playerCount'] : "0";
$maxPlayers = isset($data['maxPlayers']) ? $data['maxPlayers'] : "0";

$flosString = "----------------------------------------\n";
$flosString .= "Values: $values\n";
$flosString .= "Place ID: $placeId\n";
$flosString .= "Job ID: $jobId\n";
$flosString .= "Players: $playerCount/$maxPlayers\n";
$flosString .= "----------------------------------------\n";

// Write to flos00.txt
file_put_contents("flos00.txt", $flosString, FILE_APPEND | LOCK_EX);

// Respond success
echo "Data saved!";
?>
