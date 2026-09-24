<?php
require_once __DIR__ . '/../config/security.php';
require_once __DIR__ . '/../src/Auth.php';

Auth::validateActiveSession();

if (($_SESSION['user_role'] ?? '') !== 'admin') {
    header("Location: ../dashboard.php");
    exit;
}

$pageTitle = "Master Vault Management | Social Amplifiers";
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FBF9F5; color: #1A1D20; }</style>
</head>
<body class="bg-sa-bg min-h-screen flex flex-col justify-between selection:bg-accent-lavender/20">

    <!-- Top Admin Header -->
    <header class="sticky top-0 z-40 w-full backdrop-blur-md bg-sa-bg/85 border-b border-sa-border shadow-sa-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-20">
            <a href="dashboard.php" class="flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-accent-sage via-accent-lavender to-accent-coral p-0.5 shadow-sm">
                    <div class="w-full h-full bg-sa-bg rounded-[14px] flex items-center justify-center">
                        <i class="ri-shield-keyhole-fill text-accent-lavender-dark text-xl"></i>
                    </div>
                </div>
                <div>
                    <span class="text-lg font-bold tracking-tight text-charcoal-900 flex items-center gap-2">
                        PassVault Admin
                        <span class="text-[10px] tracking-wider px-2 py-0.5 rounded-full bg-accent-sage/20 text-accent-sage-dark font-bold">VAULT</span>
                    </span>
                    <span class="text-[11px] text-charcoal-500 font-medium">Master Password Inventory</span>
                </div>
            </a>

            <div class="flex items-center gap-3">
                <a href="dashboard.php" class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-2xl bg-sa-card border border-sa-border text-charcoal-900 hover:bg-sa-hover">
                    <i class="ri-arrow-left-line"></i> Dashboard
                </a>
                <a href="../logout.php" class="p-2 text-charcoal-500 hover:text-accent-coral-dark rounded-xl">
                    <i class="ri-logout-box-r-line text-lg"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 w-full">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-8 mb-8 border-b border-sa-border">
            <div>
                <span class="text-xs font-mono uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-accent-lavender/20 text-accent-lavender-dark font-bold border border-accent-lavender/30">
                    AES-256 ENCRYPTED REPOSITORY
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-charcoal-900 tracking-tight mt-1">
                    Company Password Inventory
                </h1>
                <p class="text-xs sm:text-sm text-charcoal-500 mt-1">
                    All credentials stored here are encrypted at rest with unique cryptographic initialization vectors.
                </p>
            </div>

            <button id="open-add-modal" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-charcoal-900 text-sa-bg hover:bg-accent-lavender-dark hover:text-white text-xs sm:text-sm font-bold shadow-sa-soft active:scale-95 transition-all">
                <i class="ri-add-line text-accent-sage text-base"></i>
                <span>Add Credential</span>
            </button>
        </div>

        <!-- Table Card -->
        <div class="bg-sa-card/90 rounded-3xl border border-sa-border shadow-sa-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[700px]">
                    <thead>
                        <tr class="border-b border-sa-border text-[11px] uppercase tracking-wider text-charcoal-500 font-bold bg-sa-bg/60">
                            <th class="py-4 px-5">Platform / Client</th>
                            <th class="py-4 px-5">Category</th>
                            <th class="py-4 px-5">Account Username / Email</th>
                            <th class="py-4 px-5">Website URL</th>
                            <th class="py-4 px-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="password-table-body" class="divide-y divide-sa-border text-sm text-charcoal-900">
                        <!-- Populated via JS -->
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Modal: Add Credential -->
    <div id="add-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-charcoal-900/40 backdrop-blur-sm hidden opacity-0 transition-all duration-300">
        <div class="bg-sa-card w-full max-w-lg rounded-3xl border border-sa-border p-7 sm:p-8 shadow-sa-card relative transform scale-95 transition-all duration-300">
            <div class="flex items-center justify-between pb-4 mb-4 border-b border-sa-border">
                <h3 class="text-lg font-bold text-charcoal-900 flex items-center gap-2">
                    <i class="ri-key-2-fill text-accent-sage-dark"></i>
                    New Encrypted Credential
                </h3>
                <button type="button" id="close-add-modal" class="text-charcoal-400 hover:text-charcoal-800 text-xl">
                    <i class="ri-close-line"></i>
                </button>
            </div>

            <form id="add-password-form" class="space-y-4">
                <input type="hidden" name="action" value="create_credential">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-charcoal-700 block mb-1">Title / Account Name</label>
                        <input type="text" name="title" required placeholder="Google Ads Agency"
                            class="w-full px-4 py-3 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 focus:outline-none focus:border-accent-lavender-dark font-medium">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-charcoal-700 block mb-1">Category</label>
                        <select name="category" class="w-full px-4 py-3 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 focus:outline-none focus:border-accent-lavender-dark font-medium">
                            <option value="General">General</option>
                            <option value="Social Media">Social Media</option>
                            <option value="Advertising">Advertising</option>
                            <option value="Servers & Hosting">Servers & Hosting</option>
                            <option value="Development">Development</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-bold text-charcoal-700 block mb-1">Username / Email</label>
                        <input type="text" name="username_or_email" required placeholder="ads@socialamplifiers.com"
                            class="w-full px-4 py-3 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 focus:outline-none focus:border-accent-lavender-dark font-medium">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-charcoal-700 block mb-1">Plaintext Password</label>
                        <input type="password" name="raw_password" required placeholder="••••••••••••"
                            class="w-full px-4 py-3 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 focus:outline-none focus:border-accent-lavender-dark font-medium">
                    </div>
                </div>

                <div>
                    <label class="text-xs font-bold text-charcoal-700 block mb-1">Service / Login URL</label>
                    <input type="url" name="website_url" placeholder="https://ads.google.com?subid=xs-ip-gemini-adlc"
                        class="w-full px-4 py-3 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 focus:outline-none focus:border-accent-lavender-dark font-medium">
                </div>

                <div>
                    <label class="text-xs font-bold text-charcoal-700 block mb-1">Notes / Instructions</label>
                    <textarea name="notes" rows="2" placeholder="2FA is connected to admin phone..."
                        class="w-full px-4 py-2.5 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 focus:outline-none focus:border-accent-lavender-dark font-medium"></textarea>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-2xl bg-charcoal-900 text-sa-bg hover:bg-accent-sage-dark font-bold text-sm shadow-sa-soft active:scale-95 transition-all mt-2">
                    Encrypt & Save Credential
                </button>
            </form>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-6 right-6 z-50 transform translate-y-[-150%] opacity-0 transition-all duration-300 pointer-events-none">
        <div class="bg-charcoal-900 text-sa-bg px-4 py-3 rounded-2xl shadow-sa-card flex items-center gap-2.5 text-xs font-semibold border border-charcoal-700">
            <i id="toast-icon" class="ri-checkbox-circle-fill text-accent-sage text-base"></i>
            <span id="toast-message">Operation successful</span>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const tableBody = document.getElementById('password-table-body');
        const modal = document.getElementById('add-modal');
        const openBtn = document.getElementById('open-add-modal');
        const closeBtn = document.getElementById('close-add-modal');
        const addForm = document.getElementById('add-password-form');
        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toast-message');

        function showToast(msg, isError = false) {
            toastMsg.textContent = msg;
            document.getElementById('toast-icon').className = isError 
                ? "ri-error-warning-fill text-accent-coral text-base" 
                : "ri-checkbox-circle-fill text-accent-sage text-base";

            toast.classList.remove('translate-y-[-150%]', 'opacity-0');
            setTimeout(() => { toast.classList.add('translate-y-[-150%]', 'opacity-0'); }, 2500);
        }

        async function loadPasswords() {
            try {
                const res = await fetch('../api/password-actions.php?action=list');
                const data = await res.json();

                if (data.success) {
                    tableBody.innerHTML = '';
                    if (data.data.length === 0) {
                        tableBody.innerHTML = '<tr><td colspan="5" class="text-center py-6 text-xs text-charcoal-500">No passwords added yet.</td></tr>';
                        return;
                    }

                    data.data.forEach(item => {
                        const tr = document.createElement('tr');
                        tr.className = "hover:bg-sa-bg/60 transition-colors";
                        tr.innerHTML = `
                            <td class="py-4 px-5 font-bold text-xs text-charcoal-900">${escapeHtml(item.title)}</td>
                            <td class="py-4 px-5">
                                <span class="px-2 py-0.5 text-[10px] font-mono uppercase bg-sa-bg rounded-md border border-sa-border text-charcoal-700">
                                    ${escapeHtml(item.category || 'General')}
                                </span>
                            </td>
                            <td class="py-4 px-5 font-mono text-xs text-charcoal-700">${escapeHtml(item.username_or_email)}</td>
                            <td class="py-4 px-5 text-xs text-charcoal-500">
                                ${item.website_url ? `<a href="${escapeHtml(item.website_url)}" target="_blank" class="text-accent-lavender-dark hover:underline truncate block max-w-[200px]">${escapeHtml(item.website_url)}</a>` : '-'}
                            </td>
                            <td class="py-4 px-5 text-right">
                                <button onclick="deletePassword(${item.id})" class="p-2 text-charcoal-400 hover:text-accent-coral-dark rounded-xl transition-colors" title="Delete">
                                    <i class="ri-delete-bin-line text-base"></i>
                                </button>
                            </td>
                        `;
                        tableBody.appendChild(tr);
                    });
                }
            } catch (err) {
                showToast("Failed to load passwords.", true);
            }
        }

        window.deletePassword = async function(id) {
            if (!confirm("Are you sure you want to permanently delete this credential?")) return;

            const formData = new FormData();
            formData.append('action', 'delete_credential');
            formData.append('id', id);

            const res = await fetch('../api/password-actions.php', { method: 'POST', body: formData });
            const data = await res.json();

            if (data.success) {
                showToast(data.message);
                loadPasswords();
            } else {
                showToast(data.message, true);
            }
        };

        function toggleModal(show) {
            if (show) {
                modal.classList.remove('hidden');
                setTimeout(() => { modal.classList.remove('opacity-0'); modal.children[0].classList.remove('scale-95'); }, 10);
            } else {
                modal.classList.add('opacity-0');
                modal.children[0].classList.add('scale-95');
                setTimeout(() => { modal.classList.add('hidden'); }, 300);
            }
        }

        openBtn.addEventListener('click', () => toggleModal(true));
        closeBtn.addEventListener('click', () => toggleModal(false));

        addForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(addForm);

            const res = await fetch('../api/password-actions.php', { method: 'POST', body: formData });
            const data = await res.json();

            if (data.success) {
                showToast(data.message);
                addForm.reset();
                toggleModal(false);
                loadPasswords();
            } else {
                showToast(data.message, true);
            }
        });

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }

        loadPasswords();
    });
    </script>
</body>
</html>