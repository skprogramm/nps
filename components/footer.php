<?php
// common-footer.php
?>

<footer style="background: linear-gradient(to right, #1f2937, #374151, #1f2937); color: white; position: relative; overflow: hidden;">
    <!-- Background Pattern -->
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; opacity: 0.1;">
        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(to bottom right, var(--nps-green), transparent, var(--nps-red));"></div>
    </div>
    
    <div style="position: relative; z-index: 10;">
        <!-- Main Footer Content -->
        <div style="max-width: 1200px; margin: 0 auto; padding: 3rem 1.5rem;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                
                <!-- Company Info -->
                <div class="lg:col-span-1">
                    <div class="flex items-center space-x-3 mb-6">
                        <img src="../assets/images/logos/Nps.png" alt="NPS Education Logo" class="h-12 w-auto">
                        <div>
                            <h3 class="text-xl font-bold text-white">NPS Education</h3>
                            <p class="text-sm text-gray-300">Empowering Youth</p>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Building skilled professionals through government-aligned training programs. Join us in creating a self-reliant India.
                    </p>
                    
                    <!-- Social Media Links -->
                    <div class="flex space-x-4">
                        <a href="#" class="bg-gray-700 hover:bg-[var(--nps-red)] p-2 rounded-full transition-colors duration-300">
                            <i class="fab fa-facebook-f text-lg"></i>
                        </a>
                        <a href="#" class="bg-gray-700 hover:bg-[var(--nps-red)] p-2 rounded-full transition-colors duration-300">
                            <i class="fab fa-twitter text-lg"></i>
                        </a>
                        <a href="#" class="bg-gray-700 hover:bg-[var(--nps-red)] p-2 rounded-full transition-colors duration-300">
                            <i class="fab fa-linkedin-in text-lg"></i>
                        </a>
                        <a href="#" class="bg-gray-700 hover:bg-[var(--nps-red)] p-2 rounded-full transition-colors duration-300">
                            <i class="fab fa-youtube text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 text-white border-b border-gray-600 pb-2">
                        <i class="fas fa-link mr-2 text-[var(--nps-green)]"></i>
                        Quick Links
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="index.php#home" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Home</a></li>
                        <li><a href="index.php#about" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>About Program</a></li>
                        <li><a href="index.php#placement" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Placement</a></li>
                        <li><a href="index.php#success" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Success Stories</a></li>
                        <li><a href="admission.php" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Apply Now</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 text-white border-b border-gray-600 pb-2">
                        <i class="fas fa-headset mr-2 text-[var(--nps-green)]"></i>
                        Support
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="index.php#contact" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Contact Us</a></li>
                        <li><a href="index.php#branches" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Find Center</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Help & FAQ</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Student Portal</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Download Brochure</a></li>
                    </ul>
                </div>

                <!-- Legal & Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 text-white border-b border-gray-600 pb-2">
                        <i class="fas fa-gavel mr-2 text-[var(--nps-green)]"></i>
                        Legal & Contact
                    </h3>
                    <ul class="space-y-3 mb-6">
                        <li><a href="privacy-policy.php" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Privacy Policy</a></li>
                        <li><a href="terms-of-service.php" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Terms of Service</a></li>
                        <li><a href="refund-policy.php" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Refund Policy</a></li>
                        <li><a href="disclaimer.php" class="text-gray-300 hover:text-[var(--nps-green)] transition-colors duration-300 flex items-center"><i class="fas fa-chevron-right mr-2 text-xs"></i>Disclaimer</a></li>
                    </ul>
                    
                    <!-- Contact Info -->
                    <div class="space-y-2">
                        <div class="flex items-center text-gray-300">
                            <i class="fas fa-phone mr-3 text-[var(--nps-green)]"></i>
                            <span class="text-sm">+91-97359 93004</span>
                        </div>
                        <div class="flex items-center text-gray-300">
                            <i class="fas fa-envelope mr-3 text-[var(--nps-green)]"></i>
                            <span class="text-sm">npseducation45@gmail.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter Section -->
        <div class="border-t border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col lg:flex-row items-center justify-between space-y-4 lg:space-y-0">
                    <div class="text-center lg:text-left">
                        <h4 class="text-lg font-semibold text-white mb-2">Stay Updated with NPS Education</h4>
                        <p class="text-gray-300 text-sm">Get the latest updates on courses, placements, and success stories.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-2">
                        <input type="email" placeholder="Enter your email" class="px-4 py-2 bg-gray-700 text-white rounded-lg border border-gray-600 focus:border-[var(--nps-green)] focus:outline-none transition-colors duration-300 w-full sm:w-auto">
                        <button class="px-6 py-2 bg-gradient-to-r from-[var(--nps-green)] to-[var(--nps-red)] text-white rounded-lg hover:from-[var(--nps-red)] hover:to-[var(--nps-green)] transition-all duration-300 transform hover:scale-105 whitespace-nowrap">
                            <i class="fas fa-paper-plane mr-2"></i>Subscribe
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-gray-700 bg-gray-900/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                    <div class="text-center md:text-left">
                        <p class="text-gray-400 text-sm">
                            &copy; <?php echo date('Y'); ?> NPS Vision Private Limited. All rights reserved.
                        </p>
                        <p class="text-gray-500 text-xs mt-1">
                            Empowering Youth, Building Futures | Skill Development Division
                        </p>
                    </div>
                    
                    <div class="flex items-center space-x-6 text-gray-400 text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-[var(--nps-green)]"></i>
                            <span>Malda, West Bengal</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-certificate mr-2 text-[var(--nps-green)]"></i>
                            <span>Govt. Certified</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
