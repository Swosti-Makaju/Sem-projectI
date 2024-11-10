<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRATOR</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            background-image: url("../images/regs.jpg");
            background-size: cover;
            background-position: center;
            font-family: sans-serif;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background-color: #333;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo h2 {
            color: #007bff;
            font-family: 'Lora', serif;
            font-size: 34px;
            letter-spacing: 1px;
        }

        .navbar .menu ul {
            display: flex;
            gap: 30px;
            list-style: none;
        }

        .navbar .menu ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: 600;
            font-size: 18px;
            text-transform: uppercase;
            transition: color 0.3s ease;
        }

        .navbar .menu ul li a:hover {
            color: #007bff;
        }

        .main {
            width: 400px;
            margin: 100px auto;
            padding-bottom: 50px;
        }

        .btnn {
            width: 240px;
            height: 40px;
            background: #007bff;
            border: none;
            margin-top: 30px;
            margin-left: 40px;
            font-size: 18px;
            border-radius: 10px;
            cursor: pointer;
            color: #fff;
            transition: 0.4s ease;
        }

        .btnn:hover {
            background: #fff;
            color: #007bff;
        }

        .btnn a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            padding: 20px;
            font-family: sans-serif;
            color: #007bff;
        }

        .register {
            background-color: rgba(0, 0, 0, 0.6);
            width: 100%;
            font-size: 18px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.3);
            color: #fff;
            margin: auto;
            padding: 20px;
        }

        form#register {
            margin: 40px;
            margin-top: 10px;
        }

        label {
            font-family: sans-serif;
            font-size: 18px;
            font-style: italic;
        }

        input[type="text"], input[type="number"], input[type="file"] {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 7px;
            background-color: #fff;
            color: #000;
            margin-top: 10px;
            box-shadow: inset 1px 1px 5px rgba(0, 0, 0, 0.3);
        }

        #back {
            width: 100px;
            height: 40px;
            background: #007bff;
            border: none;
            margin-top: 10px;
            margin-left: 20px;
            font-size: 18px;
            color: white;
            border-radius: 10px;
            cursor: pointer;
        }

        #back a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        /* Footer */
        footer {
            bottom: 0;
            left: 0;
            width: 100%;
            background: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }

        .socials a {
            color: white;
            font-size: 20px;
            margin: 5px;
            transition: color 0.3s;
        }

        .socials a:hover {
            color: #66b3ff;
        }
    </style>
</head>
<body>

<header class="navbar">
    <div class="logo">
        <h2>ValoRent</h2>
    </div>
    <nav class="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="services.html">Services</a></li>
            <li><a href="contactus.html">Contact</a></li>
        </ul>
    </nav>
</header>

<button id="back"><a href="adminvehicle.php">CANCEL</a></button>

<div class="main">
    <div class="register">
        <h2>Enter Details Of New Car</h2>
        <form id="register" action="upload.php" method="POST" enctype="multipart/form-data">
            <label>Car Name:</label><br>
            <input type="text" name="carname" placeholder="Enter Car Name" required><br><br>

            <label>Fuel Type:</label><br>
            <input type="text" name="ftype" placeholder="Enter Fuel Type" required><br><br>

            <label>Capacity:</label><br>
            <input type="number" name="capacity" min="1" placeholder="Enter Capacity Of Car" required><br><br>
            
            <label>Price:</label><br>
            <input type="number" name="price" min="1" placeholder="Enter Price Of Car for One Day (in rupees)" required><br><br>

            <label>Car Image:</label><br>
            <input type="file" name="image" required><br><br>

            <input type="submit" class="btnn" value="ADD CAR" name="addcar">
        </form>
    </div> 
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
