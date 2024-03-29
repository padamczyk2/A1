<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
session_start();
require_once "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$data = [
    'name' => $_GET['firstname'] . " " . $_GET['lastname'],
    'email' => $_GET['email'],
];

print_r($data);

$query = http_build_query($data);
$hash = md5($data['email']);
$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "localhost";
$mail->Port = 25;
$mail->Username = "system-www@spotkanie-biznesowe.cloud";
$mail->Password = "Adu893rjhds-23";
$mail->CharSet = "UTF-8";
$mail->SMTPDebug = 0;
$mail->IsHTML(true);
$mail->setFrom('newsletter@oncloudnine.cloud', 'T-Mobile Polska S.A.');
$mail->AddAddress($data['email']);
$mail->Subject = "T-Mobile Polska S.A.";
$mail->Body = $twig->render('mail.html', ['query' => $query, 'hash' => $hash]);

if ($mail->Send()) {
    header('Location: https://oncloudnine.cloud/index.php?sent=true');
    exit;
} else {
    header('Location: https://oncloudnine.cloud/index.php?sent=false');
    exit;
}

