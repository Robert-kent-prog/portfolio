<?php
  $receiving_email_address = 'robertmuendo23@gmail.com';  // Replace with your email address

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;

  // Collecting form data
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Adding messages (form data)
  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);

  // Use PHP's mail() function to send the email
  $headers = "From: " . $_POST['email'] . "\r\n";
  $headers .= "Reply-To: " . $_POST['email'] . "\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  // Prepare the email content
  $message = "Name: " . $_POST['name'] . "<br>";
  $message .= "Email: " . $_POST['email'] . "<br>";
  $message .= "Message: " . nl2br($_POST['message']);

  // Send the email
  $mail_sent = mail($receiving_email_address, $_POST['subject'], $message, $headers);

  if ($mail_sent) {
    echo "Message sent successfully!";
  } else {
    echo "Failed to send message!";
  }
?>
