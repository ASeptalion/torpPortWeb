<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        // CSRF token validation failed
        http_response_code(403); // Forbidden
        exit('Invalid CSRF token');
    }

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
    if (mail($recipient, $subject, $emailMessage, $headers)) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email.";
    }

    // Reset the CSRF token to generate a new one for the next form submission
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
} else {
    http_response_code(400); // Bad Request
    echo "Invalid request!";
}
?>
