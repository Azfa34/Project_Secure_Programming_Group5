<?php
require_once "controllerUserData.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve the form data
    $card_number = $_POST["cardNumber"] ?? '';
    $expiry_date = $_POST["expiryDate"] ?? '';
    $cvv = $_POST["cvv"] ?? '';

    if (empty($card_number) || empty($expiry_date) || empty($cvv)) {
        echo "All fields are required.";
        exit();
    }

    // Database connection configuration
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "users";

    try {
        // Create a new PDO instance
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO payments (card_number, expiry_date, cvv) VALUES (?, ?, ?)");
        $stmt->bindParam(1, $card_number);
        $stmt->bindParam(2, $expiry_date);
        $stmt->bindParam(3, $cvv);

        // Execute the statement
        $stmt->execute();

        // Close the database connection
        $conn = null;

        // Redirect to a success page or display a success message
        echo "<script>
        alert('Payment processed successfully!');
        window.location.href = 'home.php';
      </script>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
