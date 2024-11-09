<?php
    require_once ('connection.php');
    if(isset($_COOKIE['user_id'])){
        header('location:index.php',false);
        die;
    }
?>

<html>

<head>
    <title>Auction - Log In/Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sulphur+Point:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/master.css">

    <style>
        /* Hide the sign-up section by default */
        #signup {
            display: none;
        }
    </style>
    
    <script>
        // Function to show the sign-up form
        function showSignUp() {
            document.getElementById('signup').style.display = 'block'; // Show the sign-up form
            document.getElementById('login').style.display = 'none';
        }
    </script>
</head>

<body class="entirePage">
    <div class="jumbotron"></div>
    <div class="row justify-content-center">
        <div class="col-auto"></div>
        
        <!-- Log In Section --> 
        <div class="col col-4" id="login">
            <center>
                <h1>Log In</h1>
                <form action="#" method="post">
                    <div class="md-form">
                        <input required type="email" name="Email" placeholder="Email Address">
                        <br><br>
                        <input required type="password" name="password" placeholder="Your Password">
                        <br><br>
                        <input type="submit" name='login' value="Log In" class="btn btn-primary" style="float: centre;">
                        <!-- Button to show the Sign Up section -->
                        <button onclick="showSignUp()" class="btn btn-primary" style="float: centre">New Sign Up Here</button>
                    </div>
                </form>
                <br>
            
            </center>
        </div>

        <!-- <div class="col col-1" style="border-right: 1px solid #7070702F"></div> -->

        <!-- Sign Up Section -->
        <div class="col col-4" id="signup">
            <center>
                <h1>Sign Up</h1>
            </center>
            <form action="#" method="post">
                <center>
                    <div class="md-form">
                        <input required type="text" name="FirstName" placeholder="First Name">
                        <input required type="email" name="email" placeholder="Email Address" style="float: right;">
                        <br><br>
                        <input required type="text" name="LastName" placeholder="Last Name">
                        <input required type="password" name="password" placeholder="Your Password" style="float: right;">
                        <br><br>
                        <input required type="number" name="Contact" placeholder="Contact">
                        <input required type="number" name="Aadhar" placeholder="Aadhar last 4 digits" style="float: right;">
                        <input type="submit" value="Sign Up" class="btn btn-primary" name="signUp" style="float: right; margin-left: 60px;">
                        <br>
                        <select required name="payment" class="custom-select">
                            <option value="easypaisa">EasyPaisa</option>
                            <option value="cashOnDelivery">Cash on Delivery</option>
                        </select>
                    </div>
                </center>
            </form>
        </div>

        <div class="col col-1"></div>
    </div>
</body>

</html>

<?php
    // Log In Handler
    if(isset($_POST['login'])){
        $email = $_POST['Email'];
        $password = $_POST['password'];
        $query = "SELECT * FROM `auction_user` WHERE `user_email` = '$email' AND `user_password` = '$password'";
        $result = $conn->query($query);
        $rows = $result->num_rows;
        if($rows == 1){
            while ($data = $result->fetch_assoc()){
                setcookie('user_id', $data['user_id'], time() + 3600); // Logged in for one hour
                setcookie('user_first_name', $data['user_first_name'], time() + 3600);
                setcookie('user_last_name', $data['user_last_name'], time() + 3600);
                header('location:index.php');
            }
        }else{
            echo "<br><br><center>Please Double Check your Credentials</center>";
        }
    }

    // Sign Up Handler
    if(isset($_POST['signUp'])){
        $user_first_name = $_POST['FirstName'];
        $user_last_name = $_POST['LastName'];
        $user_contact = $_POST['Contact'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $payment = $_POST['payment'];
        $query = "SELECT * FROM `auction_user` WHERE `user_email` = '$email' OR `user_contact` = '$user_contact'";
        $result = $conn->query($query);
        $rows = $result->num_rows;
        if($rows >= 1){
            print "<br><br><center>There Exists a User with same email or Contact</center>" ;
        }else{
            if($payment == 'easypaisa') $payment = 'esp';
            else $payment = 'cod';
            $query = "INSERT INTO `auction_user` (`user_first_name`, `user_last_name`, `user_email`, `user_contact`, `user_password`, `payment`) VALUES ('$user_first_name', '$user_last_name', '$email', '$user_contact', '$password', '$payment')";
            $result = $conn->query($query);
            if(!$result){
                echo '<br><br><center>We Encountered a Problem, please try again</center>';
            }else{
                $query = "SELECT * FROM `auction_user` WHERE `user_email` = '$email'";
                $result = $conn->query($query);
                $rows = $result->num_rows;
                if($rows == 1){
                    while ($data = $result->fetch_assoc())
                        $userID = $data['user_id'];
                }             
                setcookie('user_id', $userID, time() + 3600); // Logged in for one hour
                setcookie('user_first_name', $user_first_name, time() + 3600);
                setcookie('user_last_name', $user_last_name, time() + 3600);
                header('location:index.php');
            }
        }
    }
?>
