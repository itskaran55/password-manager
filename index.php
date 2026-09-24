<?php
// Enable error display during setup so you can see any exact missing file
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Session Init
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentSection = isset($_GET['page']) ? htmlspecialchars(stripslashes(trim($_GET['page']))) : 'home';

// If already logged in and visiting login page, redirect to dashboard
if ($currentSection === 'login' && !empty($_SESSION['user_id'])) {
    $redirectTarget = (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') ? 'admin/dashboard.php' : 'dashboard.php';
    header("Location: {$redirectTarget}");
    exit;
}

$pageTitle = "Enterprise Password Manager | Social Amplifiers";
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $pageTitle; ?></title>

    <!-- 1. Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Social Amplifiers Clean Beige & Off-White Palette
                        sa: {
                            bg: '#FBF9F5',         // Primary canvas
                            card: '#F3EFEA',       // Subtle section cards
                            border: '#E6DFD5',     // Soft borders
                            hover: '#EDE6DC',      // Card hover state
                        },
                        // Agency Pastel Accents
                        accent: {
                            sage: '#8FA89B',       // Security / Verified badge
                            'sage-dark': '#5A7567',
                            lavender: '#9B96C7',   // Admin & Encryption highlight
                            'lavender-dark': '#6C66A3',
                            coral: '#E89888',       // Action buttons & alerts
                            'coral-dark': '#C96E5D',
                            sand: '#D8C7B5',       // Secondary muted tags
                        },
                        // High-contrast slate typography
                        charcoal: {
                            900: '#1A1D20',        // Main headings
                            700: '#3D444B',        // Body text
                            500: '#6C757D',        // Muted labels
                            400: '#9EA8B3',        // Borders & subtle placeholders
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace']
                    },
                    boxShadow: {
                        'sa-soft': '0 10px 30px -5px rgba(61, 68, 75, 0.06)',
                        'sa-card': '0 15px 35px -5px rgba(61, 68, 75, 0.08)',
                        'sa-glow': '0 0 25px rgba(155, 150, 199, 0.25)',
                    }
                }
            }
        }
    </script>

    <!-- 2. Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

    <!-- 3. AOS CSS CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

    <!-- 4. Remix Icon & FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FBF9F5;
            color: #1A1D20;
            overflow-x: hidden;
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #FBF9F5;
        }
        ::-webkit-scrollbar-thumb {
            background: #D8C7B5;
            border-radius: 9999px;
            border: 2px solid #FBF9F5;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #BFAEA0;
        }
    </style>
</head>
<body class="bg-sa-bg text-charcoal-900 min-h-screen flex flex-col justify-between selection:bg-accent-coral/20 selection:text-charcoal-900">

    <!-- Global Header -->
    <?php
    $navPath = __DIR__ . '/includes/layout/navbar.php';
    if (file_exists($navPath)) {
        include_once $navPath;
    }
    ?>

    <!-- Main Content Wrapper -->
    <main id="main-content" class="flex-grow w-full">
        <?php
        if ($currentSection === 'home') {
            $homeSections = [
                __DIR__ . '/includes/hero.php',
                __DIR__ . '/includes/about.php',
                __DIR__ . '/includes/features.php',
                __DIR__ . '/includes/security.php'
            ];

            foreach ($homeSections as $sectionFile) {
                if (file_exists($sectionFile)) {
                    include_once $sectionFile;
                }
            }
        } else {
            $customPage = __DIR__ . "/includes/{$currentSection}.php";
            if (file_exists($customPage)) {
                include_once $customPage;
            } else {
                echo '<div class="min-h-[60vh] flex flex-col items-center justify-center text-center px-4">';
                echo '<h1 class="text-4xl font-bold text-accent-lavender-dark mb-2">404</h1>';
                echo '<p class="text-charcoal-500">Section not found in includes directory.</p>';
                echo '</div>';
            }
        }
        ?>
    </main>

    <!-- Global Footer -->
    <?php
    $footerPath = __DIR__ . '/includes/layout/footer.php';
    if (file_exists($footerPath)) {
        include_once $footerPath;
    }
    ?>

    <!-- JAVASCRIPT CDNs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                mirror: false
            });

            gsap.registerPlugin(ScrollTrigger);

            gsap.from("#main-content", {
                opacity: 0,
                y: 12,
                duration: 0.7,
                ease: "power2.out"
            });
        });
    </script>
</body>
</html>