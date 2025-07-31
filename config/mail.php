<?php
/**
 * NPS Education Mail Configuration
 * Project-specific mail setup using PHPMailer with Zoho SMTP
 */

require_once __DIR__ . '/../vendor/PHPMailer/src/Exception.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../vendor/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/env-loader.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class NPSMailer {
    private $mail;
    private $config;
    
    public function __construct() {
        // Load environment variables
        EnvLoader::load();
        
        // Mail configuration from environment variables - no hardcoded values!
        $this->config = [
            'smtp_host' => EnvLoader::get('MAIL_HOST'),
            'smtp_port' => EnvLoader::get('MAIL_PORT'),
            'smtp_secure' => PHPMailer::ENCRYPTION_STARTTLS,
            'smtp_auth' => true,
            'username' => EnvLoader::get('MAIL_USERNAME'),
            'password' => EnvLoader::get('MAIL_PASSWORD'),
            'from_email' => EnvLoader::get('MAIL_FROM_ADDRESS'),
            'from_name' => EnvLoader::get('MAIL_FROM_NAME'),
            'admin_email' => EnvLoader::get('ADMIN_EMAIL')
        ];
        
        $this->mail = new PHPMailer(true);
        $this->configureSMTP();
    }
    
    private function configureSMTP() {
        try {
            // Server settings
            $this->mail->isSMTP();
            $this->mail->Host = $this->config['smtp_host'];
            $this->mail->SMTPAuth = $this->config['smtp_auth'];
            $this->mail->Username = $this->config['username'];
            $this->mail->Password = $this->config['password'];
            $this->mail->SMTPSecure = $this->config['smtp_secure'];
            $this->mail->Port = $this->config['smtp_port'];
            
            // Default from address
            $this->mail->setFrom($this->config['from_email'], $this->config['from_name']);
            
            
        } catch (Exception $e) {
            error_log("Mail configuration error: " . $e->getMessage());
        }
    }
    
    /**
     * Send admission confirmation email to student
     */
    public function sendAdmissionConfirmation($studentEmail, $studentName) {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($studentEmail, $studentName);
            
            $this->mail->isHTML(true);
            $this->mail->Subject = 'NPS Education - Your Application Received';
            $this->mail->Body = $this->getAdmissionConfirmationHTML($studentName);
            $this->mail->AltBody = $this->getAdmissionConfirmationText($studentName);
            
            return $this->mail->send();
            
        } catch (Exception $e) {
            error_log("Admission confirmation email error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send admission alert to admin
     */
    public function sendAdmissionAlert($studentData) {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($this->config['admin_email']);
            $this->mail->addReplyTo($studentData['email'], $studentData['name']);
            
            $this->mail->isHTML(true);
            $this->mail->Subject = "New Admission Application - {$studentData['name']}";
            $this->mail->Body = $this->getAdmissionAlertHTML($studentData);
            $this->mail->AltBody = $this->getAdmissionAlertText($studentData);
            
            return $this->mail->send();
            
        } catch (Exception $e) {
            error_log("Admission alert email error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send franchise confirmation email to applicant
     */
    public function sendFranchiseConfirmation($applicantEmail, $applicantName) {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($applicantEmail, $applicantName);
            
            $this->mail->isHTML(true);
            $this->mail->Subject = 'NPS Education - Your Franchise Application Received';
            $this->mail->Body = $this->getFranchiseConfirmationHTML($applicantName);
            $this->mail->AltBody = $this->getFranchiseConfirmationText($applicantName);
            
            return $this->mail->send();
            
        } catch (Exception $e) {
            error_log("Franchise confirmation email error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send franchise alert to admin
     */
    public function sendFranchiseAlert($franchiseData) {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($this->config['admin_email']);
            $this->mail->addReplyTo($franchiseData['email'], $franchiseData['name']);
            
            $this->mail->isHTML(true);
            $this->mail->Subject = "New Franchise Application - {$franchiseData['name']}";
            $this->mail->Body = $this->getFranchiseAlertHTML($franchiseData);
            $this->mail->AltBody = $this->getFranchiseAlertText($franchiseData);
            
            return $this->mail->send();
            
        } catch (Exception $e) {
            error_log("Franchise alert email error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send custom email
     */
    public function sendCustomEmail($to, $subject, $body, $replyTo = null, $isHTML = false) {
        try {
            $this->mail->clearAddresses();
            $this->mail->addAddress($to);
            
            if ($replyTo) {
                $this->mail->addReplyTo($replyTo);
            }
            
            $this->mail->isHTML($isHTML);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            
            return $this->mail->send();
            
        } catch (Exception $e) {
            error_log("Custom email error: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Set email password (call this method to set your Zoho password)
     */
    public function setPassword($password) {
        $this->config['password'] = $password;
        $this->mail->Password = $password;
    }
    
    // ===========================================
    // HTML EMAIL TEMPLATES
    // ===========================================
    
    /**
     * Get base HTML template
     */
    private function getBaseHTML($title, $content) {
        return '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>' . $title . '</title>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                }
                body {
                    font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
                    line-height: 1.6;
                    color: #333;
                    background-color: #f4f4f4;
                }
                .container {
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    box-shadow: 0 0 20px rgba(0,0,0,0.1);
                }
                .header {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    padding: 30px;
                    text-align: center;
                }
                .header h1 {
                    font-size: 27px;
                    margin-bottom: 10px;
                    font-weight: 300;
                }
                .header p {
                    font-size: 14px;
                    opacity: 0.9;
                }
                .content {
                    padding: 40px 30px;
                }
                .welcome {
                    font-size: 24px;
                    color: #2c3e50;
                    margin-bottom: 20px;
                    font-weight: 300;
                }
                .message {
                    font-size: 16px;
                    line-height: 1.8;
                    color: #555;
                    margin-bottom: 30px;
                }
                .highlight-box {
                    background: #f8f9ff;
                    border-left: 4px solid #667eea;
                    padding: 20px;
                    margin: 20px 0;
                }
                .info-table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 20px 0;
                }
                .info-table td {
                    padding: 12px;
                    border-bottom: 1px solid #eee;
                }
                .info-table .label {
                    font-weight: 600;
                    color: #2c3e50;
                    width: 30%;
                }
                .button {
                    display: inline-block;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    text-decoration: none;
                    padding: 15px 30px;
                    border-radius: 5px;
                    font-weight: 600;
                    margin: 20px 0;
                }
                .footer {
                    background-color: #2c3e50;
                    color: white;
                    padding: 30px;
                    text-align: center;
                }
                .footer p {
                    margin-bottom: 10px;
                }
                .contact-info {
                    background: #ecf0f1;
                    padding: 20px;
                    border-radius: 5px;
                    margin: 20px 0;
                }
                .status-badge {
                    display: inline-block;
                    background: #27ae60;
                    color: white;
                    padding: 5px 15px;
                    border-radius: 20px;
                    font-size: 14px;
                    font-weight: 600;
                }
                @media only screen and (max-width: 600px) {
                    .container {
                        width: 100% !important;
                    }
                    .content {
                        padding: 20px !important;
                    }
                    .header {
                        padding: 20px !important;
                    }
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1><img src="../assets/images/logos/Nps.png" style="width: 7%;">  NPS Education</h1>
                    <p>Excellence in Skill Education </p>
                </div>
                
                <div class="content">
                    ' . $content . '
                </div>
                
                <div class="footer">
                    <p><strong>📍 NPS Education Malda</strong></p>
                    <p>📲 Phone: +91 97359 93004</p>
                    <p>📧 Email: npseducation@npsvision.com</p>
                    <p>🌐 Website: education.npsvision.com</p>
                    <p style="margin-top: 20px; font-size: 14px; opacity: 0.8;">
                        This email was sent from NPS Education.
                    </p>
                </div>
            </div>
        </body>
        </html>
        ';
    }
    
    /**
     * Admission Confirmation HTML Template
     */
    private function getAdmissionConfirmationHTML($studentName) {
        $content = '
            <h2 class="welcome">Welcome to NPS Education! 🎉</h2>
            
            <p class="message">
                Dear <strong>' . htmlspecialchars($studentName) . '</strong>,
            </p>
            
            <div class="highlight-box">
                <p style="margin: 0; font-size: 18px; color: #27ae60;">
                    ✅ <strong>Your application has been successfully received!</strong>
                </p>
            </div>
            
            <p class="message">
                Thank you for choosing NPS Education for your educational journey. We are excited to have you as part of our learning community.
            </p>
            
            <div class="contact-info">
                <h3 style="color: #2c3e50; margin-bottom: 15px;">📋 What happens next?</h3>
                <ul style="margin-left: 20px; color: #555;">
                    <li style="margin-bottom: 8px;">Our admissions team will review your application</li>
                    <li style="margin-bottom: 8px;">You will receive a call within 24-48 hours</li>
                    <li style="margin-bottom: 8px;">We will discuss course details and next steps</li>
                    <li style="margin-bottom: 8px;">Welcome kit will be provided upon enrollment</li>
                </ul>
            </div>
            
            <p class="message">
                If you have any questions or need immediate assistance, please feel free to contact us.
            </p>
            
            <p style="margin-top: 30px; color: #2c3e50; font-weight: 600;">
                Best Regards,<br>
                <span style="color: #667eea;">The NPS Education Team</span>
            </p>
        ';
        
        return $this->getBaseHTML('Application Received - NPS Education', $content);
    }
    
    /**
     * Admission Alert HTML Template for Admin
     */
    private function getAdmissionAlertHTML($studentData) {
        $content = '
            <h2 class="welcome">🚨 New Student Application</h2>
            
            <div class="highlight-box">
                <p style="margin: 0; font-size: 18px; color: #e74c3c;">
                    ⚡ <strong>Action Required: New admission application received</strong>
                </p>
            </div>
            
            <p class="message">
                A new student has submitted an application. Please review the details below and take appropriate action.
            </p>
            
            <h3 style="color: #2c3e50; margin: 25px 0 15px 0;">👤 Student Information</h3>
            
            <table class="info-table">
                <tr>
                    <td class="label">📝 Full Name:</td>
                    <td><strong>' . htmlspecialchars($studentData['name']) . '</strong></td>
                </tr>
                <tr>
                    <td class="label">📧 Email:</td>
                    <td><a href="mailto:' . htmlspecialchars($studentData['email']) . '" style="color: #667eea;">' . htmlspecialchars($studentData['email']) . '</a></td>
                </tr>
                <tr>
                    <td class="label">📱 Phone:</td>
                    <td><a href="tel:' . htmlspecialchars($studentData['phone']) . '" style="color: #667eea;">' . htmlspecialchars($studentData['phone']) . '</a></td>
                </tr>
                <tr>
                    <td class="label">🎓 Qualification:</td>
                    <td>' . htmlspecialchars($studentData['qualification']) . '</td>
                </tr>
                <tr>
                    <td class="label">🏠 Address:</td>
                    <td>' . htmlspecialchars($studentData['address']) . '</td>
                </tr>
                <tr>
                    <td class="label">📍 District:</td>
                    <td>' . htmlspecialchars($studentData['district']) . '</td>
                </tr>
                <tr>
                    <td class="label">⏰ Applied On:</td>
                    <td>' . date('F j, Y - g:i A') . '</td>
                </tr>
            </table>
            
            <div class="contact-info">
                <h3 style="color: #2c3e50; margin-bottom: 15px;">📋 Next Steps</h3>
                <ul style="margin-left: 20px; color: #555;">
                    <li style="margin-bottom: 8px;">Contact the student within 24 hours</li>
                    <li style="margin-bottom: 8px;">Schedule a counseling session</li>
                    <li style="margin-bottom: 8px;">Update the application status in admin panel</li>
                    <li style="margin-bottom: 8px;">Send course brochure and fee structure</li>
                </ul>
            </div>
            
            <p style="text-align: center; margin: 30px 0;">
                <span class="status-badge">🔔 Immediate Attention Required</span>
            </p>
        ';
        
        return $this->getBaseHTML('New Student Application - NPS Education Admin', $content);
    }
    
    /**
     * Franchise Confirmation HTML Template
     */
    private function getFranchiseConfirmationHTML($applicantName) {
        $content = '
            <h2 class="welcome">Welcome to NPS Education Network! 🤝</h2>
            
            <p class="message">
                Dear <strong>' . htmlspecialchars($applicantName) . '</strong>,
            </p>
            
            <div class="highlight-box">
                <p style="margin: 0; font-size: 18px; color: #27ae60;">
                    ✅ <strong>Your franchise application has been successfully received!</strong>
                </p>
            </div>
            
            <p class="message">
                Thank you for your interest in becoming a franchise partner with NPS Education. We appreciate your trust in our brand and educational methodology.
            </p>
            
            <div class="contact-info">
                <h3 style="color: #2c3e50; margin-bottom: 15px;">🏢 Franchise Process Overview</h3>
                <ul style="margin-left: 20px; color: #555;">
                    <li style="margin-bottom: 8px;">Application review by our franchise team</li>
                    <li style="margin-bottom: 8px;">Initial discussion call within 48 hours</li>
                    <li style="margin-bottom: 8px;">Detailed presentation of franchise model</li>
                    <li style="margin-bottom: 8px;">Site evaluation and business planning</li>
                    <li style="margin-bottom: 8px;">Training and support program setup</li>
                </ul>
            </div>
            
            <div style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 5px; padding: 20px; margin: 20px 0;">
                <h3 style="color: #856404; margin-bottom: 10px;">💼 Investment Opportunities</h3>
                <p style="color: #856404; margin: 0;">Our franchise model offers flexible investment options with comprehensive support. We will discuss the best package suited for your location and budget during our consultation.</p>
            </div>
            
            <p class="message">
                Our franchise development team will contact you shortly to discuss the next steps and answer any questions you may have.
            </p>
            
            <p style="margin-top: 30px; color: #2c3e50; font-weight: 600;">
                Best Regards,<br>
                <span style="color: #667eea;">NPS Education Franchise Team</span>
            </p>
        ';
        
        return $this->getBaseHTML('Franchise Application Received - NPS Education', $content);
    }
    
    /**
     * Franchise Alert HTML Template for Admin
     */
    private function getFranchiseAlertHTML($franchiseData) {
        $content = '
            <h2 class="welcome">🏢 New Franchise Application</h2>
            
            <div class="highlight-box">
                <p style="margin: 0; font-size: 18px; color: #e74c3c;">
                    ⚡ <strong>Franchise Opportunity: New application received</strong>
                </p>
            </div>
            
            <p class="message">
                A new franchise application has been submitted. Please review the applicant details and initiate the franchise process.
            </p>
            
            <h3 style="color: #2c3e50; margin: 25px 0 15px 0;">👤 Applicant Information</h3>
            
            <table class="info-table">
                <tr>
                    <td class="label">📝 Full Name:</td>
                    <td><strong>' . htmlspecialchars($franchiseData['name']) . '</strong></td>
                </tr>
                <tr>
                    <td class="label">📧 Email:</td>
                    <td><a href="mailto:' . htmlspecialchars($franchiseData['email']) . '" style="color: #667eea;">' . htmlspecialchars($franchiseData['email']) . '</a></td>
                </tr>
                <tr>
                    <td class="label">📱 Phone:</td>
                    <td><a href="tel:' . htmlspecialchars($franchiseData['phone']) . '" style="color: #667eea;">' . htmlspecialchars($franchiseData['phone']) . '</a></td>
                </tr>
                <tr>
                    <td class="label">🏠 Address:</td>
                    <td>' . htmlspecialchars($franchiseData['address']) . '</td>
                </tr>
                <tr>
                    <td class="label">📍 District:</td>
                    <td>' . htmlspecialchars($franchiseData['district']) . '</td>
                </tr>
                <tr>
                    <td class="label">🏛️ State:</td>
                    <td>' . htmlspecialchars($franchiseData['state']) . '</td>
                </tr>
                <tr>
                    <td class="label">📮 PIN Code:</td>
                    <td>' . htmlspecialchars($franchiseData['pin']) . '</td>
                </tr>
                <tr>
                    <td class="label">⏰ Applied On:</td>
                    <td>' . date('F j, Y - g:i A') . '</td>
                </tr>
            </table>
            
            <div class="contact-info">
                <h3 style="color: #2c3e50; margin-bottom: 15px;">📋 Franchise Action Plan</h3>
                <ul style="margin-left: 20px; color: #555;">
                    <li style="margin-bottom: 8px;">Contact applicant within 48 hours</li>
                    <li style="margin-bottom: 8px;">Schedule franchise presentation call</li>
                    <li style="margin-bottom: 8px;">Send franchise information package</li>
                    <li style="margin-bottom: 8px;">Conduct location feasibility analysis</li>
                    <li style="margin-bottom: 8px;">Prepare investment proposal</li>
                </ul>
            </div>
            
            <p style="text-align: center; margin: 30px 0;">
                <span class="status-badge">🎯 High Priority Lead</span>
            </p>
        ';
        
        
        return $this->getBaseHTML('New Franchise Application - NPS Education Admin', $content);
    }
    
    // ===========================================
    // PLAIN TEXT TEMPLATES (Fallback)
    // ===========================================
    
    /**
     * Plain text templates for email clients that don't support HTML
     */
    private function getAdmissionConfirmationText($studentName) {
        return "Dear {$studentName},\n\n"
              . "Thank you for applying for the program at NPS Education. "
              . "Our admissions team will contact you shortly.\n\n"
              . "What happens next:\n"
              . "- Our team will review your application\n"
              . "- You will receive a call within 24-48 hours\n"
              . "- We will discuss course details and next steps\n\n"
              . "Best Regards,\n"
              . "NPS Education Team\n"
              . "Malda, West Bengal";
    }
    
    private function getAdmissionAlertText($studentData) {
        return "New Student Application Received\n\n"
              . "Student Details:\n"
              . "Name: {$studentData['name']}\n"
              . "Email: {$studentData['email']}\n"
              . "Phone: {$studentData['phone']}\n"
              . "Qualification: {$studentData['qualification']}\n"
              . "Address: {$studentData['address']}\n"
              . "District: {$studentData['district']}\n"
              . "Applied On: " . date('F j, Y - g:i A') . "\n\n"
              . "Please login to admin panel to view more details and take action.";
    }
    
    private function getFranchiseConfirmationText($applicantName) {
        return "Dear {$applicantName},\n\n"
              . "Thank you for applying for franchise program at NPS Education. "
              . "Our franchise team will contact you shortly.\n\n"
              . "We will discuss the franchise model, investment options, and support system.\n\n"
              . "Best Regards,\n"
              . "NPS Education Franchise Team\n"
              . "Malda, West Bengal";
    }
    
    private function getFranchiseAlertText($franchiseData) {
        return "New Franchise Application Received\n\n"
              . "Applicant Details:\n"
              . "Name: {$franchiseData['name']}\n"
              . "Email: {$franchiseData['email']}\n"
              . "Phone: {$franchiseData['phone']}\n"
              . "Address: {$franchiseData['address']}\n"
              . "District: {$franchiseData['district']}\n"
              . "State: {$franchiseData['state']}\n"
              . "PIN: {$franchiseData['pin']}\n"
              . "Applied On: " . date('F j, Y - g:i A') . "\n\n"
              . "Please contact the applicant and initiate the franchise process.";
    }
}
