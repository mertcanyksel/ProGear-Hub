<?php
include "src/database.php";
// if request method is post, a form is being submitted

$submitting = false;
if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    //process post data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $date = date('Y-m-d H:i:s');

    $query = "
    INSERT INTO contact_us 
    (name,email,subject,message,submitted_at)
    VALUES(?,?,?,?,?)";

    $statement = $connection -> prepare($query);
    $statement -> bind_param("sssss",$name,$email,$subject,$message,$date);
    $statement -> execute();
    $submitting = true;
}
?>



<!DOCTYPE html>
<html lang="en">

<?php include "includes/head.php"; ?>

<body>
    <?php include "includes/pageheader.php" ?>
   
    <main class="container">
        <form id="contact-form" method="post" action="contact.php">
            <?php
            if( $submitting == true ) {
                echo "<p class='alert'>Thank you for contacting us</p>";
            }
            ?>
            <h3>Contact Us</h3>
            <label for="name">Your Name</label>
            <input maxlength="255" type="text" name="name" id="name" placeholder="Jane Smith">
            <label for="email">Your Email Address</label>
            <input maxlength="255" type="email" name="email" id="email" placeholder="you@example.com">
            <label for="subject">Message Subject</label>
            <input maxlength="255" type="text" name="subject" id="subject" placeholder="Hey there">
            <label for="message">Message</label>
            <textarea rows="5" cols="50" name="message" id="message" placeholder="Your message"></textarea>
            <div class="buttons">
                <button type="reset">Cancel</button>
                <button type="submit">Send</button>
            </div>
        </form>
    </main>
    <?php include "includes/footer.php"; ?>
</body>

</html>