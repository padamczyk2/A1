<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
session_start();
require_once "vendor/autoload.php";
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$url = 'https://api.getresponse.com/v3/contacts';
$header = ["Content-Type: application/json; charset=utf-8", "X-Auth-Token: api-key u44lezjnbb2s7g8yxs009gyl22fr2i3b"];

$data = [
  'name' => $_GET['firstname'] . " " . $_GET['lastname'],
  'email' => $_GET['email'],
  'campaign' => ['campaignId' => 'z9l7n']
];

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

if (md5($data['email']) !== $_GET['id']) {
    //echo $twig->render('register.html', ['message_bold' => 'Niestety coś poszło nie tak.', 'message' => 'Prosimy o ponowną rejestrację..']);
}

$data_string = json_encode($data);
$handle = curl_init($url);

curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($handle, CURLOPT_HEADER, true);
curl_setopt($handle, CURLOPT_HTTPHEADER, $header);
curl_setopt($handle, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($handle);
$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
curl_close($handle);


if ($httpCode === 202) {
    header('Location: https://oncloudnine.cloud/ok.html');
    exit;
} else {
    header('Location: https://oncloudnine.cloud/ok.html');
    exit;
}

?>