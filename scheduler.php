<?php

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "database");

// Query the database for users whose birthday is today
$today = date("m-d");
$query = "SELECT * FROM user WHERE date_of_birth='$today'";
$result = mysqli_query($conn, $query);

// Iterate over the results and send birthday messages
while ($row = mysqli_fetch_assoc($result)) {
  $to = $row["email"];
  $subject = "Happy Birthday!";
  $message = "Happy Birthday, " . $row["Name"] . "!\n\n" .
             "We hope you have a fantastic day!\n\n" .
             "Best regards,\n" .
             "Your team";
  $headers = "From: dilip290266@gmail.com";
  mail($to, $subject, $message, $headers);
}

// Close the database connection
mysqli_close($conn);

?>
