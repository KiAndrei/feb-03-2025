<?php
/**
 * Send OTP email via Gmail SMTP using PHPMailer.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendOtpEmail($toEmail, $otpCode) {
    if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
        throw new Exception('Composer dependencies not installed. Run: composer install');
    }
    require __DIR__ . '/vendor/autoload.php';

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = MAIL_SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = MAIL_SMTP_USER;
        $mail->Password   = MAIL_SMTP_PASS;
        $mail->SMTPSecure = MAIL_SMTP_SECURE;
        $mail->Port       = MAIL_SMTP_PORT;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = 'Your verification code – DepEd Loan System';
        $otpEscaped = htmlspecialchars($otpCode);
        $mail->Body    = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f3f4f6; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 520px; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); overflow: hidden;">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #8b0000 0%, #a52a2a 100%); padding: 28px 32px; text-align: center;">
                            <p style="margin: 0; font-size: 20px; font-weight: 700; color: #ffffff; letter-spacing: 0.02em;">DepEd Loan System</p>
                            <p style="margin: 6px 0 0; font-size: 13px; color: rgba(255,255,255,0.9); font-weight: 500;">Email Verification</p>
                        </td>
                    </tr>
                    <!-- Body -->
                    <tr>
                        <td style="padding: 32px 32px 28px;">
                            <p style="margin: 0 0 20px; font-size: 16px; color: #374151; line-height: 1.6;">Hello,</p>
                            <p style="margin: 0 0 24px; font-size: 15px; color: #4b5563; line-height: 1.6;">You requested a verification code to complete your registration. Use the code below:</p>
                            <!-- OTP Box -->
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom: 24px;">
                                <tr>
                                    <td align="center" style="background-color: #f8fafc; border: 2px dashed #8b0000; border-radius: 8px; padding: 20px 24px;">
                                        <p style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: 8px; color: #1f2937; font-family: \'Consolas\', \'Monaco\', monospace;">' . $otpEscaped . '</p>
                                    </td>
                                </tr>
                            </table>
                            <p style="margin: 0 0 8px; font-size: 14px; color: #6b7280; line-height: 1.5;">This code expires in <strong>10 minutes</strong>. Do not share it with anyone.</p>
                            <p style="margin: 0; font-size: 13px; color: #9ca3af;">If you did not request this code, you can safely ignore this email.</p>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px 32px; background-color: #f9fafb; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0; font-size: 12px; color: #9ca3af; text-align: center; line-height: 1.5;">DepEd Loan System &middot; This is an automated message. Please do not reply.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';
        $mail->AltBody = "DepEd Loan System - Email Verification\n\nYour verification code is: " . $otpCode . "\n\nThis code expires in 10 minutes. Do not share it with anyone.\n\nIf you did not request this, please ignore this email.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        throw new Exception('Email could not be sent: ' . $mail->ErrorInfo);
    }
}

/**
 * Send OTP email for password reset (same style, different copy).
 */
function sendPasswordResetOtpEmail($toEmail, $otpCode) {
    if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
        throw new Exception('Composer dependencies not installed. Run: composer install');
    }
    require __DIR__ . '/vendor/autoload.php';

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = MAIL_SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = MAIL_SMTP_USER;
        $mail->Password   = MAIL_SMTP_PASS;
        $mail->SMTPSecure = MAIL_SMTP_SECURE;
        $mail->Port       = MAIL_SMTP_PORT;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
        $mail->addAddress($toEmail);

        $mail->isHTML(true);
        $mail->Subject = 'Password reset code – SDO Cabuyao City';
        $otpEscaped = htmlspecialchars($otpCode);
        $mail->Body    = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background-color: #f3f4f6; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width: 520px; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07); overflow: hidden;">
                    <tr>
                        <td style="background: linear-gradient(135deg, #8b0000 0%, #a52a2a 100%); padding: 28px 32px; text-align: center;">
                            <p style="margin: 0; font-size: 20px; font-weight: 700; color: #ffffff; letter-spacing: 0.02em;">SDO Cabuyao City</p>
                            <p style="margin: 6px 0 0; font-size: 13px; color: rgba(255,255,255,0.9); font-weight: 500;">Password Reset</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 32px 32px 28px;">
                            <p style="margin: 0 0 20px; font-size: 16px; color: #374151; line-height: 1.6;">Hello,</p>
                            <p style="margin: 0 0 24px; font-size: 15px; color: #4b5563; line-height: 1.6;">You requested to reset your password. Use the code below to continue:</p>
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="margin-bottom: 24px;">
                                <tr>
                                    <td align="center" style="background-color: #f8fafc; border: 2px dashed #8b0000; border-radius: 8px; padding: 20px 24px;">
                                        <p style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: 8px; color: #1f2937; font-family: \'Consolas\', \'Monaco\', monospace;">' . $otpEscaped . '</p>
                                    </td>
                                </tr>
                            </table>
                            <p style="margin: 0 0 8px; font-size: 14px; color: #6b7280; line-height: 1.5;">This code expires in <strong>10 minutes</strong>. Do not share it with anyone.</p>
                            <p style="margin: 0; font-size: 13px; color: #9ca3af;">If you did not request a password reset, you can safely ignore this email.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px 32px; background-color: #f9fafb; border-top: 1px solid #e5e7eb;">
                            <p style="margin: 0; font-size: 12px; color: #9ca3af; text-align: center; line-height: 1.5;">SDO Cabuyao City &middot; This is an automated message. Please do not reply.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';
        $mail->AltBody = "SDO Cabuyao City - Password Reset\n\nYour reset code is: " . $otpCode . "\n\nThis code expires in 10 minutes. Do not share it with anyone.\n\nIf you did not request this, please ignore this email.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        throw new Exception('Email could not be sent: ' . $mail->ErrorInfo);
    }
}
