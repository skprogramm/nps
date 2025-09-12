<?php
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refund Policy - NPS Education</title>
    <meta name="description" content="Refund Policy for NPS Education - Learn about our refund process and conditions for skill development courses.">
    <meta name="robots" content="index, follow">
    
<!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YELNDKM5BZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
    
        gtag('config', 'G-YELNDKM5BZ');
    </script>


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <!-- Tailwind CSS with Local Priority -->
    <link rel="stylesheet" href="/assets/css/tailwind.css" onerror="this.onerror=null; this.href='https://cdn.tailwindcss.com/';">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="/pages/utilities.css">
    <link rel="stylesheet" href="/pages/style.css">
</head>
<body>
    <!-- Navbar -->
    <?php include '../components/header.php'; ?>

    <main class="pt-20">
        <div class="container mx-auto p-6 max-w-4xl">
            <h1 class="text-4xl font-bold text-[var(--nps-red)] mb-8 text-center">Refund Policy</h1>
            <p class="text-gray-600 text-center mb-12">Last updated: <?php echo date('F j, Y'); ?></p>

            <div class="prose prose-lg max-w-none">
                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">1. Introduction</h2>
                    <p class="mb-4">This Refund Policy applies to the fee payment for courses offered by NPS Vision Private Limited ("we," "our," or "us") through the NPS Education website and services.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">2. Eligibility for Refunds</h2>
                    <p class="mb-4">Refunds are considered under the following circumstances:</p>
                    <ul class="list-disc pl-6 mb-4">
                        <li>Course cancellation by the institution.</li>
                        <li>Withdrawal from the course before commencement.</li>
                        <li>Course not conducted as per the schedule provided at the time of enrollment.</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">3. Non-Refundable Conditions</h2>
                    <p class="mb-4">No refund will be provided under the following conditions:</p>
                    <ul class="list-disc pl-6 mb-4">
                        <li>Withdrawal from the course after commencement.</li>
                        <li>Lack of participation or completion by the student.</li>
                        <li>Violation of the Terms of Service.</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">4. Refund Process</h2>
                    <p class="mb-4">To request a refund, please contact our support team at <strong>npseducation45@gmail.com</strong>. Include your registration details and the reason for the refund request.</p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-semibold text-[var(--nps-green)] mb-4">5. Changes to Refund Policy</h2>
                    <p class="mb-4">We may update this Refund Policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last updated" date.</p>
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
