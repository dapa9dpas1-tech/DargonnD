import re

# 1. Create admin_users.php
php_content = """<?php
require_admin();
$editId = (int)($_GET['edit'] ?? 0);
$editUser = null;
if ($editId > 0) {
    $stmt = $pdo->prepare("SELECT id, name, email, role, phone, address, created_at FROM users WHERE id = ?");
    $stmt->execute([$editId]);
    $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
}
$allUsers = $pdo->query("SELECT id, name, email, role, created_at FROM users ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

$val = function ($key) use ($editUser) {
    return $editUser ? e($editUser[$key] ?? '') : '';
};
?>
<div>
    <div class="mb-space-xl">
        <span class="font-label-md text-primary tracking-widest uppercase block mb-1">USER MANAGEMENT</span>
        <h1 class="font-headline-lg text-on-surface tracking-tight">Manage <span class="text-primary font-bold">Users</span></h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left: Edit User Form -->
        <div class="lg:col-span-4">
            <div class="bg-surface-container rounded-xl p-6 shadow-sm border border-outline-variant/30 sticky top-[90px]">
                <h3 class="font-headline-sm font-bold text-on-surface mb-6">
                    <?php echo $editUser ? 'Edit User Role' : 'Select a User to Edit'; ?>
                </h3>
                
                <?php if ($editUser): ?>
                <form method="POST" class="space-y-4 max-h-[70vh] overflow-y-auto pr-2 custom-scrollbar">
                    <input type="hidden" name="do" value="admin_save_user">
                    <input type="hidden" name="id" value="<?php echo (int)$editUser['id']; ?>">
                    
                    <div class="flex flex-col gap-1.5">
                        <label class="text-label-sm font-bold text-on-surface uppercase tracking-wider">Name</label>
                        <input type="text" value="<?php echo $val('name'); ?>" disabled class="w-full h-11 px-4 rounded-lg bg-surface-container-lowest border border-outline-variant text-on-surface/50 font-body-md cursor-not-allowed">
                    </div>
                    
                    <div class="flex flex-col gap-1.5">
                        <label class="text-label-sm font-bold text-on-surface uppercase tracking-wider">Email</label>
                        <input type="email" value="<?php echo $val('email'); ?>" disabled class="w-full h-11 px-4 rounded-lg bg-surface-container-lowest border border-outline-variant text-on-surface/50 font-body-md cursor-not-allowed">
                    </div>
                    
                    <div class="pt-4 mt-2 border-t border-outline-variant/30">
                        <h4 class="font-label-md uppercase tracking-widest text-on-surface-variant mb-4">Privileges</h4>
                        
                        <div class="flex flex-col gap-1.5">
                            <label class="text-label-sm font-bold text-on-surface uppercase tracking-wider">Role</label>
                            <select name="role" class="w-full h-11 px-4 rounded-lg bg-surface-container-lowest border border-outline-variant text-on-surface focus:outline-none focus:ring-2 focus:ring-primary font-body-md appearance-none">
                                <option value="customer" <?php echo $editUser['role'] === 'customer' ? 'selected' : ''; ?>>Customer</option>
                                <option value="admin" <?php echo $editUser['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-4 mt-2">
                        <button type="submit" class="w-full py-3 rounded-lg bg-primary hover:bg-primary/90 text-on-primary font-label-md uppercase tracking-widest font-bold shadow-md transition-all">
                            Save Changes
                        </button>
                        <a href="?page=admin_users" class="mt-3 block text-center text-label-md uppercase tracking-widest font-bold text-on-surface-variant hover:text-on-surface transition-colors">
                            Cancel
                        </a>
                    </div>
                </form>
                <?php else: ?>
                    <p class="text-body-sm text-on-surface-variant">Click the Edit button next to a user in the list to change their role.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right: Users List -->
        <div class="lg:col-span-8">
            <div class="bg-surface-container rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
                <div class="p-6 border-b border-outline-variant/30">
                    <h3 class="font-headline-sm font-bold text-on-surface">Registered Users</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-body-sm text-on-surface whitespace-nowrap">
                        <thead class="bg-surface-container-high border-b border-outline-variant/30 font-label-md uppercase text-on-surface-variant tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Name</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4">Joined</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/30">
                        <?php foreach ($allUsers as $u): ?>
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-6 py-4 font-bold text-on-surface"><?php echo e($u['name']); ?></td>
                                <td class="px-6 py-4 text-on-surface-variant"><?php echo e($u['email']); ?></td>
                                <td class="px-6 py-4">
                                    <?php if ($u['role'] === 'admin'): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-label-sm font-bold bg-[#d1f4e0] text-[#146c43] uppercase tracking-wider">Admin</span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-label-sm font-bold bg-surface-container-high text-on-surface-variant uppercase tracking-wider">Customer</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 font-mono text-xs text-on-surface-variant"><?php echo date('M d, Y', strtotime($u['created_at'])); ?></td>
                                <td class="px-6 py-4 text-right">
                                    <a href="?page=admin_users&edit=<?php echo (int)$u['id']; ?>" class="inline-flex items-center justify-center px-3 py-1.5 text-label-sm font-semibold bg-surface-container-high hover:bg-surface-container-highest text-on-surface rounded transition-colors border border-outline-variant">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
"""

with open('c:/xampp/htdocs/king/pages/admin_users.php', 'w', encoding='utf-8') as f:
    f.write(php_content)

# 2. Append logic to actions.php
actions_php = """
// ============================================================
// ADMIN: USER MANAGEMENT
// ============================================================
if ($action === 'admin_save_user' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_admin();
    $id = (int)($_POST['id'] ?? 0);
    $role = $_POST['role'] ?? 'customer';
    
    if (!in_array($role, ['admin', 'customer'])) {
        $role = 'customer';
    }
    
    if ($id > 0) {
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$role, $id]);
    }
    
    header('Location: index.php?page=admin_users');
    exit;
}
"""

with open('c:/xampp/htdocs/king/includes/actions.php', 'a', encoding='utf-8') as f:
    f.write(actions_php)

import os
if os.path.exists('c:/xampp/htdocs/king/pages/admin_collections.php'):
    os.remove('c:/xampp/htdocs/king/pages/admin_collections.php')
