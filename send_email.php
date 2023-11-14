<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["sender-name"];
    $email = $_POST["sender-email"];
    $message = $_POST["message"];

    // Set recipient email address
    $recipient = "tony@torpea.dev";

    // Email subject
    $subject = "New Contact Form Submission from $name";

    // Email message
    $emailMessage = "Name: $name\n";
    $emailMessage .= "Email: $email\n";
    $emailMessage .= "Message:\n$message";

    // Additional headers
    $headers = "From: $email";

    // Send the email
    mail($recipient, $subject, $emailMessage, $headers);

    echo "Email sent successfully!";
} else {
    echo "Invalid request!";
}
?>

