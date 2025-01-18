<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $course = htmlspecialchars(trim($_POST['course']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validation flags
    $errors = [];

    if (empty($full_name)) {
        $errors[] = "Full Name is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email address is required.";
    }
    if (empty($phone)) {
        $errors[] = "Phone Number is required.";
    }
    if (empty($course)) {
        $errors[] = "Please select a course.";
    }

    // Check if there are errors
    if (empty($errors)) {
        // Simulate saving data (replace this with actual database or email logic)
        $success_message = "Thank you, $full_name! Your enrollment for the $course course has been received. We will contact you at $email or $phone soon.";

        // Optional: Log enrollment details to a file (for demonstration purposes)
        $log = "Name: $full_name, Email: $email, Phone: $phone, Course: $course, Message: $message\n";
        file_put_contents('enrollment_log.txt', $log, FILE_APPEND);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Confirmation - Gyan Plus</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .confirmation {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .confirmation h1 {
            color: #005cbf;
            margin-bottom: 20px;
        }

        .confirmation p {
            margin-bottom: 20px;
        }

        .error-list {
            color: red;
            margin-bottom: 20px;
        }

        .cta-button {
            display: inline-block;
            background-color: #005cbf;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .cta-button:hover {
            background-color: #003c8f;
        }
    </style>
</head>
<body>
    <div class="confirmation">
        <?php if (!empty($errors)): ?>
            <h1>Oops! Something went wrong.</h1>
            <div class="error-list">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <a href="enroll.html" class="cta-button">Go Back</a>
        <?php else: ?>
            <h1>Enrollment Successful!</h1>
            <p><?php echo $success_message; ?></p>
            <a href="index.html" class="cta-button">Return to Home</a>
        <?php endif; ?>
    </div>
</body>
</html>
