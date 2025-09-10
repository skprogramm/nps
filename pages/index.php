<?php
// Include database connection if needed here or in separate include
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    
    <title>NPS Education - Skill Development Training Programs | Empowering Youth, Building Futures</title>
    <meta name="description" content="Join NPS Education's government-aligned skill development training programs. Industry-certified courses in IT, Digital Marketing, Hospitality & more. Placement guarantee & career guidance for youth aged 18-30.">
    <meta name="keywords" content="skill development, vocational training, job training, career development, placement guarantee, government certification, NPS Education, youth empowerment, India skill training">
    <meta name="author" content="NPS Vision Private Limited">
    <meta property="og:title" content="NPS Education - Skill Development Training Programs">
    <meta property="og:description" content="Empowering Youth. Building Futures. Join our industry-certified skill development programs with placement guarantee.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://education.npsvision.com">
    <link rel="canonical" href="https://education.npsvision.com">
    
    <!-- Favicon and Icons -->
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico">
    <link rel="manifest" href="../site.webmanifest">
    <meta name="theme-color" content="#d62828">
    <meta name="msapplication-TileColor" content="#d62828">
    

    <!-- Tailwind CSS with Local Priority -->
    <link rel="stylesheet" href="/assets/css/tailwind.css" onerror="this.onerror=null; this.href='https://cdn.tailwindcss.com/';">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

     <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        <!-- Schema.org structured data -->
        <!-- Meta Pixel Code START -->
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
    
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "NPS Education",
        "description": "Skill Development Training Programs for Youth",
        "url": "https://npseducation.com",
        "sameAs": ["https://facebook.com/npseducation", "https://twitter.com/npseducation"],
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "IN"
        },
        "offers": {
            "@type": "Course",
            "name": "Skill Development Training Programs",
            "description": "Industry-certified training in IT, Digital Marketing, Hospitality, and more",
            "provider": {
                "@type": "Organization",
                "name": "NPS Education"
            }
        }
    }
    </script>
    <!-- New modular CSS structure -->
    <!-- <link rel="stylesheet" href="css/base.css"> -->
    <!-- <link rel="stylesheet" href="css/components.css"> -->
    <!-- <link rel="stylesheet" href="css/layouts.css"> -->
    <!-- <link rel="stylesheet" href="css/pages.css"> -->
    <link rel="stylesheet" href="/pages/utilities.css">
    
    <!-- Legacy CSS for backward compatibility -->
    <link rel="stylesheet" href="/pages/style.css">
    
    
