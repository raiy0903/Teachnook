<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $whatsapp = $_POST["whatsapp"];
    $alternate = $_POST["alternate"];
    $address = $_POST["address"];
    $paymentReference = $_POST["paymentRef"];

    // Connect to the MySQL database (replace with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "plant";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO orders (name, email, whatsapp, alternate, address, payment_reference) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $whatsapp, $alternate, $address, $paymentReference);

    if ($stmt->execute()) {
        echo "Order submitted successfully!";
        echo "Your order details will be share on your whatsapp shortly!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

