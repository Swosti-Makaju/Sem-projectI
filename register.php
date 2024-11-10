<!DOCTYPE html>
<html lang="en">
<head>
    <title>REGISTRATION</title>
    <link rel="stylesheet" href="css/regs.css" type="text/css">
</head>
<body>

<?php
require_once('connection.php');
if (isset($_POST['regs'])) {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $lic = mysqli_real_escape_string($con, $_POST['lic']);
    $ph = mysqli_real_escape_string($con, $_POST['ph']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $cpass = mysqli_real_escape_string($con, $_POST['cpass']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT); // Use password_hash for security

    if (empty($fname) || empty($lname) || empty($email) || empty($lic) || empty($ph) || empty($pass) || empty($gender)) {
        echo '<script>alert("Please fill in all fields.")</script>';
    } else {
        if ($pass == $cpass) {
            $sql2 = "SELECT * FROM users WHERE EMAIL='$email'";
            $res = mysqli_query($con, $sql2);
            if (mysqli_num_rows($res) > 0) {
                echo '<script>alert("Email already exists. Click OK to login!")</script>';
                echo '<script> window.location.href = "index.php";</script>';
            } else {
                $sql = "INSERT INTO users (FNAME, LNAME, EMAIL, LIC_NUM, PHONE_NUMBER, PASSWORD, GENDER) 
                        VALUES ('$fname', '$lname', '$email', '$lic', '$ph', '$hashed_pass', '$gender')";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo '<script>alert("Registration successful! Press OK to login.")</script>';
                    echo '<script> window.location.href = "index.php";</script>';
                } else {
                    echo '<script>alert("Connection error, please try again.")</script>';
                }
            }
        } else {
            echo '<script>alert("Passwords do not match.")</script>';
            echo '<script> window.location.href = "register.php";</script>';
        }
    }
}
?>

<div class="navbar">
    <div class="icon">
        <h2 class="logo">Velorent</h2>
    </div>
    <div class="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.html">About</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="contactus.html">Contact</a></li>
            <li><button class="adminbtn"><a href="adminlogin.php">Admin Login</a></button></li>
        </ul>
    </div>
</div>

<div class="main">
    <div class="register">
        <h2>Register Here</h2>

        <form id="register" action="register.php" method="POST">
            <label>First Name : </label><br>
            <input type="text" name="fname" id="name" placeholder="Enter Your First Name" required><br><br>

            <label>Last Name : </label><br>
            <input type="text" name="lname" id="name" placeholder="Enter Your Last Name" required><br><br>

            <label>Email : </label><br>
            <input type="email" name="email" id="name" placeholder="Enter Valid Email" required><br><br>

            <label>Your License number : </label><br>
            <input type="text" name="lic" id="name" placeholder="Enter Your License number" required><br><br>

            <label>Phone Number : </label><br>
            <input type="tel" name="ph" maxlength="10" onkeypress="return onlyNumberKey(event)" id="name" placeholder="Enter Your Phone Number" required><br><br>

            <label>Password : </label><br>
            <input type="password" name="pass" id="psw" placeholder="Enter Password" required><br><br>

            <label>Confirm Password : </label><br>
            <input type="password" name="cpass" id="cpsw" placeholder="Re-enter the password" required><br><br>

            <label>Gender : </label><br>
            <label for="one">Male</label>
            <input type="radio" name="gender" value="male" required>  
            <label for="two">Female</label>
            <input type="radio" name="gender" value="female" required><br><br>

            <input type="submit" class="btnn" value="REGISTER" name="regs" style="background-color: #0056b3; color: white">
        </form>
    </div>
</div>

<div id="message">
    <h3>Password must contain the following:</h3>
    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
    <p id="number" class="invalid">A <b>number</b></p>
    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>

<script>
    var myInput = document.getElementById("psw");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    myInput.onfocus = function() {
        document.getElementById("message").style.display = "block";
    }

    myInput.onblur = function() {
        document.getElementById("message").style.display = "none";
    }

    myInput.onkeyup = function() {
        var lowerCaseLetters = /[a-z]/g;
        if (myInput.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }

        var upperCaseLetters = /[A-Z]/g;
        if (myInput.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

        var numbers = /[0-9]/g;
        if (myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

        if (myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    }
</script>

<script>
    function onlyNumberKey(evt) {
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) return false;
        return true;
    }
</script>
<footer class="footer">
        <p>&copy; 2024 ValoRent. All rights reserved.</p>
        <div class="socials">
            <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
            <a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
            <a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
        </div>
    </footer>
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>

</body>
</html>
