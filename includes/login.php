<?php
// If already logged in, redirect directly to the respective dashboard
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $target = ($_SESSION['user_role'] === 'admin') ? 'admin/dashboard.php' : 'dashboard.php';
    echo "<script>window.location.href='{$target}';</script>";
    exit;
}

require_once __DIR__ . '/../config/security.php';
$csrfToken = generateCsrfToken();
?>

<section class="min-h-[calc(100vh-140px)] flex items-center justify-center py-10 sm:py-16 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Ambient Pastel Glow Spheres -->
    <div class="absolute -top-24 -left-20 w-80 sm:w-[450px] h-80 sm:h-[450px] bg-accent-sage/25 rounded-full blur-[140px] pointer-events-none"></div>
    <div class="absolute -bottom-28 -right-20 w-80 sm:w-[500px] h-80 sm:h-[500px] bg-accent-lavender/30 rounded-full blur-[150px] pointer-events-none"></div>
    <div class="absolute top-1/2 left-1/3 -translate-y-1/2 w-64 h-64 bg-accent-coral/15 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="w-full max-w-5xl relative z-10">
        
        <!-- Dual Column Container -->
        <div id="auth-container" class="bg-sa-card/85 backdrop-blur-2xl rounded-[32px] sm:rounded-[40px] border border-sa-border shadow-sa-card overflow-hidden grid grid-cols-1 lg:grid-cols-12">
            
            <!-- Left Column: Visual Brand & Security Pitch -->
            <div class="lg:col-span-5 bg-gradient-to-b from-sa-bg/90 to-sa-card/60 p-8 sm:p-10 lg:p-12 border-b lg:border-b-0 lg:border-r border-sa-border flex flex-col justify-between relative overflow-hidden">
                <div class="absolute -top-12 -right-12 w-48 h-48 bg-accent-lavender/20 rounded-full blur-2xl pointer-events-none"></div>

                <div class="space-y-6 relative z-10">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-accent-sage via-accent-lavender to-accent-coral p-0.5 shadow-sm">
                            <div class="w-full h-full bg-sa-bg rounded-[14px] flex items-center justify-center">
                                <i class="ri-shield-keyhole-fill text-accent-lavender-dark text-2xl"></i>
                            </div>
                        </div>
                        <div>
                            <span class="text-xl font-bold tracking-tight text-charcoal-900 flex items-center gap-2">
                                PassVault
                                <span class="text-[10px] tracking-wider px-2 py-0.5 rounded-full bg-accent-lavender/15 text-accent-lavender-dark border border-accent-lavender/30 font-semibold uppercase">SA</span>
                            </span>
                            <p class="text-xs text-charcoal-500 font-medium">Zero-Leak Infrastructure</p>
                        </div>
                    </div>

                    <div class="space-y-2 pt-2">
                        <h3 id="panel-title" class="text-2xl sm:text-3xl font-extrabold text-charcoal-900 tracking-tight leading-snug">
                            Encrypted Gateway.
                        </h3>
                        <p id="panel-desc" class="text-xs sm:text-sm text-charcoal-700 leading-relaxed">
                            Sign in with your verified company credentials to access your designated operational passwords.
                        </p>
                    </div>
                </div>

                <!-- Feature Badges -->
                <div class="my-8 space-y-3 relative z-10">
                    <div class="flex items-center gap-3 p-3 rounded-2xl bg-sa-bg/80 border border-sa-border shadow-sa-soft">
                        <div class="w-8 h-8 rounded-xl bg-accent-sage/20 text-accent-sage-dark flex items-center justify-center text-base shrink-0">
                            <i class="ri-lock-2-line"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-xs font-bold text-charcoal-900">AES-256 Bit Encryption</div>
                            <div class="text-[11px] text-charcoal-500">Decrypted only at runtime</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 p-3 rounded-2xl bg-sa-bg/80 border border-sa-border shadow-sa-soft">
                        <div class="w-8 h-8 rounded-xl bg-accent-coral/20 text-accent-coral-dark flex items-center justify-center text-base shrink-0">
                            <i class="ri-user-shield-line"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-xs font-bold text-charcoal-900">Real-time isActive Guard</div>
                            <div class="text-[11px] text-charcoal-500">Instant revocation safeguard</div>
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-sa-border flex items-center justify-between text-xs text-charcoal-500 relative z-10">
                    <span class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-accent-sage animate-pulse"></span>
                        Vault Node Ready
                    </span>
                    <span class="font-mono text-[11px]">Hostinger Node</span>
                </div>
            </div>

            <!-- Right Column: Interactive Forms (Tabs for Login & Register) -->
            <div class="lg:col-span-7 p-8 sm:p-10 lg:p-14 flex flex-col justify-center relative">
                
                <div class="max-w-md w-full mx-auto space-y-6">
                    
                    <!-- Top Auth Mode Switcher -->
                    <div class="flex items-center p-1.5 bg-sa-bg rounded-2xl border border-sa-border shadow-inner">
                        <button type="button" id="tab-login" class="flex-1 py-2.5 rounded-xl text-xs font-bold transition-all duration-200 bg-charcoal-900 text-sa-bg shadow-sm">
                            Sign In
                        </button>
                        <button type="button" id="tab-register" class="flex-1 py-2.5 rounded-xl text-xs font-semibold text-charcoal-500 hover:text-charcoal-900 transition-all duration-200">
                            Register Account
                        </button>
                    </div>

                    <!-- Header -->
                    <div class="space-y-1 text-left">
                        <h2 id="form-heading" class="text-2xl sm:text-3xl font-extrabold text-charcoal-900 tracking-tight">
                            Welcome back
                        </h2>
                        <p id="form-subheading" class="text-xs sm:text-sm text-charcoal-500">
                            Please authenticate your session to continue.
                        </p>
                    </div>

                    <!-- Dynamic Alert Message Container -->
                    <div id="auth-alert" class="hidden p-4 rounded-2xl text-xs font-semibold flex items-center gap-3 shadow-sa-soft transition-all duration-300">
                        <i id="alert-icon" class="ri-information-line text-lg shrink-0"></i>
                        <span id="alert-text" class="leading-relaxed"></span>
                    </div>

                    <!-- 1. LOGIN FORM -->
                    <form id="login-form" class="space-y-5">
                        <input type="hidden" name="action" value="login">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken); ?>">

                        <div class="space-y-2 text-left">
                            <label class="text-xs font-bold text-charcoal-700 uppercase tracking-wider block">
                                Company Email
                            </label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-charcoal-400 group-focus-within:text-accent-lavender-dark transition-colors">
                                    <i class="ri-mail-line text-lg"></i>
                                </span>
                                <input type="email" name="email" required placeholder="team@socialamplifiers.com"
                                    class="w-full pl-12 pr-4 py-3.5 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 placeholder-charcoal-400 focus:outline-none focus:border-accent-lavender-dark focus:ring-4 focus:ring-accent-lavender/15 transition-all font-medium">
                            </div>
                        </div>

                        <div class="space-y-2 text-left">
                            <div class="flex items-center justify-between">
                                <label class="text-xs font-bold text-charcoal-700 uppercase tracking-wider block">
                                    Master Password
                                </label>
                            </div>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-charcoal-400 group-focus-within:text-accent-lavender-dark transition-colors">
                                    <i class="ri-lock-password-line text-lg"></i>
                                </span>
                                <input type="password" id="login-password" name="password" required placeholder="••••••••••••"
                                    class="w-full pl-12 pr-12 py-3.5 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 placeholder-charcoal-400 focus:outline-none focus:border-accent-lavender-dark focus:ring-4 focus:ring-accent-lavender/15 transition-all font-medium">
                                <button type="button" class="toggle-pwd-btn absolute inset-y-0 right-0 pr-4 flex items-center text-charcoal-400 hover:text-charcoal-800 transition-colors" data-target="login-password">
                                    <i class="ri-eye-line text-lg"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" id="login-btn"
                            class="w-full py-4 px-6 rounded-2xl bg-charcoal-900 text-sa-bg hover:bg-accent-lavender-dark hover:text-white font-bold text-sm shadow-sa-card active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2 group mt-2">
                            <span class="btn-text">Authenticate & Enter Vault</span>
                            <i class="btn-icon ri-arrow-right-line text-accent-sage text-base group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </form>

                    <!-- 2. REGISTER FORM (Hidden by Default) -->
                    <form id="register-form" class="space-y-4 hidden">
                        <input type="hidden" name="action" value="register">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken); ?>">

                        <div class="space-y-1.5 text-left">
                            <label class="text-xs font-bold text-charcoal-700 uppercase tracking-wider block">
                                Full Name
                            </label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-charcoal-400 group-focus-within:text-accent-sage-dark transition-colors">
                                    <i class="ri-user-line text-lg"></i>
                                </span>
                                <input type="text" name="full_name" required placeholder="John Doe"
                                    class="w-full pl-12 pr-4 py-3 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 placeholder-charcoal-400 focus:outline-none focus:border-accent-sage-dark focus:ring-4 focus:ring-accent-sage/15 transition-all font-medium">
                            </div>
                        </div>

                        <div class="space-y-1.5 text-left">
                            <label class="text-xs font-bold text-charcoal-700 uppercase tracking-wider block">
                                Company Email
                            </label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-charcoal-400 group-focus-within:text-accent-sage-dark transition-colors">
                                    <i class="ri-mail-line text-lg"></i>
                                </span>
                                <input type="email" name="email" required placeholder="name@socialamplifiers.com"
                                    class="w-full pl-12 pr-4 py-3 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 placeholder-charcoal-400 focus:outline-none focus:border-accent-sage-dark focus:ring-4 focus:ring-accent-sage/15 transition-all font-medium">
                            </div>
                        </div>

                        <div class="space-y-1.5 text-left">
                            <label class="text-xs font-bold text-charcoal-700 uppercase tracking-wider block">
                                Choose Master Password
                            </label>
                            <div class="relative group">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-charcoal-400 group-focus-within:text-accent-sage-dark transition-colors">
                                    <i class="ri-lock-password-line text-lg"></i>
                                </span>
                                <input type="password" id="register-password" name="password" required placeholder="••••••••••••"
                                    class="w-full pl-12 pr-12 py-3 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 placeholder-charcoal-400 focus:outline-none focus:border-accent-sage-dark focus:ring-4 focus:ring-accent-sage/15 transition-all font-medium">
                                <button type="button" class="toggle-pwd-btn absolute inset-y-0 right-0 pr-4 flex items-center text-charcoal-400 hover:text-charcoal-800 transition-colors" data-target="register-password">
                                    <i class="ri-eye-line text-lg"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" id="register-btn"
                            class="w-full py-3.5 px-6 rounded-2xl bg-charcoal-900 text-sa-bg hover:bg-accent-sage-dark hover:text-white font-bold text-sm shadow-sa-card active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2 group mt-2">
                            <span class="btn-text">Create Account</span>
                            <i class="btn-icon ri-user-add-line text-accent-sage text-base group-hover:translate-x-1 transition-transform"></i>
                        </button>
                    </form>

                    <!-- Footer Help Text -->
                    <div class="pt-4 border-t border-sa-border text-center">
                        <p class="text-xs text-charcoal-500">
                            Role assignment: Default is <code class="font-mono text-charcoal-900 bg-sa-bg px-1 py-0.5 rounded border border-sa-border font-bold">user</code>. Upgrade to <code class="font-mono text-charcoal-900 bg-sa-bg px-1 py-0.5 rounded border border-sa-border font-bold">admin</code> via database or master panel.
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<!-- Tab Switcher & Async Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabLogin = document.getElementById('tab-login');
    const tabRegister = document.getElementById('tab-register');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const panelTitle = document.getElementById('panel-title');
    const panelDesc = document.getElementById('panel-desc');
    const alertBox = document.getElementById('auth-alert');
    const alertText = document.getElementById('alert-text');
    const alertIcon = document.getElementById('alert-icon');

    // Tab Switchers
    if (tabLogin && tabRegister) {
        tabLogin.addEventListener('click', () => {
            tabLogin.className = "flex-1 py-2 rounded-xl text-xs font-bold bg-charcoal-900 text-sa-bg transition-all";
            tabRegister.className = "flex-1 py-2 rounded-xl text-xs font-semibold text-charcoal-500 hover:text-charcoal-900 transition-all";
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
            panelTitle.textContent = "Encrypted Gateway.";
            panelDesc.textContent = "Sign in to access assigned credentials, or register a new team profile.";
            alertBox.classList.add('hidden');
        });

        tabRegister.addEventListener('click', () => {
            tabRegister.className = "flex-1 py-2 rounded-xl text-xs font-bold bg-charcoal-900 text-sa-bg transition-all";
            tabLogin.className = "flex-1 py-2 rounded-xl text-xs font-semibold text-charcoal-500 hover:text-charcoal-900 transition-all";
            registerForm.classList.remove('hidden');
            loginForm.classList.add('hidden');
            panelTitle.textContent = "Join Vault.";
            panelDesc.textContent = "Create an account. An administrator can assign credentials or upgrade your role.";
            alertBox.classList.add('hidden');
        });
    }

    // Password Eye Icon Toggles
    document.querySelectorAll('.toggle-pwd-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = btn.querySelector('i');
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            icon.className = isPassword ? 'ri-eye-off-line text-base' : 'ri-eye-line text-base';
        });
    });

    // Form Submission with Real Error Catching
    async function handleAuthSubmit(form, btn) {
        const btnText = btn.querySelector('.btn-text') || btn;
        const originalText = btnText.textContent;

        btn.disabled = true;
        btnText.textContent = "Processing...";
        alertBox.classList.add('hidden');

        try {
            const formData = new FormData(form);
            
            // Explicit URL path to prevent subfolder routing issues
            const apiUrl = window.location.pathname.includes('password-manager') 
                ? '/password-manager/api/auth-actions.php' 
                : 'api/auth-actions.php';

            const response = await fetch(apiUrl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            });

            const rawText = await response.text();
            let data;
            
            try {
                data = JSON.parse(rawText);
            } catch (jsonErr) {
                // Shows the REAL PHP Fatal Error or HTML output directly on screen
                throw new Error("Server Output: " + rawText.replace(/<[^>]*>?/gm, '').substring(0, 180));
            }

            if (data.success) {
                alertBox.className = "p-3.5 rounded-2xl text-xs font-semibold flex items-center gap-2.5 bg-accent-sage/15 text-accent-sage-dark border border-accent-sage/30";
                if (alertIcon) alertIcon.className = "ri-checkbox-circle-fill text-base";
                alertText.textContent = data.message;
                alertBox.classList.remove('hidden');

                if (data.redirect) {
                    setTimeout(() => { window.location.href = data.redirect; }, 750);
                } else if (data.auto_switch_to_login) {
                    form.reset();
                    setTimeout(() => { tabLogin.click(); }, 1200);
                }
            } else {
                alertBox.className = "p-3.5 rounded-2xl text-xs font-semibold flex items-center gap-2.5 bg-accent-coral/15 text-accent-coral-dark border border-accent-coral/30";
                if (alertIcon) alertIcon.className = "ri-error-warning-fill text-base";
                alertText.textContent = data.message || "Operation failed.";
                alertBox.classList.remove('hidden');

                btn.disabled = false;
                btnText.textContent = originalText;
            }
        } catch (error) {
            alertBox.className = "p-3.5 rounded-2xl text-xs font-semibold flex items-center gap-2.5 bg-accent-coral/15 text-accent-coral-dark border border-accent-coral/30";
            if (alertIcon) alertIcon.className = "ri-alert-fill text-base";
            alertText.textContent = error.message || "Network request failed.";
            alertBox.classList.remove('hidden');

            btn.disabled = false;
            btnText.textContent = originalText;
        }
    }

    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            handleAuthSubmit(loginForm, document.getElementById('login-btn'));
        });
    }

    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            e.preventDefault();
            handleAuthSubmit(registerForm, document.getElementById('register-btn'));
        });
    }
});
</script>