<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Velorent</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript">
        window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </script>
</head>
<body>
    <?php
    require_once('connection.php');
    if(isset($_POST['login']))
    {
        $email=$_POST['email'];
        $pass=$_POST['pass'];

        if(empty($email) || empty($pass))
        {
            echo '<script>alert("Please fill the blanks")</script>';
        }
        else{
            $query="SELECT * FROM users WHERE EMAIL='$email'";
            $res=mysqli_query($con,$query);
            if($row=mysqli_fetch_assoc($res)){
                $db_password = $row['PASSWORD'];
                if(md5($pass) == $db_password)
                {
                    header("location: cardetails.php");
                    session_start();
                    $_SESSION['email'] = $email;
                }
                else{
                    echo '<script>alert("Enter a proper password")</script>';
                }
            }
            else{
                echo '<script>alert("Enter a proper email")</script>';
            }
        }
    }
    ?>

    <div class="hai">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">Velorent</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="aboutus.html">About</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="contactus.html">Contact</a></li>
                    <li><button class="adminbtn"><a href="adminlogin.php">Admin Login</a></button></li>
                </ul>
            </div>
        </div>

        <div class="content">
            <h1>Rent Your <br><span>Dream Car</span></h1>
            <p class="par">Live the life of Luxury.<br>
                Rent a car of your wish from our vast collection.<br>Enjoy every moment with your family.<br>
                Join us to make this family vast.</p>
            <button class="cn"><a href="register.php">Join Us</a></button>

            <div class="form">
                <h2>Login Here</h2>
                <form method="POST">
                    <input type="email" name="email" placeholder="Enter Email Here" required>
                    <input type="password" name="pass" placeholder="Enter Password Here" required>
                    <input class="btnn" type="submit" value="Login" name="login">
                </form>
                <p class="link">Don't have an account?<br>
                <a href="register.php">Sign up</a> here</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2024 Velorent. All Rights Reserved.</p>
            <div class="socials">
                <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>
