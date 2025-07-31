<?php
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service - NPS Education</title>
    <meta name="description" content="Terms of Service for NPS Education - Understand the rules and guidelines for using our educational services.">
    <meta name="robots" content="index, follow">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    
        <!-- Tailwind CSS CDN with local fallback -->
    <script src="https://cdn.tailwindcss.com" 
            onerror="document.head.innerHTML += '<link rel=\'stylesheet\' href=\'../assets/css/tailwind.css\'>';"
            onload="console.log('CDN loaded successfully');"></script>
    
    <!-- Additional fallback script -->
    <script>
        // Double-check if Tailwind is working after page load
        window.addEventListener('load', function() {
            setTimeout(function() {
                var testElement = document.createElement('div');
                testElement.className = 'hidden';
                document.body.appendChild(testElement);
                
                var computedStyle = window.getComputedStyle(testElement);
                var tailwindWorking = computedStyle.display === 'none';
                
                document.body.removeChild(testElement);
                
                if (!tailwindWorking) {
                    // If CDN didn't work, load local CSS
                    var localLink = document.createElement('link');
                    localLink.rel = 'stylesheet';
                    localLink.href = '../assets/css/tailwind.css';
                    localLink.onload = function() {
                        console.log('Local Tailwind CSS loaded as fallback');
                    };
                    document.head.appendChild(localLink);
                }
            }, 100);
        });
    </script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/components.css">
    <link rel="stylesheet" href="css/layouts.css">
    <link rel="stylesheet" href="css/pages.css">
    <link rel="stylesheet" href="css/utilities.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Navbar -->
    <?php include '../components/header.php'; ?>

    <main class="pt-20">
        <div class="container mx-auto px-6 py-12 max-w-4xl">
            <h1 class="text-4xl font-bold text-[var(--nps-red)] mb-8 text-center">Terms of Service</h1>
            <p class="text-gray-600 text-center mb-12">Last updated: <?php echo date('F j, Y'); ?></p>

            <div class="prose prose-lg max-w-none">
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">1. Acceptance of Terms</h2>
                    <p class="mb-4">By accessing or using the website and services provided by NPS Vision Private Limited ("we," "our," or "us"), you agree to comply with and be bound by these Terms of Service. If you do not agree to these terms, please do not use our website or services.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">2. Use of Services</h2>
                    <p class="mb-4">You may use our services for lawful purposes only. You agree not to use our services in any way that violates any applicable law, regulation, or these Terms of Service.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">3. User Accounts</h2>
                    <p class="mb-4">To access certain features of our services, you may be required to create an account. You agree to provide accurate and up-to-date information for your account and to keep your login credentials secure.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">4. Payment and Fees</h2>
                    <p class="mb-4">Some services may require payment of fees. All fees are non-refundable except as required by law. We reserve the right to change our fees at any time.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">5. Intellectual Property</h2>
                    <p class="mb-4">All content on our website, including text, graphics, logos, and images, is the property of NPS Vision Private Limited and is protected by copyright and other intellectual property laws.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">6. Termination</h2>
                    <p class="mb-4">We may terminate or suspend your access to our services at any time, without notice or liability, for any reason, including if you breach these Terms of Service.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">7. Disclaimer of Warranties</h2>
                    <p class="mb-4">Our services are provided "as is" and "as available" without any warranties of any kind, either express or implied.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">8. Limitation of Liability</h2>
                    <p class="mb-4">In no event shall NPS Vision Private Limited be liable for any direct, indirect, incidental, special, consequential or punitive damages arising out of or in connection with your use of our services.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">9. Changes to Terms</h2>
                    <p class="mb-4">We may update these Terms of Service from time to time. We will notify you of any changes by posting the new Terms of Service on this page and updating the "Last updated" date.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">10. Governing Law</h2>
                    <p class="mb-4">These Terms of Service shall be governed by and construed in accordance with the laws of India, without regard to its conflict of law principles.</p>
                </section>
            </div>

            <div class="text-center mt-12">
                <a href="index.php" class="bg-[var(--nps-green)] hover:bg-[var(--nps-red)] text-white px-6 py-3 rounded-lg transition">
                    Return to Home
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../components/footer.php'; ?>
</body>
</html>
