<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $fetch_info['name'] ?> | Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
        }
        .navbar {
            background: #5e80d1;
            padding: 7px 50px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            height: 60px;
        }
        .navbar a.navbar-brand {
            color: white;
            font-size: 30px;
            font-weight: 500;
        }
        .navbar button a {
            color: #5292ce;
            font-weight: 500;
        }
        .navbar button a:hover {
            text-decoration: none;
        }
        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(110vh - 60px); /* Adjust based on navbar height */
            padding-top: 70px; /* Adjust based on navbar height */
            background-color: #f0f0f0;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        .form-container h2 {
            color: black;
            margin-bottom: 5px;
        }
        form p {
            margin: 10px 0;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            color: black;
        }
        form input[type="text"],
        form input[type="email"],
        form input[type="number"],
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form input[type="submit"],
        form input[type="reset"] {
            width: 48%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        form input[type="reset"] {
            background-color: #dc3545;
        }
        form input[type="submit"]:hover,
        form input[type="reset"]:hover {
            opacity: 0.8;
        }
        fieldset {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        legend {
            color: black;
            padding: 0 10px;
            font-size: 18px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#"><?php echo $fetch_info['name'] ?></a>
        <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
    <div class="content">
        <div class="form-container">
            <h2>Pizza Order Form</h2>
            <form action="order.php" method="post">              
                <p><label>Customer name: </label>
                    <input id="a" name="customer_name" required type="text"></p>
                <p><label>Telephone: <input id="b" name="telephone" required type="number"></label></p>
                <p><label>E-mail address: <input type="email" id="c" name="email" required></label></p>
                <fieldset>
                    <legend>Pizza Flavours</legend>
                    <select name="flavours" id="flavours">
                        <option value="Delux Cheese">Delux Cheese</option>
                        <option value="Hawaiian Chicken Cheese">Hawaiian Chicken Cheese</option>
                        <option value="Veggie Lover">Veggie Lover</option>
                        <option value="Aloha Chicken">Aloha Chicken</option>
                    </select>
                </fieldset>
                <fieldset>
                    <legend>Pizza Size</legend>
                    <select name="size" id="size" onchange="calculateTotalPrice()">
                        <option value="Small">Small (RM 6.00)</option>
                        <option value="Medium">Medium (RM 12.00)</option>
                        <option value="Large">Large (RM 18.00)</option>
                    </select>
                </fieldset>
                <p><label>Quantity: </label><input type="number" id="quantity" name="quantity" min="1" onchange="calculateTotalPrice()"></p>                      
                <h2>Total Price: RM <span id="totalPrice">0.00</span></h2>
                <p>
                    <input id="order" name="order" type="submit" value="Make an order" onclick="return myFunction()">
                    <input type="reset" id="cl" value="Clear">
                </p>
            </form>
        </div>
    </div>
    
<script>
    function myFunction() {
        return confirm("Are you sure you want to make the pizza order?");
    }

    function calculateTotalPrice() {
        var quantity = parseInt(document.getElementById('quantity').value);
        var size = document.getElementById('size').value;
        var price = 0;

        if (size === 'Small') {
            price = 6.00;
        } else if (size === 'Medium') {
            price = 12.00;
        } else if (size === 'Large') {
            price = 18.00;
        }

        var totalPrice = price * quantity;
        document.getElementById('totalPrice').textContent = totalPrice.toFixed(2);
    }
</script>
</body>
</html>