</head>
<body> 
    <?php 
    // Set current page for header component
    $current_page = 'home';
    include '../components/header.php'; 
    ?>

    <main>

          <!-- Hero Section -->
        <section id="home" class="hero">
            <div class="container">
                <h1 style='padding-top: 10rem;'>NPS Education</h1>
                <p class="tagline">Empowering Youth. Building Futures.</p>
                <div class="cta-buttons">
                    <a href="admission.php" class = "apply-now-btn bg-[var(--nps-green)] hover:bg-[var(--nps-red)] text-white px-2 py-2 rounded-lg transition">Take Admission</a>
                </div>
                <blockquote style="font-style: italic; font-size: 1.2rem; margin: 5rem 2rem 1rem 1rem;">
                    "Join hands with us to build a skilled and self-reliant India."
                </blockquote>
                <div class="cta-buttons">
                    <a href="franchise.php" class="inline-block bg-[var(--nps-green)] hover:bg-[var(--nps-red)] text-white font-semibold px-2 py-2 rounded-xl transition">Become a partner</a>
                </div>
            </div>
        </section>


        <section id="about" class="about">
            <div class="container">
                <h2 class="section-title">📚 About the Program</h2>
                <div class="about-content">
                    <div class="about-text">
                        <h3>What is the Skill Development Training Program?</h3>
                        <p>The NPS Skill Development Training Program is a government-aligned vocational and technical education initiative aimed at enhancing the employability of youth through industry-relevant skill training. Whether you're a student, job seeker, or aspiring entrepreneur, this program is your gateway to real-world skills and career confidence.</p>
                        <p>We offer short-term certification courses in sectors such as:</p>
                    </div>
                    <div class="skills-grid">
                        <div class="skill-item">
                            <h4>💻 Information Technology (IT)</h4>
                        </div>
                        <div class="skill-item">
                            <h4>🏨 Hospitality & Tourism</h4>
                        </div>
                        <div class="skill-item">
                            <h4>⚡ Electrical & Mechanical</h4>
                        </div>
                        <div class="skill-item">
                            <h4>📱 Digital Marketing</h4>
                        </div>
                        <!-- <div class="skill-item">
                            <h4>🔧 And More...</h4>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>

            <!-- Placement Section -->
        <section id="placement" class="py-20 bg-gray-100" data-aos="fade-up">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-8">Our Recruiters</h2>
                <div class="flex flex-wrap justify-center gap-8 items-center">
                    <img src="../assets/images/apple.png" alt="Apple" class ="h-[80px] transition-transform duration-300 hover:scale-110">
                    <img src="../assets/images/honda.png" alt="Honda" class="h-[80px] transition-transform duration-300 hover:scale-110">
                    <img src="../assets/images/barbeque.png" alt="Barbeque Nation" class ="h-[80px] transition-transform duration-300 hover:scale-110" >
                    <!-- Add more logos -->
                </div>
            </div>
        </section>
        <!-- Program Highlights -->
        <section id="programs" class="highlights">
            <div class="container">
                <h2 class="section-title">🌟 Program Highlights</h2>
                <div class="highlights-grid">
                    <div class="highlight-item fade-in">
                        <div class="icon">🎓</div>
                        <h3>Industry-Certified Training</h3>
                        <p>Get recognized certifications that employers value and trust</p>
                    </div>
                    <div class="highlight-item fade-in">
                        <div class="icon">👨‍🏫</div>
                        <h3>Experienced Trainers & Mentors</h3>
                        <p>Learn from industry experts with real-world experience</p>
                    </div>
                    <div class="highlight-item fade-in">
                        <div class="icon">🛠️</div>
                        <h3>Hands-On Learning & Practical Sessions</h3>
                        <p>Practice what you learn with real projects and assignments</p>
                    </div>
                    <div class="highlight-item fade-in">
                        <div class="icon">💡</div>
                        <h3>Soft Skills & Personality Development</h3>
                        <p>Build confidence and communication skills for career success</p>
                    </div>
                    <div class="highlight-item fade-in">
                        <div class="icon">💼</div>
                        <h3>Placement Guarantee & Career Guidance</h3>
                        <p>Get job placement support and career counseling</p>
                    </div>
                    <div class="highlight-item fade-in">
                        <div class="icon">🏛️</div>
                        <h3>Government-Recognized Certification</h3>
                        <p>Earn certificates recognized by government and industry</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Eligibility Section -->
        <section class="eligibility">
            <div class="container">
                <h2 class="section-title">👩‍🎓 Who Can Apply?</h2>
                <p style="text-align: center; font-size: 1.1rem; margin-bottom: 2rem;">We welcome learners who are:</p>
                <div class="eligibility-list">
                    <div class="eligibility-item fade-in">
                        <div class="icon">📅</div>
                        <div>
                            <h3>Age Requirement</h3>
                            <p>Between 18-30 years of age</p>
                        </div>
                    </div>
                    <div class="eligibility-item fade-in">
                        <div class="icon">📚</div>
                        <div>
                            <h3>Education</h3>
                            <p>Minimum 8th standard pass (varies by course)</p>
                        </div>
                    </div>
                    <div class="eligibility-item fade-in">
                        <div class="icon">🎯</div>
                        <div>
                            <h3>Target Groups</h3>
                            <p>Unemployed youth, school/college dropouts, women, and underprivileged sections</p>
                        </div>
                    </div>
                    <div class="eligibility-item fade-in">
                        <div class="icon">💪</div>
                        <div>
                            <h3>Passion to Learn</h3>
                            <p>Passionate to learn and improve their lives through skill-based work</p>
                        </div>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 2rem; font-size: 1.2rem; color: #2c5aa0;">
                    <strong>No prior experience required. Just your dedication is enough!</strong>
                </div>
            </div>
        </section>

                <!-- Success Stories -->
        <section id="success" class="success-stories">
            <div class="container">
                <h2 class="section-title">📈 Success Stories</h2>
                <div class="testimonials">
                    <div class="testimonial fade-in">
                        <p>I was unemployed for a year. After completing the Digital Marketing course at NPS, I now work as a Social Media Executive in a Kolkata agency!</p>
                        <div class="author">— Sanchita Das, South Dinajpur</div>
                    </div>
                    <div class="testimonial fade-in">
                        <p>Thanks to NPS, I gained paramedical skills and got placed at a reputed clinic in Siliguri. The training was excellent and the placement support was outstanding.</p>
                        <div class="author">— Rahul Mondal</div>
                    </div>
                    <div class="testimonial fade-in">
                        <p>The hospitality training program gave me the confidence and skills I needed. I'm now working at a 5-star hotel in Kolkata and loving every moment of it!</p>
                        <div class="author">— Priya Sharma, Durgapur</div>
                    </div>
                </div>
                <div style="text-align: center; margin-top: 2rem;">
                    <a href="#contact" class="btn btn-primary">Read More Stories</a>
                </div>
            </div>
        </section>


        <!-- Branch Locator Section -->
        <section id="branches" class="py-20 bg-white" data-aos="fade-up">
          <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-6">Our Centres Across India</h2>
            <p class="mb-8 text-gray-600">More branches coming soon in your area.</p>
            
            <!-- Map Embed -->
            <div class="w-full h-96 mb-10 flex justify-center items-center px-4">
              <div class="w-full max-w-3xl h-full">
                <iframe 
                  src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d903.1796520324925!2d87.89769792850086!3d25.11138499860457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjXCsDA2JzQxLjAiTiA4N8KwNTMnNTQuMCJF!5e0!3m2!1sen!2sin!4v1752520491480!5m2!1sen!2sin" 
                  class="w-full h-full rounded-lg border-0 shadow" 
                  allowfullscreen="" 
                  loading="lazy">
                </iframe>
              </div>
            </div>


            <!-- Branch Card Grid -->
            <div class="grid md:grid-cols-3 gap-6">
              <div class="p-6 border rounded-lg shadow-md bg-gray-50">
                <h3 class="text-xl font-semibold text-[var(--nps-green)]">Mathurapur Branch</h3>
                <p class="text-sm text-gray-600 mb-2">Mathurapur School Road,Manikchak, Malda, WB - 732203</p>
                <p class="text-gray-500">Phone: +91 62941 88820</p>
                <span class="inline-block mt-2 bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">Active</span>
              </div>
            
              <!-- Example future branch -->
              <div class="p-6 border rounded-lg shadow-md bg-gray-100 opacity-60">
                <h3 class="text-xl font-semibold text-gray-500">Chanchal Branch</h3>
                <p class="text-sm text-gray-500 mb-2">Coming Soon</p>
                <span class="inline-block mt-2 bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full">Coming Soon</span>
              </div>
            </div>
          </div>
        </section>

                <!-- Contact Section -->
        <section id="contact" class="contact">
            <div class="container">
                <h2 class="section-title" style="color: white;">📞 Contact Us</h2>
                <div class="contact-info">
                    <div class="contact-item fade-in">
                        <div class="icon">🏢</div>
                        <h3>NPS VISION PRIVATE LIMITED</h3>
                        <p>WEBEL IT Park ,Malda</p>
                        <p>Head Office</p>
                    </div>
                    <div class="contact-item fade-in">
                        <div class="icon">📧</div>
                        <h3>Email Us</h3>
                        <p>npseducation45@gmail.com</p>
                        <p>npseducation@npsvision.com</p>
                    </div>
                    <div class="contact-item fade-in">
                        <div class="icon">📞</div>
                        <h3>Call Us</h3>
                        <p> +91- 97359 93004</p>
                        <p> +91- 03512220467</p>
                    </div>
                    <div id="nps"class="contact-item fade-in">
                        <div class="icon">🌐</div>
                        <h3>Visit Website</h3>
                        <p>www.npsvision.com</p>
                        <p>Follow us on social media</p>
                    </div>
                </div>
                
            </div>
        </section>
    


    </main>

    <?php include '../components/footer.php'; ?>

    <!-- AOS Animation Library JavaScript -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS animations
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
        document.getElementById('nps').addEventListener('click',function(){
            window.location.href='https://www.npsvision.com/'
        });
        // Note: Mobile menu functionality is now handled by the header component

        // Enhanced fade-in animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all elements with animation classes
        document.querySelectorAll('.fade-in, .slide-in-left, .slide-in-right').forEach(el => {
            observer.observe(el);
        });
        
        // Separate observer for skill items with fade-up animation
        const skillObserver = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Trigger the fade-up animation
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.skill-item').forEach(el => {
            skillObserver.observe(el);
        });

        // Add dynamic data-aos attributes
        document.addEventListener('DOMContentLoaded', () => {
            // Add AOS attributes to existing elements
            document.querySelectorAll('.highlight-item').forEach((item, index) => {
                item.setAttribute('data-aos', 'fade-up');
                item.setAttribute('data-aos-delay', (index * 100).toString());
            });
            
            document.querySelectorAll('.feature-item').forEach((item, index) => {
                item.setAttribute('data-aos', 'zoom-in');
                item.setAttribute('data-aos-delay', (index * 150).toString());
            });
            
            document.querySelectorAll('.eligibility-item').forEach((item, index) => {
                item.setAttribute('data-aos', 'slide-right');
                item.setAttribute('data-aos-delay', (index * 100).toString());
            });
            
            document.querySelectorAll('.step').forEach((item, index) => {
                item.setAttribute('data-aos', 'flip-left');
                item.setAttribute('data-aos-delay', (index * 200).toString());
            });
            
            document.querySelectorAll('.testimonial').forEach((item, index) => {
                item.setAttribute('data-aos', 'fade-up');
                item.setAttribute('data-aos-delay', (index * 200).toString());
            });
            
            document.querySelectorAll('.contact-item').forEach((item, index) => {
                item.setAttribute('data-aos', 'fade-up');
                item.setAttribute('data-aos-delay', (index * 150).toString());
            });
            
            // Custom fade-up animation for skill items
            document.querySelectorAll('.skill-item').forEach((item, index) => {
                item.classList.add('fade-up');
                item.style.animationDelay = `${index * 100}ms`;
            });
            
            // Refresh AOS after adding attributes
            AOS.refresh();
        });

        // Form submission handling (basic)
        const handleFormSubmission = () => {
            // Add event listeners for any forms that might be added
            document.addEventListener('submit', function(e) {
                if (e.target.tagName === 'FORM') {
                    e.preventDefault();
                    alert('Thank you for your interest! We will contact you soon.');
                }
            });
        };

        handleFormSubmission();

        // Add loading spinner for better UX
        const addLoadingSpinner = () => {
            const style = document.createElement('style');
            style.textContent = `
                .loading-spinner {
                    border: 4px solid #f3f3f3;
                    border-top: 4px solid #2c5aa0;
                    border-radius: 50%;
                    width: 40px;
                    height: 40px;
                    animation: spin 1s linear infinite;
                    margin: 20px auto;
                }
                
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            `;
            document.head.appendChild(style);
        };

        addLoadingSpinner();

        // SEO and Performance optimizations
        const optimizePerformance = () => {
            // Lazy load images when they come into view
            const images = document.querySelectorAll('img[data-src]');
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));

            // Preload critical resources
            const preloadLink = document.createElement('link');
            preloadLink.rel = 'preload';
            preloadLink.href = 'data:font/woff2;base64,'; // Add font preload if needed
            preloadLink.as = 'font';
            preloadLink.type = 'font/woff2';
            preloadLink.crossOrigin = 'anonymous';
        };

        optimizePerformance();

        // Analytics tracking (Google Analytics placeholder)
        const initializeAnalytics = () => {
            // Add Google Analytics or other tracking code here
            // gtag('config', 'GA_MEASUREMENT_ID');
            
            // Track button clicks
            document.querySelectorAll('.btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    // gtag('event', 'click', {
                    //     event_category: 'button',
                    //     event_label: this.textContent
                    // });
                });
            });
        };

        initializeAnalytics();

        // Add schema markup for better SEO
        const addSchemaMarkup = () => {
            const schema = {
                "@context": "https://schema.org",
                "@type": "EducationalOrganization",
                "name": "NPS Education",
                "description": "Skill Development Training Programs for Youth Empowerment",
                "url": "https://npseducation.com",
                "logo": "https://npseducation.com/logo.png",
                "contactPoint": {
                    "@type": "ContactPoint",
                    "telephone": "+91-XXX-XXX-XXXX",
                    "contactType": "Customer Service",
                    "areaServed": "IN"
                },
                "address": {
                    "@type": "PostalAddress",
                    "addressCountry": "IN",
                    "addressRegion": "West Bengal"
                },
                "sameAs": [
                    "https://facebook.com/npseducation",
                    "https://twitter.com/npseducation",
                    "https://linkedin.com/company/npseducation"
                ]
            };
            
            const script = document.createElement('script');
            script.type = 'application/ld+json';
            script.textContent = JSON.stringify(schema);
            document.head.appendChild(script);
        };

        addSchemaMarkup();

        // Add accessibility features
        const enhanceAccessibility = () => {
            // Add skip link
            const skipLink = document.createElement('a');
            skipLink.href = '#main';
            skipLink.className = 'skip-link';
            skipLink.textContent = 'Skip to main content';
            skipLink.style.cssText = `
                position: absolute;
                top: -40px;
                left: 6px;
                background: #2c5aa0;
                color: white;
                padding: 8px;
                text-decoration: none;
                border-radius: 4px;
                z-index: 1001;
                transition: top 0.3s;
            `;
            
            skipLink.addEventListener('focus', () => {
                skipLink.style.top = '6px';
            });
            
            skipLink.addEventListener('blur', () => {
                skipLink.style.top = '-40px';
            });
            
            document.body.insertBefore(skipLink, document.body.firstChild);
            
            // Add main landmark
            const main = document.querySelector('main');
            if (main) {
                main.id = 'main';
            }
        };

        enhanceAccessibility();

        // Add contact form functionality
        const addContactForm = () => {
            const contactSection = document.querySelector('#contact .container');
            
            const formHTML = `
                <div style="margin-top: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                    <p style="font-size:1.5rem;text-align: center; margin-bottom: 1.5rem;color: white;">For Queries Contact Us</p>

                    <form id="contactForm" style="background: rgba(255,255,255,0.1); padding: 2rem; border-radius: 15px; backdrop-filter: blur(10px);">
                        <div style="display: grid; gap: 1rem; color: #333;">
                            <div>
                                <label for="name" style="display: block; margin-bottom: 0.5rem;color: white">Full Name *</label>
                                <input type="text" id="name" name="name" required style="width: 100%; padding: 12px; border: none; border-radius: 8px; font-size: 1rem; color: #333;">
                            </div>
                            <div>
                                <label for="email" style="display: block; margin-bottom: 0.5rem; color: white;">Email *</label>
                                <input type="email" id="email" name="email" required style="width: 100%; padding: 12px; border: none; border-radius: 8px; font-size: 1rem; color: #333;">
                            </div>
                            <div>
                                <label for="phone" style="display: block; margin-bottom: 0.5rem; color: white;">Phone Number *</label>
                                <input type="tel" id="phone" name="phone" required style="width: 100%; padding: 12px; border: none; border-radius: 8px; font-size: 1rem; color: #333;">
                            </div>
                            <div>
                                <label for="address" style="display: block; margin-bottom: 0.5rem; color: white;">Address</label>
                                <textarea id="address" name="address" rows="4" style="width: 100%; padding: 12px; border: none; border-radius: 8px; font-size: 1rem; resize: vertical; color: #333;"></textarea>
                            </div>
                            <div>
                                <label for="message" style="display: block; margin-bottom: 0.5rem; color: white;">Message</label>
                                <textarea id="message" name="message" rows="4" style="width: 100%; padding: 12px; border: none; border-radius: 8px; font-size: 1rem; resize: vertical; color: #333;"></textarea>
                            </div>
                            <button type="submit" style="background: #ff6b6b; color: white; padding: 12px 30px; border: none; border-radius: 50px; font-size: 1rem; font-weight: bold; cursor: pointer; transition: all 0.3s;">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            `;
            
            contactSection.insertAdjacentHTML('beforeend', formHTML);
            
            // Handle form submission
            document.getElementById('contactForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const data = Object.fromEntries(formData);
                
                // Show loading spinner
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.innerHTML = '<div class="loading-spinner"></div>';
                submitBtn.disabled = true;
                
// Send form data to server
                fetch('../contact_handler.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert(result.message);
                        this.reset();
                    } else {
                        alert('Error: ' + (result.errors ? result.errors.join(', ') : result.message));
                    }
                })
                .catch(error => {
                    alert('There was an error submitting your message. Please try again later.');
                    console.error('Error:', error);
                })
                .finally(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                });
            });
        };

        addContactForm();

        // Add search functionality
        const addSearchFunctionality = () => {
            const searchHTML = `
                <div style="position: fixed; top: 20px; right: 20px; z-index: 1002;">
                    <input type="search" id="siteSearch" placeholder="Search..." style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 20px; width: 200px; font-size: 0.9rem;">
                </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', searchHTML);
            
            const searchInput = document.getElementById('siteSearch');
            searchInput.addEventListener('input', function() {
                const query = this.value.toLowerCase();
                const sections = document.querySelectorAll('section');
                
                sections.forEach(section => {
                    const text = section.textContent.toLowerCase();
                    if (query && text.includes(query)) {
                        section.style.backgroundColor = '#fff3cd';
                    } else {
                        section.style.backgroundColor = '';
                    }
                });
            });
        };

        // Initialize search (uncomment to enable)
        // addSearchFunctionality();

        // Add back to top button
        const addBackToTopButton = () => {
            const backToTopHTML = `
                <button id="backToTop" style="position: fixed; bottom: 20px; right: 20px; background: #2c5aa0; color: white; border: none; border-radius: 50%; width: 50px; height: 50px; font-size: 1.2rem; cursor: pointer; opacity: 0; transition: opacity 0.3s; z-index: 1000;">
                    ↑
                </button>
            `;
            
            document.body.insertAdjacentHTML('beforeend', backToTopHTML);
            
            const backToTopBtn = document.getElementById('backToTop');
            
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    backToTopBtn.style.opacity = '1';
                } else {
                    backToTopBtn.style.opacity = '0';
                }
            });
            
            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        };

        addBackToTopButton();

        // Print styles
        const addPrintStyles = () => {
            const printCSS = `
                @media print {
                    * {
                        background: white !important;
                        color: black !important;
                        box-shadow: none !important;
                    }
                    
                    .no-print {
                        display: none !important;
                    }
                    
                    header, footer {
                        display: none !important;
                    }
                    
                    .btn {
                        border: 1px solid #333 !important;
                    }
                    
                    .hero {
                        padding: 2rem 0 !important;
                    }
                    
                    section {
                        page-break-inside: avoid;
                        padding: 1rem 0 !important;
                    }
                }
            `;
            
            const style = document.createElement('style');
            style.textContent = printCSS;
            document.head.appendChild(style);
        };

        addPrintStyles();

        console.log('NPS Education website loaded successfully!');
    </script>
</body>
</html>   
