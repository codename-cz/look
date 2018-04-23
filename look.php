<?php

function sendPushover($message)
{

    $user = getenv('LOOK_PUSHOVER_USER');
    $token = getenv('LOOK_PUSHOVER_TOKEN');

    //TODO: check if defined

    $push = curl_init('https://api.pushover.net/1/messages.json');
    curl_setopt($push, CURLOPT_POST, 1);
    curl_setopt($push, CURLOPT_POSTFIELDS, http_build_query([
        'token'   => $token,
        'user'    => $user,
        'message' => $message
    ]));

    curl_exec($push);
    curl_close($push);
}

$site  = $argv[1];
$regex = $argv[2];

$ch = curl_init($site);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$content  = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    sendPushover(sprintf('Http code for %s is %s.', $site, $httpCode));
    exit(0);
}

$matchResult = preg_match('#' . $regex . '#', $content);

if ($matchResult === 0) {
    sendPushover(sprintf('Pattern %s not found in %s.', $regex, $site));
    exit(0);
}

if ($matchResult === false) {
    echo 'Other regex error.';
    exit(1);
}

exit(0);
