<?php
// contact_form_with_errors.php
// This file is included by send_mail.php to show the form with error messages and previous values.
// Assumes $errors, $name, $email, $mobile, $message are set.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - DUVEE Tech</title>
    <link rel="stylesheet" href="skin.css">
    <style>
        .error-message { color: red; font-size: 13px; min-height: 18px; }
        .form-control { border-radius: 25px; border: 2px solid #4A90E2; color: #000; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Contact Us</h2>
        <?php if (!empty($errors['general'])): ?>
            <div class="error-message" style="margin-bottom: 10px;"> <?= $errors['general'] ?> </div>
        <?php endif; ?>
        <form id="contactForm" method="post" action="send_mail.php" autocomplete="off">
            <div style="display: flex; flex-direction: column;">
                <input type="text" name="name" placeholder="Name" class="form-control" required value="<?= htmlspecialchars($name) ?>">
                <span class="error-message"><?= $errors['name'] ?? '' ?></span>
            </div>
            <div style="display: flex; flex-direction: column;">
                <input type="email" name="email" placeholder="Email" class="form-control" required value="<?= htmlspecialchars($email) ?>">
                <span class="error-message"><?= $errors['email'] ?? '' ?></span>
            </div>
            <div style="display: flex; flex-direction: column;">
                <input type="tel" name="mobile" placeholder="Mobile Number" class="form-control" required pattern="[0-9]{10}" maxlength="10" value="<?= htmlspecialchars($mobile) ?>">
                <span class="error-message"><?= $errors['mobile'] ?? '' ?></span>
            </div>
            <div style="grid-column: span 2; display: flex; flex-direction: column;">
                <textarea name="message" placeholder="Message" class="form-control" rows="4"><?= htmlspecialchars($message) ?></textarea>
                <span class="error-message"></span>
            </div>
            <button type="submit" class="btn btn-lg" style="align-self: center; justify-self: center;">Submit</button>
        </form>
    </div>
</body>
</html>
