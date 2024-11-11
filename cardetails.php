<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details</title>
</head>

<body class="body">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: url("images/carbg2.jpg");
    background-position: center;
    background-size: cover;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.icon {
    width: 200px;
    float: left;
    height: 70px;
}

.navbar {
    width: 100%;
    height: 75px;
    background-color: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 30px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.navbar .logo {
    color: #007bff; /* Changed to #007bff */
    font-size: 36px;
    font-family: 'Lora', serif;
}


.menu ul {
    display: flex;
    align-items: center;
    gap: 15px;
    list-style: none;
    padding-left: 0;
    margin: 0;
}


.menu ul li {
    display: inline-block;
}

.menu ul li a, .adminbtn a {
    text-decoration: none;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 16px;
    transition: color 0.3s;
}

.menu ul li a:hover, .adminbtn a:hover {
    color: #007bff; /* Changed to #007bff */
}

.box {
    position: center;
    top: 50%;
    left: 50%;
    padding: 20px;
    box-sizing: border-box;
    background: #fff;
    border-radius: 4px;
    box-shadow: 0 5px 15px rgba(0,0,0,.5);
    background: linear-gradient(to top, rgba(255, 251, 251, 0.8)50%,rgba(250, 246, 246, 0.8)50%);
    display: flex;
    align-content: center;
    width: 600px;
    height: 200px;
    margin: 100px auto;
}

.box .imgBx {
    width: 150px;
    flex: 0 0 150px;
}

.box .imgBx img {
    max-width: 150%;
}

.box .content {
    padding-left: 100px;
}

.utton {
    width: 240px;
    height: 40px;
    background: #007bff; /* Changed to #007bff */
    border: none;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color: #fff;
    transition: 0.4s ease;
}

.nn {
    width: 100px;
    height: 40px;
    background: #007bff; /* Changed to #007bff */
    border: none;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    color: white;
    transition: 0.4s ease;
}

.nn a {
    text-decoration: none;
    color: white;
    font-weight: bold;
}

.overview {
    text-align: center;
    margin-top: 40px;
}

.circle {
    border-radius: 48%;
    width: 65px;
}

.phello {
    color: white;
    width: 200px;
    margin-left: -50px;
    padding: 0px;
}

#stat {
    margin-left: -8px;
}

footer {
    background: #333;
    color: #fff;
    text-align: center;
    padding: 15px 0;
    width: 100%;
}

footer p {
    margin: 0;
    font-size: 14px;
    margin-bottom: 12px;
}

.socials a {
    color: white;
    font-size: 20px;
    margin: 1px;
    transition: color 0.3s;
}

.socials a:hover {
    color: #66b3ff; /* Lighter Blue */
}
</style>

<?php 
    require_once('connection.php');
    session_start();

    $value = $_SESSION['email'];
    $_SESSION['email'] = $value;
    
    $sql="select * from users where EMAIL='$value'";
    $name = mysqli_query($con,$sql);
    $rows=mysqli_fetch_assoc($name);
    $sql2="select *from cars where AVAILABLE='Y'";
    $cars= mysqli_query($con,$sql2);
?>

<div class="cd">
    <div class="navbar">
        <div class="icon">
            <h2 class="logo">Velorent</h2>
        </div>
        <div class="menu">
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="aboutus2.html">ABOUT</a></li>
                <li><a href="contactus2.html">CONTACT</a></li>
                <li><a href="feedback/Feedbacks.php">FEEDBACK</a></li>
                <li><button class="nn"><a href="index.php">LOGOUT</a></button></li>
                <li><img src="images/profile.png" class="circle" alt="Alps"></li>
                <li><p class="phello">HELLO! &nbsp;<a id="pname"><?php echo $rows['FNAME']." ".$rows['LNAME']?></a></p></li>
                <li><a id="stat" href="bookinstatus.php">BOOKING STATUS</a></li>
            </ul>
        </div>
    </div>

    <h1 class="overview">OUR CARS OVERVIEW</h1>
    <ul class="de">
    <?php
        while($result= mysqli_fetch_array($cars)) {
            $res = $result['CAR_ID'];
    ?>    
    <li>
    <form method="POST">
        <div class="box">
            <div class="imgBx">
                <img src="images/<?php echo $result['CAR_IMG']?>">
            </div>
            <div class="content">
                <h1><?php echo $result['CAR_NAME']?></h1>
                <h2>Fuel Type : <a><?php echo $result['FUEL_TYPE']?></a> </h2>
                <h2>CAPACITY : <a><?php echo $result['CAPACITY']?></a> </h2>
                <h2>Rent Per Day : <a>₹<?php echo $result['PRICE']?>/-</a></h2>
                <button type="submit" name="booknow" class="utton" style="margin-top: 5px;">
                    <a href="booking.php?id=<?php echo $res;?>">book</a>
                </button>
            </div>
        </div>
    </form>
    </li>
    <?php
        }
    ?>
    </ul>
</div>

<footer>
    <p>&copy; 2024 VeloRent. All Rights Reserved.</p>
    <div class="socials">
        <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
        <a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
        <a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
    </div>
</footer>

<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
</body>
</html>
