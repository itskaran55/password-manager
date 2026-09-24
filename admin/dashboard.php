<?php
require_once __DIR__ . '/../config/security.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Auth.php';

Auth::validateActiveSession();

if (($_SESSION['user_role'] ?? '') !== 'admin') {
    header("Location: ../dashboard.php");
    exit;
}

$pdo = Database::getConnection();

// Fetch summary metrics
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$activeUsers = $pdo->query("SELECT COUNT(*) FROM users WHERE is_active = 1")->fetchColumn();
$totalPasswords = $pdo->query("SELECT COUNT(*) FROM passwords")->fetchColumn();

$userName = $_SESSION['user_name'] ?? 'Admin';
$pageTitle = "Admin Control Hub | Social Amplifiers";
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle; ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sa: { bg: '#FBF9F5', card: '#F3EFEA', border: '#E6DFD5', hover: '#EDE6DC' },
                        accent: {
                            sage: '#8FA89B', 'sage-dark': '#5A7567',
                            lavender: '#9B96C7', 'lavender-dark': '#6C66A3',
                            coral: '#E89888', 'coral-dark': '#C96E5D', sand: '#D8C7B5'
                        },
                        charcoal: { 900: '#1A1D20', 700: '#3D444B', 500: '#6C757D', 400: '#9EA8B3' }
                    },
                    fontFamily: { sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'], mono: ['JetBrains Mono', 'monospace'] },
                    boxShadow: { 'sa-soft': '0 10px 30px -5px rgba(61, 68, 75, 0.06)', 'sa-card': '0 15px 35px -5px rgba(61, 68, 75, 0.08)' }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FBF9F5; color: #1A1D20; }</style>
</head>
<body class="bg-sa-bg min-h-screen flex flex-col justify-between selection:bg-accent-lavender/20">

    <!-- Top Admin Bar -->
    <header class="sticky top-0 z-40 w-full backdrop-blur-md bg-sa-bg/85 border-b border-sa-border shadow-sa-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-20">
            <a href="../index.php" class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-accent-sage via-accent-lavender to-accent-coral p-0.5 shadow-sm">
                    <div class="w-full h-full bg-sa-bg rounded-[14px] flex items-center justify-center">
                        <i class="ri-dashboard-fill text-accent-lavender-dark text-xl"></i>
                    </div>
                </div>
                <div>
                    <span class="text-lg font-bold tracking-tight text-charcoal-900 flex items-center gap-2">
                        PassVault Admin
                        <span class="text-[10px] tracking-wider px-2 py-0.5 rounded-full bg-accent-lavender/20 text-accent-lavender-dark font-bold">CONTROL</span>
                    </span>
                    <span class="text-[11px] text-charcoal-500 font-medium">Social Amplifiers Governance</span>
                </div>
            </a>

            <div class="flex items-center gap-3">
                <a href="../dashboard.php" class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-2xl bg-sa-card border border-sa-border text-charcoal-900 hover:bg-sa-hover transition-colors">
                    <i class="ri-lock-line text-accent-sage-dark"></i> User Vault View
                </a>
                <a href="../logout.php" class="p-2 text-charcoal-500 hover:text-accent-coral-dark rounded-xl transition-colors">
                    <i class="ri-logout-box-r-line text-lg"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 w-full">
        
        <div class="pb-8 mb-8 border-b border-sa-border">
            <span class="text-xs font-mono uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-accent-sage/20 text-accent-sage-dark font-bold border border-accent-sage/30">
                HOSTINGER SUBFOLDER NODE ACTIVE
            </span>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-charcoal-900 tracking-tight mt-2">
                Executive Security Overview
            </h1>
            <p class="text-xs sm:text-sm text-charcoal-500 mt-1">
                Real-time metrics for encrypted credentials, registered team accounts, and role permissions.
            </p>
        </div>

        <!-- 3 KPI Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
            
            <div class="p-6 rounded-3xl bg-sa-card border border-sa-border shadow-sa-soft">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-charcoal-500 uppercase tracking-wider">Total Vault Records</span>
                    <div class="w-9 h-9 rounded-xl bg-accent-lavender/20 text-accent-lavender-dark flex items-center justify-center text-lg">
                        <i class="ri-lock-password-line"></i>
                    </div>
                </div>
                <div class="text-3xl font-extrabold text-charcoal-900 mt-3"><?= (int)$totalPasswords; ?></div>
                <div class="text-[11px] text-charcoal-500 mt-1 font-mono">AES-256 Encrypted</div>
            </div>

            <div class="p-6 rounded-3xl bg-sa-card border border-sa-border shadow-sa-soft">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-charcoal-500 uppercase tracking-wider">Active Team Accounts</span>
                    <div class="w-9 h-9 rounded-xl bg-accent-sage/20 text-accent-sage-dark flex items-center justify-center text-lg">
                        <i class="ri-user-follow-line"></i>
                    </div>
                </div>
                <div class="text-3xl font-extrabold text-accent-sage-dark mt-3"><?= (int)$activeUsers; ?> / <?= (int)$totalUsers; ?></div>
                <div class="text-[11px] text-charcoal-500 mt-1 font-mono">isActive = 1 Validated</div>
            </div>

            <div class="p-6 rounded-3xl bg-sa-card border border-sa-border shadow-sa-soft">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-charcoal-500 uppercase tracking-wider">Security Architecture</span>
                    <div class="w-9 h-9 rounded-xl bg-accent-coral/20 text-accent-coral-dark flex items-center justify-center text-lg">
                        <i class="ri-shield-check-line"></i>
                    </div>
                </div>
                <div class="text-3xl font-extrabold text-charcoal-900 mt-3">100%</div>
                <div class="text-[11px] text-charcoal-500 mt-1 font-mono">Zero Plaintext in MySQL</div>
            </div>

        </div>

        <!-- Quick Governance Hub -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <a href="users.php" class="p-7 rounded-3xl bg-sa-card border border-sa-border shadow-sa-card hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-accent-lavender/20 text-accent-lavender-dark flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                        <i class="ri-user-settings-line"></i>
                    </div>
                    <h3 class="text-xl font-bold text-charcoal-900">User Management & Activation</h3>
                    <p class="text-xs text-charcoal-700 leading-relaxed">
                        Add team members, assign individual password view permissions, and instantly lock accounts using the <code class="font-bold">isActive</code> switch.
                    </p>
                </div>
                <div class="mt-6 flex items-center gap-2 text-xs font-bold text-accent-lavender-dark">
                    <span>Open User Matrix</span>
                    <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

            <a href="passwords.php" class="p-7 rounded-3xl bg-sa-card border border-sa-border shadow-sa-card hover:-translate-y-1 transition-all duration-300 group flex flex-col justify-between">
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-2xl bg-accent-sage/20 text-accent-sage-dark flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                        <i class="ri-key-2-fill"></i>
                    </div>
                    <h3 class="text-xl font-bold text-charcoal-900">Master Password Inventory</h3>
                    <p class="text-xs text-charcoal-700 leading-relaxed">
                        Create and store client credentials, assign categories, and generate AES-256 cipher payloads directly in MySQL.
                    </p>
                </div>
                <div class="mt-6 flex items-center gap-2 text-xs font-bold text-accent-sage-dark">
                    <span>Manage Vault Credentials</span>
                    <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
                </div>
            </a>

        </div>

    </main>

    <!-- Footer -->
    <?php include_once __DIR__ . '/../includes/layout/footer.php'; ?>
</body>
</html>