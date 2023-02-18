<?php
// set headers to enable SSE
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
header('Access-Control-Allow-Origin: *');

// connect to database
$mysqli = new mysqli("localhost", "root", "", "birthday");
if($mysqli->connect_errno !=0){
  echo $mysqli->connect_error;
  exit();
}

// function to fetch data from the database and send it to client
function sendJsonData() {
  global $mysqli;

  $sql = "SELECT * FROM user";
  $results = $mysqli->query($sql);
  while($product = $results->fetch_assoc()){
    $user[] = $product;
  }
  $encoded_data = json_encode($user,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

  // write JSON data to file
  file_put_contents('data.json', $encoded_data);

  // send JSON data to the client
  echo "data: {$encoded_data}\n\n";
  flush();
}

// fetch and send data to client initially
sendJsonData();

// listen for changes in the database and send updates to client using SSE
while (true) {
  clearstatcache();
  $sql = "SELECT * FROM user";
  $results = $mysqli->query($sql);
  $rowCount = mysqli_affected_rows($mysqli);
  if($rowCount > 0) {
    sendJsonData();
  }
  sleep(1);
}
?>
