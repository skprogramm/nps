<?php
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disclaimer - NPS Education</title>
    <meta name="description" content="Disclaimer for NPS Education - Information about the limitations and responsibilities regarding the use of our services.">
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
            <h1 class="text-4xl font-bold text-[var(--nps-red)] mb-8 text-center">Disclaimer</h1>
            <p class="text-gray-600 text-center mb-12">Last updated: <?php echo date('F j, Y'); ?></p>

            <div class="prose prose-lg max-w-none">
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">1. No Warranties</h2>
                    <p class="mb-4">The information provided by NPS Vision Private Limited ("we," "our," or "us") on our website is for general informational purposes only. All information on the site is provided in good faith; however, we make no representation or warranty of any kind, express or implied, regarding the accuracy, adequacy, validity, reliability, availability, or completeness of any information on the site.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">2. External Links Disclaimer</h2>
                    <p class="mb-4">Our website may contain links to external websites that are not provided or maintained by us. Please note that we do not guarantee the accuracy, relevance, timeliness, or completeness of any information on these external websites.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">3. Professional Advice Disclaimer</h2>
                    <p class="mb-4">The site cannot and does not contain educational or career advice. Any educational information is provided for general informational and educational purposes only and is not a substitute for professional advice.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">4. Limitation of Liability</h2>
                    <p class="mb-4">Under no circumstance shall we have any liability to you for any loss or damage of any kind incurred as a result of the use of the site or reliance on any information provided on the site. Your use of the site and your reliance on any information on the site is solely at your own risk.</p>
                </section>
            </div>

            <div class="text-center mt-12">
                <a href="index.php" class="bg-[var(--nps-green)] hover:bg-[var(--nps-red)] text-white px-6 py-3 rounded-lg transition">
                    Return to Home
                </a>
            </div>
        </div>
    </main>

    <?php include '../components/footer.php'; ?>
</body>
</html>

