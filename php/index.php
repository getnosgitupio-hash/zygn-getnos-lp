<?php
// ================================
// DEBUG (REMOVE AFTER TESTING)
// ================================
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ================================
// HANDLE GET REQUEST
// ================================
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<title>Willwork API</title>
</head>
<body>
<h2>Willwork API</h2>
<p>This URL accepts POST requests only.</p>
<p>Please submit the form from the frontend.</p>
</body>
</html>";
    exit;
}

// ================================
// 1. COLLECT FORM DATA
// ================================
$full_name        = trim($_POST['full_name'] ?? '');
$studio_name      = trim($_POST['studio_name'] ?? '');
$email            = trim($_POST['email'] ?? '');
$country_code     = trim($_POST['country_code'] ?? '');
$mobile           = trim($_POST['mobile'] ?? '');
$monthly_projects = trim($_POST['monthly_projects'] ?? '');
$project_details  = trim($_POST['project_details'] ?? '');

$phone = $country_code . " " . $mobile;

// ================================
// 2. VALIDATE EMAIL
// ================================
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
}

// ================================
// 3. BLOCK PERSONAL EMAILS
// ================================
$blocked_domains = [
    "gmail.com","yahoo.com","outlook.com","hotmail.com","icloud.com",
    "mailinator.com","guerrillamail.com","10minutemail.com","tempmail.com","yopmail.com"
];

$emailDomain = strtolower(substr(strrchr($email, "@"), 1));

if (in_array($emailDomain, $blocked_domains)) {
    die("Please use your company work email only.");
}

// ================================
// 4. PREVENT DUPLICATES
// ================================
$file = "submitted_emails.txt";
$emails = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];

foreach ($emails as $line) {
    $parts = explode(" | ", $line);
    if (isset($parts[0]) && strtolower($parts[0]) === strtolower($email)) {
        die("This email has already been submitted.");
    }
}

// ================================
// 5. SEND EMAIL
// ================================
$to      = "sriethiraj@getnos.io";
$subject = "Zygn - Audit Form Submission";

$message  = "Zygn Audit Form Submission\n\n";
$message .= "Full Name: $full_name\n";
$message .= "Studio Name: $studio_name\n";
$message .= "Email: $email\n";
$message .= "Phone: $phone\n";
$message .= "Monthly Projects: $monthly_projects\n";
$message .= "Project Details: $project_details\n";
$message .= "Submitted On: " . date("Y-m-d H:i:s") . "\n";

$headers  = "From: hello@getnos.io\r\n";
$headers .= "Reply-To: $email\r\n";

mail($to, $subject, $message, $headers);

// ================================
// 6. SAVE EMAIL
// ================================
file_put_contents($file, "$email | " . date("Y-m-d H:i:s") . "\n", FILE_APPEND);

// ================================
// 7. REDIRECT TO THANK YOU PAGE
// ================================
header("Location: https://getnos.io/zygn/thank-you/");
exit;

?>