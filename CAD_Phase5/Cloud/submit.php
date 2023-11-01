<?php
$host = "localhost"; 
$username = "root"; 
$password = "";
$dbname = "IBM";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $stmt = $db->prepare("INSERT INTO cloud (name, email, message) VALUES (:name, :email, :message)");
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":message", $message);

    if ($stmt->execute()) {
        echo "Your message has been submitted.";
        echo '<script>alert("Registration successful!");</script>';
    } else {
        echo "An error occurred. Please try again later.";
    }
}
?>
