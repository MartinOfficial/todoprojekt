<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'plugins/PHPMailer/src/Exception.php';
require 'plugins/PHPMailer/src/PHPMailer.php';
require 'plugins/PHPMailer/src/SMTP.php';

require_once 'dbconnect.php';

$now = new DateTime();
$now_plus_24 = $now->modify('+1 day')->format('Y-m-d H:i:s');

$query = "SELECT taskId, taskName, deadline, userId FROM feladat WHERE deadline > NOW() AND deadline <= ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $now_plus_24);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $userId = $row['userId'];
    $taskName = $row['taskName'];
    $deadline = $row['deadline'];

    $query_user = "SELECT email FROM felhasznalok WHERE userid = ?";
    $stmt_user = $conn->prepare($query_user);
    $stmt_user->bind_param('i', $userId);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    $user = $result_user->fetch_assoc();
    
    $to = $user['email'];
    $subject = "Feladat hamarosan lejár: " . $taskName;
    $message = "Kedves felhasználó,\n\nA(z) '" . $taskName . "' feladatod határideje: " . $deadline . ".\nEz a feladat 24 órán belül lejár!\n\nÜdvözlettel,\nTeendőkezelő rendszer";

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();                                            // SMTP használata
        $mail->Host       = 'web02.vps4you.hu';         // SMTP szerver címe
        $mail->SMTPAuth   = true;                                   // SMTP autentikáció bekapcsolása
        $mail->Username   = 'info@martin-informatika.hu';               // SMTP felhasználónév (email címed)
        $mail->Password   = '';                  // SMTP jelszó
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // TLS titkosítás
        $mail->Port       = 587;                                   // SMTP port
        $mail->CharSet = 'UTF-8';

        $mail->setFrom('noreply@martin-informatika.hu', 'Teendőkezelő');
        $mail->addAddress($to);

        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo "Email elküldve {$to} címre a '{$taskName}' feladatról.\n";
    } catch (Exception $e) {
        echo "Email küldése sikertelen: {$mail->ErrorInfo}\n";
    }
}

echo "Értesítések feldolgozva.";
?>