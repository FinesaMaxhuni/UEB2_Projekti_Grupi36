<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Dalim një folder prapa (../) për të gjetur folderin PHPMailer te rrënja e projektit
require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Marrim të dhënat nga forma dhe i pastrojmë për siguri
    $fullname = htmlspecialchars($_POST['fullname']);
    $email    = htmlspecialchars($_POST['email']);
    $message  = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // KONFIGURIMI I SMTP (GMAIL)
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        
        // 1. EMAILI I PROJEKTIT TËND GMAIL
        $mail->Username   = 'netwave.project@gmail.com'; 
        
        // 2. APP PASSWORD (Kodi me 16 shkronja që gjeneron nga llogaria Google)
        $mail->Password   = 'gbpt jzak uusk lxtk'; 
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // KUSH E DËRGON (Duhet të jetë emaili yt që bën thirrjen në server)
        $mail->setFrom('netwave.project@gmail.com', 'NetWave Forma');
        
        // KU SHKON EMAILI (Mesazhi të vjen po te ky email i projektit në Inbox)
        $mail->addAddress('netwave.project@gmail.com');
        
        // REPLY-TO (Kur ti t'i bësh "Reply" në Gmail, mesazhi i shkon automatikisht klientit)
        $mail->addReplyTo($email, $fullname);

        // PËRMBAJTJA E EMAIL-IT
        $mail->isHTML(true);
        $mail->Subject = "Mesazh i ri nga forma e kontaktit: " . $fullname;
        $mail->Body    = "
            <div style='font-family: Arial, sans-serif; padding: 20px; border: 1px solid #e2e8f0; border-radius: 8px;'>
                <h2 style='color: #2563eb; margin-top: 0;'>Keni pranuar një mesazh të ri</h2>
                <hr style='border: 0; border-top: 1px solid #cbd5e1; margin-bottom: 20px;'>
                <p><strong>Emri i plotë:</strong> {$fullname}</p>
                <p><strong>Email-i i dërguesit:</strong> {$email}</p>
                <p><strong>Mesazhi:</strong></p>
                <div style='background-color: #f8fafc; padding: 15px; border-left: 4px solid #2563eb; border-radius: 4px; white-space: pre-line;'>
                    ".nl2br($message)."
                </div>
            </div>
        ";

        $mail->send();
        
        // Ktheje përdoruesin te faqja kryesore e operatorit me një njoftim popup
        echo "<script>alert('Mesazhi u dërgua me sukses!'); window.location.href='telecomeoperator.php';</script>";

    } catch (Exception $e) {
        // Nëse ka ndonjë gabim, shfaqe njoftimin dhe ktheje përdoruesin prapa
        echo "<script>alert('Gabim gjatë dërgimit: {$mail->ErrorInfo}'); window.history.back();</script>";
    }
} else {
    // Nëse dikush tenton të hyjë direkt te ky skedar pa shtypur butonin e formës
    header("Location: telecomeoperator.php");
    exit();
}
?>