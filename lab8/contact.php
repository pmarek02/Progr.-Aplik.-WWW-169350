<?php
class Contact {

    public function PokazKontakt() {
        echo '
        <form action="contact.php" method="post" class="contact-form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
            <button type="submit" name="send">Send</button>
        </form>';
    }

    public function WyslijMailKontakt() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send'])) {
            $to = "admin@example.com"; 
            $subject = "New Contact Message from " . htmlspecialchars($_POST['name']);
            $message = "Message: " . htmlspecialchars($_POST['message']) . "\nEmail: " . htmlspecialchars($_POST['email']);
            $headers = "From: no-reply@example.com";

            if (mail($to, $subject, $message, $headers)) {
                echo "<p style='color: green;'>Message sent successfully.</p>";
            } else {
                echo "<p style='color: red;'>Failed to send the message. Check server mail configuration.</p>";
            }
        }
    }

    public function PrzypomnijHaslo() {
        $to = "admin@example.com"; 
        $subject = "Password Reminder";
        $message = "This is your password reminder for the admin panel.";
        $headers = "From: no-reply@example.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "<p style='color: green;'>Password reminder sent successfully.</p>";
        } else {
            echo "<p style='color: red;'>Failed to send the password reminder. Check server mail configuration.</p>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send'])) {
    $contact = new Contact();
    $contact->WyslijMailKontakt();
}
?>