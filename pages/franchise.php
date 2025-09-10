<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../config/mail.php';

// Initialize mailer (credentials loaded from .env file)
$mailer = new NPSMailer();

// === Handle POST submission ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Honeypot anti‑spam: invisible field must stay empty
    if (!empty($_POST['website'])) {
        die('Spam detected');
    }

    // Sanitization & Validation
    $name         = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $email        = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $phone        = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING));
    $address      = trim(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING));
    $district     = trim(filter_input(INPUT_POST, 'district', FILTER_SANITIZE_STRING));
    $state        = trim(filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING));
    $pin          = trim(filter_input(INPUT_POST, 'pin', FILTER_SANITIZE_STRING));
    $errors = [];
    if (!$name)                                    $errors[] = 'Name is required';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))$errors[] = 'Valid email required';
    if (!preg_match('/^[0-9]{10}$/', $phone))      $errors[] = 'Valid 10-digit phone required';
    if (!preg_match('/^[0-9]{6}$/', $pin))      $errors[] = 'Valid 6-digit pin code required';
    if (!$address)                                  $errors[] = 'Please enter your address';

    if (empty($errors)) {
        // === Save to database ===
        $stmt = $conn->prepare("INSERT INTO franchises (name, email, phone, address, district, state, pin) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssss', $name, $email, $phone, $address, $district, $state, $pin);
        if ($stmt->execute()) {
            // === Send emails using NPSMailer ===
            $franchiseData = [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'district' => $district,
                'state' => $state,
                'pin' => $pin
            ];
            
            // Send confirmation to franchisee
            $mailer->sendFranchiseConfirmation($email, $name);
            
            // Send alert to admin
            $mailer->sendFranchiseAlert($franchiseData);

            $success = true;
        } else {
            $errors[] = 'Database error. Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Franchise Form | NPS Education</title>
    
    <!-- Favicon and Icons -->
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
    <link rel="manifest" href="../site.webmanifest">
    <meta name="theme-color" content="#667eea">

    <link rel="stylesheet" href="/pages/utilities.css">
    <link rel="stylesheet" href="/pages/style.css">

    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '24083382334645039');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=24083382334645039&ev=PageView&noscript=1"/>
    </noscript>

    <!-- Tailwind CSS with Local Priority -->
    <link rel="stylesheet" href="/assets/css/tailwind.css" onerror="this.onerror=null; this.href='https://cdn.tailwindcss.com/';">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .form-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 120vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        .input-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            z-index: 1;
        }
        .input-field {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }
        .input-field:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }
        .submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        .submit-btn:active {
            transform: translateY(0);
        }
        .loading {
            pointer-events: none;
            opacity: 0.7;
        }
        .success-message {
            background: linear-gradient(135deg, #4ade80 0%, #22c55e 100%);
            color: white;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            text-align: center;
            animation: slideIn 0.5s ease;
        }
        .error-message {
            background: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
            color: white;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .home-btn {
            position: absolute;
            top: 2rem;
            left: 2rem;
            background: rgba(255, 255, 255, 0.9);
            color: #667eea;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        .home-btn:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <?php 
    // Set current page for header component
    // $current_page = 'apply';
    include '../components/header.php'; 
    ?>
    <div class="form-container">
        <div class="form-card w-full max-w-2xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-xl text-gray-800 mb-2">Become a partner of NPS Education</h1>
                <p class="text-gray-600">Start Your Journey Towards Success</p>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="error-message">
                    <ul class="list-disc list-inside text-sm">
                        <?php foreach ($errors as $e): ?>
                            <li><?= htmlspecialchars($e) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php elseif (!empty($success)): ?>
                <div class="success-message">
                    <i class="fas fa-check-circle mr-2"></i>
                    Your application has been submitted successfully! Check your email for confirmation.
                </div>
            <?php endif; ?>

            <form action="" method="POST" id="franchiseForm">
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="Full Name" required class="input-field" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                    </div>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email Address" required class="input-field" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    </div>
                </div>
                
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="input-group">
                        <i class="fas fa-phone"></i>
                        <input type="tel" name="phone" placeholder="Phone (10 digits)" required pattern="[0-9]{10}" class="input-field" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                    </div>
                    <div class="input-group">
                        <i class="fas fa-map-marker-alt"></i>
                        <select name="state" class="input-field" required>
                            <option value="">Select State</option>
                            <option value="Andhra Pradesh" <?= ($_POST['state'] ?? '') === 'Andhra Pradesh' ? 'selected' : '' ?>>Andhra Pradesh</option>
                            <option value="Arunachal Pradesh" <?= ($_POST['state'] ?? '') === 'Arunachal Pradesh' ? 'selected' : '' ?>>Arunachal Pradesh</option>
                            <option value="Assam" <?= ($_POST['state'] ?? '') === 'Assam' ? 'selected' : '' ?>>Assam</option>
                            <option value="Bihar" <?= ($_POST['state'] ?? '') === 'Bihar' ? 'selected' : '' ?>>Bihar</option>
                            <option value="Chhattisgarh" <?= ($_POST['state'] ?? '') === 'Chhattisgarh' ? 'selected' : '' ?>>Chhattisgarh</option>
                            <option value="Goa" <?= ($_POST['state'] ?? '') === 'Goa' ? 'selected' : '' ?>>Goa</option>
                            <option value="Gujarat" <?= ($_POST['state'] ?? '') === 'Gujarat' ? 'selected' : '' ?>>Gujarat</option>
                            <option value="Haryana" <?= ($_POST['state'] ?? '') === 'Haryana' ? 'selected' : '' ?>>Haryana</option>
                            <option value="Himachal Pradesh" <?= ($_POST['state'] ?? '') === 'Himachal Pradesh' ? 'selected' : '' ?>>Himachal Pradesh</option>
                            <option value="Jharkhand" <?= ($_POST['state'] ?? '') === 'Jharkhand' ? 'selected' : '' ?>>Jharkhand</option>
                            <option value="Karnataka" <?= ($_POST['state'] ?? '') === 'Karnataka' ? 'selected' : '' ?>>Karnataka</option>
                            <option value="Kerala" <?= ($_POST['state'] ?? '') === 'Kerala' ? 'selected' : '' ?>>Kerala</option>
                            <option value="Madhya Pradesh" <?= ($_POST['state'] ?? '') === 'Madhya Pradesh' ? 'selected' : '' ?>>Madhya Pradesh</option>
                            <option value="Maharashtra" <?= ($_POST['state'] ?? '') === 'Maharashtra' ? 'selected' : '' ?>>Maharashtra</option>
                            <option value="Manipur" <?= ($_POST['state'] ?? '') === 'Manipur' ? 'selected' : '' ?>>Manipur</option>
                            <option value="Meghalaya" <?= ($_POST['state'] ?? '') === 'Meghalaya' ? 'selected' : '' ?>>Meghalaya</option>
                            <option value="Mizoram" <?= ($_POST['state'] ?? '') === 'Mizoram' ? 'selected' : '' ?>>Mizoram</option>
                            <option value="Nagaland" <?= ($_POST['state'] ?? '') === 'Nagaland' ? 'selected' : '' ?>>Nagaland</option>
                            <option value="Odisha" <?= ($_POST['state'] ?? '') === 'Odisha' ? 'selected' : '' ?>>Odisha</option>
                            <option value="Punjab" <?= ($_POST['state'] ?? '') === 'Punjab' ? 'selected' : '' ?>>Punjab</option>
                            <option value="Rajasthan" <?= ($_POST['state'] ?? '') === 'Rajasthan' ? 'selected' : '' ?>>Rajasthan</option>
                            <option value="Sikkim" <?= ($_POST['state'] ?? '') === 'Sikkim' ? 'selected' : '' ?>>Sikkim</option>
                            <option value="Tamil Nadu" <?= ($_POST['state'] ?? '') === 'Tamil Nadu' ? 'selected' : '' ?>>Tamil Nadu</option>
                            <option value="Telangana" <?= ($_POST['state'] ?? '') === 'Telangana' ? 'selected' : '' ?>>Telangana</option>
                            <option value="Tripura" <?= ($_POST['state'] ?? '') === 'Tripura' ? 'selected' : '' ?>>Tripura</option>
                            <option value="Uttar Pradesh" <?= ($_POST['state'] ?? '') === 'Uttar Pradesh' ? 'selected' : '' ?>>Uttar Pradesh</option>
                            <option value="Uttarakhand" <?= ($_POST['state'] ?? '') === 'Uttarakhand' ? 'selected' : '' ?>>Uttarakhand</option>
                            <option value="West Bengal" <?= ($_POST['state'] ?? '') === 'West Bengal' ? 'selected' : '' ?>>West Bengal</option>
                            <option value="Andaman and Nicobar Islands" <?= ($_POST['state'] ?? '') === 'Andaman and Nicobar Islands' ? 'selected' : '' ?>>Andaman and Nicobar Islands</option>
                            <option value="Chandigarh" <?= ($_POST['state'] ?? '') === 'Chandigarh' ? 'selected' : '' ?>>Chandigarh</option>
                            <option value="Dadra and Nagar Haveli and Daman and Diu" <?= ($_POST['state'] ?? '') === 'Dadra and Nagar Haveli and Daman and Diu' ? 'selected' : '' ?>>Dadra and Nagar Haveli and Daman and Diu</option>
                            <option value="Delhi" <?= ($_POST['state'] ?? '') === 'Delhi' ? 'selected' : '' ?>>Delhi</option>
                            <option value="Jammu and Kashmir" <?= ($_POST['state'] ?? '') === 'Jammu and Kashmir' ? 'selected' : '' ?>>Jammu and Kashmir</option>
                            <option value="Ladakh" <?= ($_POST['state'] ?? '') === 'Ladakh' ? 'selected' : '' ?>>Ladakh</option>
                            <option value="Lakshadweep" <?= ($_POST['state'] ?? '') === 'Lakshadweep' ? 'selected' : '' ?>>Lakshadweep</option>
                            <option value="Puducherry" <?= ($_POST['state'] ?? '') === 'Puducherry' ? 'selected' : '' ?>>Puducherry</option>
                        </select>
                    </div>
                </div>
                
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="input-group">
                        <i class="fas fa-building"></i>
                        <input type="text" name="district" placeholder="District" class="input-field" value="<?= htmlspecialchars($_POST['district'] ?? '') ?>">
                    </div>
                    <div class="input-group">
                        <i class="fas fa-home"></i>
                        <input type="number" name="pin" placeholder="Pin Code" required class="input-field"value="<?= htmlspecialchars($_POST['pin'] ?? '') ?>">
                        
                    </div>
                </div>
                <div class="grid gap-4">
                    <div class="input-group">
                        <i class="fas fa-home"></i>
                        <textarea name="address" placeholder="Complete Address" required class="input-field" rows="3" style="resize: vertical; padding-top: 1rem;"><?= htmlspecialchars($_POST['address'] ?? '') ?></textarea>
                    </div>                    
                </div>


                <!-- Honeypot field (invisible) -->
                <input type="text" name="website" style="display:none">
                
                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Submit Request
                </button>
            </form>
        </div>
    </div>
    <?php include '../components/footer.php'; ?>
    
    <script>
        document.getElementById('franchiseForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Submitting...';
        });
        
        // Add real-time validation
        const phoneInput = document.querySelector('input[name="phone"]');
        phoneInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });
        
        // Add floating label effect
        document.querySelectorAll('.input-field').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
        
        // Form validation
        document.querySelectorAll('.input-field').forEach(input => {
            input.addEventListener('blur', function() {
                if (this.hasAttribute('required') && !this.value.trim()) {
                    this.style.borderColor = '#ef4444';
                } else {
                    this.style.borderColor = '#e2e8f0';
                }
            });
        });
        
        // Success animation
        const successMessage = document.querySelector('.success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    successMessage.style.transform = 'scale(1)';
                }, 200);
            }, 500);
        }
    </script>
</body>
</html>
