<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', '', 'contact_messages');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and retrieve POST data
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']); // Avoid storing raw passwords
$message = $conn->real_escape_string($_POST['contact-message']);

// Insert into a table (you need to create this table)
$sql = "INSERT INTO contact_messages (email, password, message) VALUES ('$email', '$password', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Message sent successfully!";
} else {
    echo "Error: " . $conn->error;
}

$email = $_POST['email'];
$password = $_POST['password']; // Note: Don't store raw passwords in real apps
$message = $_POST['contact_message'];

// Format the data
$entry = "Email: $email\nPassword: $password\nMessage: $message\n---\n";

// Save to a text file
file_put_contents('messages.txt', $entry, FILE_APPEND);

echo "Message saved to file!";

$conn->close();
?>
