<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="birth.css">
    <!-- <script src="birth.js"></script> -->
   
    <title>Registration Form</title>
</head>

<body>
    <!-- <div class="container"> -->

        <div class="abc">
        <?php
        if(isset($_POST["submit"])){
            $Name = $_POST["Name"];
            $email = $_POST["email"];
            $date_of_birth = $_POST["date_of_birth"];
            $errors = array();
            if (empty($Name) or empty($email) or empty($date_of_birth)) {
                array_push($errors,"all feild are required");
            }
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                array_push($errors,"email is not valid");
            }
            if(count($errors)>0){
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
            else{
                require_once "database.php";
            
                $sql = "INSERT INTO user (Name,email,date_of_birth) VALUES (?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt=mysqli_stmt_prepare($stmt,$sql);
                if($prepareStmt){
                    $date = date("Y-m-d", strtotime($date_of_birth));
                    mysqli_stmt_bind_param($stmt, "sss", $Name, $email, $date_of_birth);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>you have registered successfully</div>";
        
                    $current_date = date("m-d");
                    $birthday_date = date("m-d", strtotime($date_of_birth));
                    if ($current_date == $birthday_date) {
                        $to = $email;
                        $subject = 'Happy Birthday '.$Name;
                        $content = 'Dear '.$Name.', Happy Birthday! Wishing you all the best on your special day. Thank you for registering with us.';
                        $headers = "From: dilip290266@gmail.com";
                        if (mail($to, $subject, $content, $headers))
                        {
                            echo "<div class='alert alert-success'>Birthday message sent successfully to ".$email."</div>";
                        } 
                        else 
                        {
                            echo "<div class='alert alert-danger'>Error sending birthday message to ".$email."</div>";
                        }
                    }
                    else
                    {
                        $to = $email;
                        $subject = 'Thank you for registering with us '.$Name;
                        $content = 'Dear '.$Name.', Thank you for registering with us. Wishing you a great day ahead.';
                        $headers = "From: dilip290266@gmail.com";
                        if (mail($to, $subject, $content, $headers))
                        {
                            echo "<div class='alert alert-success'>Registration confirmation message sent successfully to ".$email."</div>";
                        } 
                        else 
                        {
                            echo "<div class='alert alert-danger'>Error sending registration confirmation message to ".$email."</div>";
                        }
                    }
                } else{
                    die("error");
                }
        
            }
        }
        
        
        
           ?>
            <form action="birthday.php" method="post">
                <div class="form-group">
                    <span class="details">Name</span><br>
                    <input type="text" class="form-control" name="Name" placeholder="Full name" required >
                </div>
                <br>
                <div class="form-group">
                    <span class="details">E-mail</span><br>
                    <input type="email" class="form-control" name="email" placeholder="email" required>
                </div>
                <br>
                <div class="form-group">
                    <span class="details">Date of birth</span><br>
                    <input type="date" class="form-control" name="date_of_birth" placeholder="enter your dob" required>
                </div>
                <br>
                <div class="asd">
                <input type="submit" value="submit" name="submit">
                <!-- <br>
                <br> -->
                <input type="reset" value="clear">
                </div>
        
        </form>
        <div>
    <!-- </div> -->
</body>

</html>