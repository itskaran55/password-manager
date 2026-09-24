<?php
require_once __DIR__ . '/../config/security.php';
require_once __DIR__ . '/../src/Auth.php';

// Validate Admin Access
Auth::validateActiveSession();

if (($_SESSION['user_role'] ?? '') !== 'admin') {
    header("Location: ../dashboard.php");
    exit;
}

$userName = $_SESSION['user_name'] ?? 'Admin';
$pageTitle = "User Governance & Permissions | Social Amplifiers";
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle; ?></title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sa: {
                            bg: '#FBF9F5',
                            card: '#F3EFEA',
                            border: '#E6DFD5',
                            hover: '#EDE6DC',
                        },
                        accent: {
                            sage: '#8FA89B',
                            'sage-dark': '#5A7567',
                            lavender: '#9B96C7',
                            'lavender-dark': '#6C66A3',
                            coral: '#E89888',
                            'coral-dark': '#C96E5D',
                            sand: '#D8C7B5',
                        },
                        charcoal: {
                            900: '#1A1D20',
                            700: '#3D444B',
                            500: '#6C757D',
                            400: '#9EA8B3',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace']
                    },
                    boxShadow: {
                        'sa-soft': '0 10px 30px -5px rgba(61, 68, 75, 0.06)',
                        'sa-card': '0 15px 35px -5px rgba(61, 68, 75, 0.08)',
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts & Remix Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FBF9F5; color: #1A1D20; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #D8C7B5; border-radius: 9999px; }
    </style>
</head>
<body class="bg-sa-bg min-h-screen flex flex-col justify-between selection:bg-accent-lavender/20">

    <!-- Admin Top Header Navigation -->
    <header class="sticky top-0 z-40 w-full backdrop-blur-md bg-sa-bg/85 border-b border-sa-border shadow-sa-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <a href="dashboard.php" class="flex items-center gap-3.5 group">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-accent-sage via-accent-lavender to-accent-coral p-0.5 shadow-sm">
                        <div class="w-full h-full bg-sa-bg rounded-[14px] flex items-center justify-center">
                            <i class="ri-admin-fill text-accent-lavender-dark text-xl"></i>
                        </div>
                    </div>
                    <div>
                        <span class="text-lg font-bold tracking-tight text-charcoal-900 flex items-center gap-2">
                            PassVault Admin
                            <span class="text-[10px] tracking-wider px-2 py-0.5 rounded-full bg-accent-lavender/20 text-accent-lavender-dark font-bold">RBAC</span>
                        </span>
                        <span class="text-[11px] text-charcoal-500 font-medium">Social Amplifiers Governance</span>
                    </div>
                </a>

                <div class="flex items-center gap-3">
                    <a href="dashboard.php" class="px-4 py-2 text-xs sm:text-sm font-semibold rounded-2xl bg-sa-card border border-sa-border text-charcoal-900 hover:bg-sa-hover transition-colors">
                        <i class="ri-arrow-left-line"></i> User View
                    </a>
                    <a href="../logout.php" class="p-2 text-charcoal-500 hover:text-accent-coral-dark rounded-xl transition-colors">
                        <i class="ri-logout-box-r-line text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 w-full">
        
        <!-- Action Title Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-8 mb-8 border-b border-sa-border">
            <div>
                <span class="text-xs font-mono uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-accent-lavender/20 text-accent-lavender-dark font-bold border border-accent-lavender/30">
                    ACCESS MATRIX & USER GOVERNANCE
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-charcoal-900 tracking-tight mt-1">
                    Manage Team Members
                </h1>
                <p class="text-xs sm:text-sm text-charcoal-500 mt-1">
                    Toggle <code class="bg-sa-card px-1.5 py-0.5 rounded text-charcoal-900 font-mono font-bold">isActive</code> state or grant per-password permissions.
                </p>
            </div>

            <button id="open-create-modal" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-charcoal-900 text-sa-bg hover:bg-accent-lavender-dark hover:text-white text-xs sm:text-sm font-bold shadow-sa-soft active:scale-95 transition-all">
                <i class="ri-user-add-line text-accent-sage text-base"></i>
                <span>Add Team Member</span>
            </button>
        </div>

        <!-- Users Table Card -->
        <div class="bg-sa-card/90 rounded-3xl border border-sa-border shadow-sa-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[700px]">
                    <thead>
                        <tr class="border-b border-sa-border text-[11px] uppercase tracking-wider text-charcoal-500 font-bold bg-sa-bg/60">
                            <th class="py-4 px-5">User Details</th>
                            <th class="py-4 px-5">System Role</th>
                            <th class="py-4 px-5">Access State (isActive)</th>
                            <th class="py-4 px-5">Assigned Passwords</th>
                            <th class="py-4 px-5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="users-table-body" class="divide-y divide-sa-border text-sm text-charcoal-900">
                        <!-- Populated asynchronously via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <!-- Modal 1: Create Team Member -->
    <div id="create-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-charcoal-900/40 backdrop-blur-sm hidden opacity-0 transition-all duration-300">
        <div class="bg-sa-card w-full max-w-md rounded-3xl border border-sa-border p-7 sm:p-8 shadow-sa-card relative transform scale-95 transition-all duration-300">
            <div class="flex items-center justify-between pb-4 mb-4 border-b border-sa-border">
                <h3 class="text-lg font-bold text-charcoal-900 flex items-center gap-2">
                    <i class="ri-user-add-line text-accent-lavender-dark"></i>
                    New Team Member
                </h3>
                <button type="button" id="close-create-modal" class="text-charcoal-400 hover:text-charcoal-800 text-xl">
                    <i class="ri-close-line"></i>
                </button>
            </div>

            <form id="create-user-form" class="space-y-4">
                <input type="hidden" name="action" value="create">

                <div>
                    <label class="text-xs font-bold text-charcoal-700 block mb-1">Full Name</label>
                    <input type="text" name="full_name" required placeholder="John Doe"
                        class="w-full px-4 py-3 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 focus:outline-none focus:border-accent-lavender-dark font-medium">
                </div>

                <div>
                    <label class="text-xs font-bold text-charcoal-700 block mb-1">Company Email</label>
                    <input type="email" name="email" required placeholder="john@socialamplifiers.com"
                        class="w-full px-4 py-3 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 focus:outline-none focus:border-accent-lavender-dark font-medium">
                </div>

                <div>
                    <label class="text-xs font-bold text-charcoal-700 block mb-1">Initial Password</label>
                    <input type="password" name="password" required placeholder="••••••••••••"
                        class="w-full px-4 py-3 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 focus:outline-none focus:border-accent-lavender-dark font-medium">
                </div>

                <div>
                    <label class="text-xs font-bold text-charcoal-700 block mb-1">System Role</label>
                    <select name="role" class="w-full px-4 py-3 bg-sa-bg rounded-2xl border border-sa-border text-sm text-charcoal-900 focus:outline-none focus:border-accent-lavender-dark font-medium">
                        <option value="user">Regular User (Assigned Passwords Only)</option>
                        <option value="admin">Administrator (Full Access)</option>
                    </select>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-2xl bg-charcoal-900 text-sa-bg hover:bg-accent-lavender-dark hover:text-white font-bold text-sm shadow-sa-soft active:scale-95 transition-all mt-2">
                    Create User Account
                </button>
            </form>
        </div>
    </div>

    <!-- Modal 2: Permissions Matrix Modal -->
    <div id="perm-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-charcoal-900/40 backdrop-blur-sm hidden opacity-0 transition-all duration-300">
        <div class="bg-sa-card w-full max-w-xl rounded-3xl border border-sa-border p-7 sm:p-8 shadow-sa-card relative transform scale-95 transition-all duration-300">
            <div class="flex items-center justify-between pb-4 mb-4 border-b border-sa-border">
                <div>
                    <h3 class="text-lg font-bold text-charcoal-900 flex items-center gap-2">
                        <i class="ri-shield-keyhole-line text-accent-sage-dark"></i>
                        Assign Passwords
                    </h3>
                    <p id="perm-user-title" class="text-xs text-charcoal-500">Configuring access for user</p>
                </div>
                <button type="button" id="close-perm-modal" class="text-charcoal-400 hover:text-charcoal-800 text-xl">
                    <i class="ri-close-line"></i>
                </button>
            </div>

            <div id="perm-list-container" class="max-h-72 overflow-y-auto space-y-2.5 pr-2 mb-6">
                <!-- Checkboxes populated via JS -->
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-sa-border">
                <button type="button" id="cancel-perm-btn" class="px-5 py-2.5 rounded-xl bg-sa-bg border border-sa-border text-xs font-semibold text-charcoal-700 hover:bg-sa-hover">
                    Cancel
                </button>
                <button type="button" id="save-perm-btn" class="px-6 py-2.5 rounded-xl bg-charcoal-900 text-sa-bg hover:bg-accent-sage-dark text-xs font-bold shadow-sa-soft active:scale-95 transition-all">
                    Save Permissions
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-6 right-6 z-50 transform translate-y-[-150%] opacity-0 transition-all duration-300 pointer-events-none">
        <div class="bg-charcoal-900 text-sa-bg px-4 py-3 rounded-2xl shadow-sa-card flex items-center gap-2.5 text-xs font-semibold border border-charcoal-700">
            <i id="toast-icon" class="ri-checkbox-circle-fill text-accent-sage text-base"></i>
            <span id="toast-message">Operation successful</span>
        </div>
    </div>

    <!-- User Governance Script -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const tableBody = document.getElementById('users-table-body');
        const createModal = document.getElementById('create-modal');
        const permModal = document.getElementById('perm-modal');
        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toast-message');
        let currentEditingUserId = null;

        function showToast(msg, isError = false) {
            toastMsg.textContent = msg;
            document.getElementById('toast-icon').className = isError 
                ? "ri-error-warning-fill text-accent-coral text-base" 
                : "ri-checkbox-circle-fill text-accent-sage text-base";

            toast.classList.remove('translate-y-[-150%]', 'opacity-0');
            setTimeout(() => { toast.classList.add('translate-y-[-150%]', 'opacity-0'); }, 2500);
        }

        // Fetch User List
        async function loadUsers() {
            try {
                const res = await fetch('../api/user-actions.php?action=list');
                const data = await res.json();

                if (data.redirect) { window.location.href = data.redirect; return; }

                if (data.success) {
                    renderUsers(data.data);
                } else {
                    showToast(data.message, true);
                }
            } catch (err) {
                showToast("Failed to fetch user list.", true);
            }
        }

        function renderUsers(users) {
            tableBody.innerHTML = '';
            users.forEach(user => {
                const tr = document.createElement('tr');
                tr.className = "hover:bg-sa-bg/60 transition-colors";
                const isActive = parseInt(user.is_active) === 1;

                tr.innerHTML = `
                    <td class="py-4 px-5 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-2xl ${user.role === 'admin' ? 'bg-accent-lavender/20 text-accent-lavender-dark' : 'bg-accent-sage/20 text-accent-sage-dark'} font-bold text-xs flex items-center justify-center shadow-xs">
                            ${escapeHtml(user.full_name.substring(0, 2).toUpperCase())}
                        </div>
                        <div>
                            <div class="font-bold text-xs text-charcoal-900">${escapeHtml(user.full_name)}</div>
                            <div class="text-[11px] font-mono text-charcoal-500">${escapeHtml(user.email)}</div>
                        </div>
                    </td>
                    <td class="py-4 px-5">
                        <span class="px-2.5 py-1 text-[11px] font-mono uppercase rounded-lg ${user.role === 'admin' ? 'bg-accent-lavender/20 text-accent-lavender-dark border border-accent-lavender/30' : 'bg-sa-bg text-charcoal-700 border border-sa-border'} font-semibold">
                            ${escapeHtml(user.role)}
                        </span>
                    </td>
                    <td class="py-4 px-5">
                        <button onclick="toggleUserStatus(${user.id}, ${isActive ? 0 : 1})" 
                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-semibold border transition-all ${isActive ? 'bg-accent-sage/15 text-accent-sage-dark border-accent-sage/30 hover:bg-accent-coral/15 hover:text-accent-coral-dark hover:border-accent-coral/30' : 'bg-accent-coral/15 text-accent-coral-dark border-accent-coral/30 hover:bg-accent-sage/15 hover:text-accent-sage-dark hover:border-accent-sage/30'}">
                            <i class="${isActive ? 'ri-checkbox-circle-fill' : 'ri-close-circle-fill'}"></i>
                            <span>${isActive ? 'Active (Click to Lock)' : 'Locked (Click to Enable)'}</span>
                        </button>
                    </td>
                    <td class="py-4 px-5">
                        <span class="text-xs font-mono font-medium text-charcoal-700">
                            ${user.role === 'admin' ? 'All (Admin)' : user.assigned_passwords_count + ' Passwords'}
                        </span>
                    </td>
                    <td class="py-4 px-5 text-right">
                        ${user.role !== 'admin' ? `
                            <button onclick="openPermissionsModal(${user.id}, '${escapeJs(user.full_name)}')" class="px-3 py-1.5 rounded-xl bg-sa-bg hover:bg-sa-hover border border-sa-border text-xs font-semibold text-charcoal-900 transition-colors">
                                <i class="ri-key-2-line text-accent-sage-dark"></i> Assign Rights
                            </button>
                        ` : '<span class="text-xs text-charcoal-400 italic">Full Access</span>'}
                    </td>
                `;
                tableBody.appendChild(tr);
            });
        }

        // Toggle isActive
        window.toggleUserStatus = async function(userId, newStatus) {
            try {
                const formData = new FormData();
                formData.append('action', 'toggle_status');
                formData.append('user_id', userId);
                formData.append('is_active', newStatus);

                const res = await fetch('../api/user-actions.php', { method: 'POST', body: formData });
                const data = await res.json();

                if (data.success) {
                    showToast(data.message);
                    loadUsers();
                } else {
                    showToast(data.message, true);
                }
            } catch (err) {
                showToast("Failed to change user status.", true);
            }
        };

        // Modal Handlers
        const createBtn = document.getElementById('open-create-modal');
        const closeCreateBtn = document.getElementById('close-create-modal');
        const createForm = document.getElementById('create-user-form');

        function toggleModal(modal, show) {
            if (show) {
                modal.classList.remove('hidden');
                setTimeout(() => { modal.classList.remove('opacity-0'); modal.children[0].classList.remove('scale-95'); }, 10);
            } else {
                modal.classList.add('opacity-0');
                modal.children[0].classList.add('scale-95');
                setTimeout(() => { modal.classList.add('hidden'); }, 300);
            }
        }

        createBtn.addEventListener('click', () => toggleModal(createModal, true));
        closeCreateBtn.addEventListener('click', () => toggleModal(createModal, false));

        createForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(createForm);

            try {
                const res = await fetch('../api/user-actions.php', { method: 'POST', body: formData });
                const data = await res.json();

                if (data.success) {
                    showToast(data.message);
                    createForm.reset();
                    toggleModal(createModal, false);
                    loadUsers();
                } else {
                    showToast(data.message, true);
                }
            } catch (err) {
                showToast("Failed to create user.", true);
            }
        });

        // Permissions Matrix Logic
        const permList = document.getElementById('perm-list-container');
        const closePermBtn = document.getElementById('close-perm-modal');
        const cancelPermBtn = document.getElementById('cancel-perm-btn');
        const savePermBtn = document.getElementById('save-perm-btn');

        closePermBtn.addEventListener('click', () => toggleModal(permModal, false));
        cancelPermBtn.addEventListener('click', () => toggleModal(permModal, false));

        window.openPermissionsModal = async function(userId, userName) {
            currentEditingUserId = userId;
            document.getElementById('perm-user-title').textContent = `Assigning passwords for: ${userName}`;
            permList.innerHTML = '<div class="text-xs text-charcoal-400 py-4 text-center">Loading credential matrix...</div>';
            toggleModal(permModal, true);

            try {
                const res = await fetch(`../api/user-actions.php?action=get_user_permissions&user_id=${userId}`);
                const data = await res.json();

                if (data.success) {
                    permList.innerHTML = '';
                    if (data.data.length === 0) {
                        permList.innerHTML = '<div class="text-xs text-charcoal-500 text-center py-4">No passwords created yet in the database.</div>';
                        return;
                    }

                    data.data.forEach(pwd => {
                        const row = document.createElement('label');
                        row.className = "flex items-center justify-between p-3 rounded-2xl bg-sa-bg border border-sa-border hover:border-accent-lavender transition-colors cursor-pointer";
                        const isChecked = parseInt(pwd.can_view) === 1;

                        row.innerHTML = `
                            <div class="flex items-center gap-3">
                                <input type="checkbox" value="${pwd.id}" class="perm-checkbox w-4 h-4 rounded text-accent-lavender-dark focus:ring-0 cursor-pointer" ${isChecked ? 'checked' : ''}>
                                <div>
                                    <div class="text-xs font-bold text-charcoal-900">${escapeHtml(pwd.title)}</div>
                                    <div class="text-[11px] font-mono text-charcoal-500">${escapeHtml(pwd.username_or_email)}</div>
                                </div>
                            </div>
                            <span class="text-[10px] uppercase font-mono px-2 py-0.5 rounded bg-sa-card text-charcoal-500">
                                ${escapeHtml(pwd.category || 'General')}
                            </span>
                        `;
                        permList.appendChild(row);
                    });
                }
            } catch (err) {
                showToast("Failed to fetch permissions.", true);
            }
        };

        savePermBtn.addEventListener('click', async () => {
            const checkedBoxes = document.querySelectorAll('.perm-checkbox:checked');
            const selectedIds = Array.from(checkedBoxes).map(cb => parseInt(cb.value));

            const formData = new FormData();
            formData.append('action', 'save_permissions');
            formData.append('user_id', currentEditingUserId);
            formData.append('password_ids', JSON.stringify(selectedIds));

            try {
                const res = await fetch('../api/user-actions.php', { method: 'POST', body: formData });
                const data = await res.json();

                if (data.success) {
                    showToast(data.message);
                    toggleModal(permModal, false);
                    loadUsers();
                } else {
                    showToast(data.message, true);
                }
            } catch (err) {
                showToast("Failed to save permissions.", true);
            }
        });

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }

        function escapeJs(str) {
            if (!str) return '';
            return str.replace(/'/g, "\\'").replace(/"/g, '\\"');
        }

        loadUsers();
    });
    </script>
</body>
</html>