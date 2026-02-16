<?php
header("Content-Type: application/json");

// ================================
// DEBUG (TURN OFF IN PRODUCTION)
// ================================
ini_set('display_errors', 0);
error_reporting(0);

// ================================
// HANDLE GET REQUEST
// ================================
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method"
    ]);
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
    echo json_encode([
        "status" => "error",
        "message" => "Invalid email address"
    ]);
    exit;
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
    echo json_encode([
        "status" => "error",
        "message" => "Please use your company work email only."
    ]);
    exit;
}

// ================================
// 4. PREVENT DUPLICATES
// ================================
$file = "submitted_emails.txt";

if (!file_exists($file)) {
    file_put_contents($file, "");
}

$emails = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($emails as $line) {
    $parts = explode(" | ", $line);
    if (!empty($parts[0]) && strtolower(trim($parts[0])) === strtolower($email)) {
        echo json_encode([
            "status" => "error",
            "message" => "This email has already been submitted."
        ]);
        exit;
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

@mail($to, $subject, $message, $headers);

// ================================
// 6. SAVE EMAIL
// ================================
file_put_contents($file, "$email | " . date("Y-m-d H:i:s") . "\n", FILE_APPEND);

// ================================
// 7. SUCCESS RESPONSE
// ================================
echo json_encode([
  "status" => "success",
  "message" => "Form submitted successfully!"
]);
exit;
?>
