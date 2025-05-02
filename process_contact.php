<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $name = filter_var($_POST["name"] ?? "", FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"] ?? "", FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST["phone"] ?? "", FILTER_SANITIZE_STRING);
    $subject = filter_var($_POST["subject"] ?? "", FILTER_SANITIZE_STRING);
    $message = filter_var($_POST["message"] ?? "", FILTER_SANITIZE_STRING);
    
    // Validate inputs
    $errors = [];
    
    if (empty($name)) {
        $errors[] = "Name is required";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }
    
    if (empty($subject)) {
        $errors[] = "Subject is required";
    }
    
    if (empty($message)) {
        $errors[] = "Message is required";
    }
    
    // If no errors, proceed with sending email
    if (empty($errors)) {
        // Email recipient (your email address)
        $to = "info@deuselconsult.com"; // Replace with your actual email
        
        // Email headers
        $headers = "From: $name <$email>" . "\r\n";
        $headers .= "Reply-To: $email" . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
        
        // Email content
        $email_content = "<html><body>";
        $email_content .= "<h2>Contact Form Submission</h2>";
        $email_content .= "<p><strong>Name:</strong> $name</p>";
        $email_content .= "<p><strong>Email:</strong> $email</p>";
        
        // Include phone if provided
        if (!empty($phone)) {
            $email_content .= "<p><strong>Phone:</strong> $phone</p>";
        }
        
        $email_content .= "<p><strong>Subject:</strong> $subject</p>";
        $email_content .= "<p><strong>Message:</strong></p>";
        $email_content .= "<p>" . nl2br($message) . "</p>";
        $email_content .= "</body></html>";
        
        // Send email
        $mail_sent = mail($to, "Contact Form: $subject", $email_content, $headers);
        
        // Redirect based on success or failure
        if ($mail_sent) {
            // Redirect to thank you page or show success message
            header("Location: contact_success.html");
            exit;
        } else {
            $errors[] = "Failed to send email. Please try again later.";
        }
    }
    
    // If there are errors, redirect back to the form with error messages
    if (!empty($errors)) {
        $error_string = implode("|", $errors);
        header("Location: contact.html?error=" . urlencode($error_string));
        exit;
    }
} else {
    // If not a POST request, redirect to the contact form
    header("Location: contact.html");
    exit;
}
?>
