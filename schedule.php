<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body> -->
<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load composer's autoloader
require 'vendor/autoload.php';

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "birthday");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query for users who have birthdays today
$current_date = date("m-d");
$query = "SELECT name, email, date_of_birth FROM user WHERE MONTH(date_of_birth) = MONTH(CURRENT_DATE()) AND DAY(date_of_birth) = DAY(CURRENT_DATE())";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $name = $row["name"];
    $email = $row["email"];
    $subject = "Happy Birthday " . $name;
    $content = "Happy Birthday " . $name . "! Wishing you all the best on your special day.";

    // Instantiate a new PHPMailer object
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
        $mail->isSMTP();                                         // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                 // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                // Enable SMTP authentication
        $mail->Username   = 'dilip290266@gmail.com';                         // SMTP username
        $mail->Password   = 'uwrljpiaxpufaznq';                         // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                 // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        // Recipients
        $mail->setFrom('dilip290266@gmail.com', 'Birthday Bot');
        $mail->addAddress($email, $name);                      // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
        $mail->AltBody = $content;

        $mail->send();
        echo "Birthday message sent to " . $name . " (" . $email . ")<br>";
    } catch (Exception $e) {
        echo "Message could not be sent to " . $name . " (" . $email . "). Mailer Error: {$mail->ErrorInfo}<br>";
    }
    // mysqli_close($conn);
}
?>
<!-- <p>hello</p>

</body>
</html> -->
