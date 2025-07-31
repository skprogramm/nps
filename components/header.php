<?php
/**
 * Header Component
 * Reusable navigation header with mobile menu functionality
 * 
 * @param string $current_page - Current page identifier for active menu highlighting
 * @param array $custom_links - Optional custom navigation links
 */

// Set default current page if not provided
$current_page = $current_page ?? 'home';

// Define navigation links
$nav_links = $custom_links ?? [
    'home' => ['url' => 'index.php#home', 'text' => 'Home'],
    'about' => ['url' => 'index.php#about', 'text' => 'About'],
    'placement' => ['url' => 'index.php#placement', 'text' => 'Placement'],
    'success' => ['url' => 'index.php#success', 'text' => 'Success Stories'],
    'contact' => ['url' => 'index.php#contact', 'text' => 'Contact'],
    'apply' => ['url' => 'admission.php', 'text' => 'Apply For Admission', 'class' => 'apply-now-btn bg-[var(--nps-green)] hover:bg-[var(--nps-red)] text-white px-2 py-2 rounded-lg transition']
];

// Determine logo path based on current directory
$logo_path = (strpos($_SERVER['REQUEST_URI'], '/pages/') !== false) 
    ? '../assets/images/logos/Nps.png' 
    : 'assets/images/logos/Nps.png';
?>

<!-- Navbar -->
<header class="fixed w-full bg-white shadow z-50">
    <nav class="container mx-auto flex items-center justify-between py-2 px-6">
        <div class="flex items-center gap-2">
            <a href="index.php">
                <img src="<?php echo $logo_path; ?>" class="h-12" alt="NPS Education Logo">
            </a>
            <h2 style="font-size: 1.25rem;color:blue">
                <a href="index.php">NPS Education</a>
            </h2>
        </div>
        
        <!-- Desktop Navigation -->
        <ul class="hidden lg:flex space-x-5 font-medium">
            <?php foreach ($nav_links as $key => $link): ?>
                <li>
                    <a href="<?php echo $link['url']; ?>" 
                       class="<?php echo isset($link['class']) ? $link['class'] : ($current_page === $key ? 'text-[var(--nps-red)]' : 'hover:text-[var(--nps-red)]'); ?>">
                        <?php echo $link['text']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        
        <!-- Mobile Menu Button -->
        <button id="menuBtn" class="lg:hidden text-2xl p-2 rounded-md hover:bg-gray-100 transition-colors">
            <i class="fas fa-bars"></i>
        </button>
    </nav>
    
    <!-- Mobile Navigation -->
    <div id="mobileMenu" class="lg:hidden bg-white hidden shadow-lg absolute top-full left-0 right-0 border-t">
        <ul class="flex flex-col p-4 space-y-4 font-medium">
            <?php foreach ($nav_links as $key => $link): ?>
                <li>
                    <a href="<?php echo $link['url']; ?>" 
                       class="block py-2 px-4 rounded-md transition-colors <?php echo isset($link['class']) ? str_replace(['bg-[var(--nps-green)]', 'hover:bg-[var(--nps-red)]'], ['bg-blue-500', 'hover:bg-red-500'], $link['class']) : ($current_page === $key ? 'text-blue-600 bg-blue-50' : 'text-gray-700 hover:text-blue-600 hover:bg-gray-50'); ?>">
                        <?php echo $link['text']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</header>

<!-- Header JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle functionality
    const mobileMenuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const header = document.querySelector('header');

    if (mobileMenuBtn && mobileMenu) {
        // Toggle mobile menu
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            const icon = mobileMenuBtn.querySelector('i');
            if (!mobileMenu.classList.contains('hidden')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });

        // Close mobile menu when clicking on links
        document.querySelectorAll('#mobileMenu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                const icon = mobileMenuBtn.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!header.contains(e.target)) {
                mobileMenu.classList.add('hidden');
                const icon = mobileMenuBtn.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }

    // Header scroll effect
    window.addEventListener('scroll', () => {
        if (header) {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target && header) {
                const headerHeight = header.offsetHeight;
                const targetPosition = target.offsetTop - headerHeight;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>

<!-- Header Styles -->
<style>
/* Header scroll effect styles */
header.scrolled {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
}

/* Mobile menu animation */
#mobileMenu {
    transition: all 0.3s ease-in-out;
}

#mobileMenu:not(.hidden) {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Mobile menu button hover effect */
#menuBtn {
    transition: color 0.3s ease;
}

#menuBtn:hover {
    color: var(--nps-red);
}

/* Logo hover effect */
.nps-brand-text {
    transition: color 0.3s ease;
}

/* Navigation link hover effects */
nav a {
    transition: color 0.3s ease;
    position: relative;
}

nav a:not(.apply-now-btn):hover::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--nps-red);
    transform: scaleX(0);
    animation: expandWidth 0.3s ease forwards;
}

@keyframes expandWidth {
    to {
        transform: scaleX(1);
    }
}

/* Apply Now button enhanced styling */
.apply-now-btn {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transform: translateY(0);
    transition: all 0.3s ease;
}

.apply-now-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    /* Ensure mobile menu is positioned correctly */
    #mobileMenu {
        max-height: calc(100vh - 80px);
        overflow-y: auto;
    }
    
    /* Better spacing for mobile menu items */
    #mobileMenu ul {
        padding: 1.5rem;
    }
    
    #mobileMenu a {
        padding: 0.75rem 1rem;
        font-size: 1rem;
        border-radius: 0.375rem;
    }
}

@media (max-width: 768px) {
    .container {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    
    .nps-brand-text {
        font-size: 1.5rem;
    }
    
    header img {
        height: 2.5rem;
    }
    
    /* Adjust logo and brand text on smaller screens */
    nav h2 {
        font-size: 1rem !important;
    }
    
    header img {
        height: 2rem;
    }
}

@media (max-width: 480px) {
    /* Even smaller screens adjustments */
    nav h2 {
        font-size: 0.9rem !important;
    }
    
    header img {
        height: 1.75rem;
    }
    
    .container {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }
    
    #menuBtn {
        padding: 0.5rem;
        font-size: 1.5rem;
    }
}
</style>
