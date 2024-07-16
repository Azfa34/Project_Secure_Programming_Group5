<?php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => true,
    'httponly' => true
]);
session_start();


require "connection.php";

// Fetch orders from the database
$sql = "SELECT * FROM orders";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page | Orders</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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
            padding-top: 70px;
            background-color: #f0f0f0;
            height: 100%;
        }
        .table-container {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #5e80d1;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a class="navbar-brand" href="#">Admin</a>
        <button type="button" class="btn btn-light"><a href="logout-user.php">Logout</a></button>
    </nav>
    <div class="content">
        <div class="table-container">
            <h2>Customer Orders</h2>
            <table>
                <thead>
                    <tr>
                        <th>Customer Name</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Flavour</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['customer_name'] . "</td>";
                            echo "<td>" . $row['telephone'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['flavor'] . "</td>";
                            echo "<td>" . $row['size'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>RM " . number_format($row['total_price'], 2) . "</td>";
                            echo "<td>" . $row['order_date'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No orders found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
