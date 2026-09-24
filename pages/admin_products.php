<?php
require_admin();
$editId = (int)($_GET['edit'] ?? 0);
$editProduct = null;
if ($editId > 0) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$editId]);
    $editProduct = $stmt->fetch(PDO::FETCH_ASSOC);
}
$allProducts = $pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

// Small helper to keep the giant form readable below.
$val = function ($key) use ($editProduct) {
    return $editProduct ? e($editProduct[$key] ?? '') : '';
};
?>
<div>
    <div class="mb-space-xl">
        <span class="font-label-md text-primary tracking-widest uppercase block mb-1">INVENTORY</span>
        <h1 class="font-headline-lg text-on-surface tracking-tight">Manage <span class="text-primary font-bold">Products</span></h1>
    </div>



    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left: Add/Edit Product Form -->
        <div class="lg:col-span-4">
            <div class="bg-surface-container rounded-xl p-6 shadow-sm border border-outline-variant/30 sticky top-[90px]">
                <h3 class="font-headline-sm font-bold text-on-surface mb-6">
                    <?php echo $editProduct ? 'Edit Product' : 'Add New Product'; ?>
                </h3>
                
                <form method="POST" enctype="multipart/form-data" class="space-y-4 max-h-[70vh] overflow-y-auto pr-2 custom-scrollbar">
                    <input type="hidden" name="do" value="admin_save_product">
                    <input type="hidden" name="id" value="<?php echo $editProduct ? (int)$editProduct['id'] : 0; ?>">
                    
                    <div class="flex flex-col gap-1.5">
                        <label class="text-label-sm font-bold text-on-surface uppercase tracking-wider">Product Name</label>
                        <input type="text" name="name" value="<?php echo $val('name'); ?>" required class="w-full h-11 px-4 rounded-lg bg-surface-container-lowest border border-outline-variant text-on-surface focus:outline-none focus:ring-2 focus:ring-primary font-body-md">
                    </div>
                    
                    <div class="flex flex-col gap-1.5">
                        <label class="text-label-sm font-bold text-on-surface uppercase tracking-wider">Description</label>
                        <input type="text" name="description" value="<?php echo $val('description'); ?>" class="w-full h-11 px-4 rounded-lg bg-surface-container-lowest border border-outline-variant text-on-surface focus:outline-none focus:ring-2 focus:ring-primary font-body-md">
                    </div>
                    
                    <div class="flex flex-col gap-1.5">
                        <label class="text-label-sm font-bold text-on-surface uppercase tracking-wider">Price (Rp)</label>
                        <input type="number" name="price" value="<?php echo $editProduct ? (int)$editProduct['price'] : ''; ?>" required class="w-full h-11 px-4 rounded-lg bg-surface-container-lowest border border-outline-variant text-on-surface focus:outline-none focus:ring-2 focus:ring-primary font-body-md">
                    </div>
                    
                    <div class="flex flex-col gap-1.5">
                        <label class="text-label-sm font-bold text-on-surface uppercase tracking-wider">Product Photo (Upload)</label>
                        <?php if ($editProduct && $editProduct['image']): ?>
                            <div class="mb-2">
                                <img src="<?php echo e(product_image_url($editProduct['image'])); ?>" alt="Current Image" class="w-16 h-16 object-cover rounded-md border border-outline-variant">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="image_file" accept="image/*" class="w-full text-body-sm text-on-surface-variant file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-label-sm file:font-semibold file:bg-primary-container file:text-on-primary-container hover:file:bg-primary hover:file:text-on-primary transition-all">
                        <p class="text-xs text-on-surface-variant mt-1">Leave empty to keep existing photo.</p>
                    </div>
                    
                    <div class="flex flex-col gap-1.5">
                        <label class="text-label-sm font-bold text-on-surface uppercase tracking-wider">Stock</label>
                        <input type="number" name="stock" value="<?php echo $editProduct ? (int)$editProduct['stock'] : 20; ?>" required class="w-full h-11 px-4 rounded-lg bg-surface-container-lowest border border-outline-variant text-on-surface focus:outline-none focus:ring-2 focus:ring-primary font-body-md">
                    </div>

                    <div class="pt-4 mt-2 border-t border-outline-variant/30">
                        <h4 class="font-label-md uppercase tracking-widest text-on-surface-variant mb-4">Specs & Materials</h4>
                        
                        <div class="space-y-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="text-label-sm font-bold text-on-surface uppercase tracking-wider">Material</label>
                                <select name="material" class="w-full h-11 px-4 rounded-lg bg-surface-container-lowest border border-outline-variant text-on-surface focus:outline-none focus:ring-2 focus:ring-primary font-body-md appearance-none">
                                    <?php foreach (['suede' => 'Swedish Suede', 'italia' => 'Italian Leather', 'australia' => 'Australian Leather'] as $mval => $lbl): ?>
                                    <option value="<?php echo $mval; ?>" <?php echo ($editProduct && $editProduct['material'] === $mval) ? 'selected' : ''; ?>><?php echo $lbl; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="flex flex-col gap-1.5">
                                <label class="text-label-sm font-bold text-on-surface uppercase tracking-wider">Grade</label>
                                <select name="grade" class="w-full h-11 px-4 rounded-lg bg-surface-container-lowest border border-outline-variant text-on-surface focus:outline-none focus:ring-2 focus:ring-primary font-body-md appearance-none">
                                    <?php foreach (['a' => 'Grade A', 'b' => 'Grade B', 'c' => 'Grade C'] as $gval => $lbl): ?>
                                    <option value="<?php echo $gval; ?>" <?php echo ($editProduct && $editProduct['grade'] === $gval) ? 'selected' : ''; ?>><?php echo $lbl; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="flex flex-col gap-1.5">
                                <label class="text-label-sm font-bold text-on-surface uppercase tracking-wider">Badge (optional)</label>
                                <input type="text" name="badge" value="<?php echo $val('badge'); ?>" placeholder="New / Sale / Best Seller" class="w-full h-11 px-4 rounded-lg bg-surface-container-lowest border border-outline-variant text-on-surface focus:outline-none focus:ring-2 focus:ring-primary font-body-md">
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 mt-2">
                        <button type="submit" class="w-full py-3 rounded-lg bg-primary hover:bg-primary/90 text-on-primary font-label-md uppercase tracking-widest font-bold shadow-md transition-all">
                            <?php echo $editProduct ? 'Save Changes' : 'Add Product'; ?>
                        </button>
                        <?php if ($editProduct): ?>
                            <a href="?page=admin_products" class="mt-3 block text-center text-label-md uppercase tracking-widest font-bold text-on-surface-variant hover:text-on-surface transition-colors">
                                Cancel Edit
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right: Products List -->
        <div class="lg:col-span-8">
            <div class="bg-surface-container rounded-xl shadow-sm border border-outline-variant/30 overflow-hidden">
                <div class="p-6 border-b border-outline-variant/30">
                    <h3 class="font-headline-sm font-bold text-on-surface">Product List</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-body-sm text-on-surface whitespace-nowrap">
                        <thead class="bg-surface-container-high border-b border-outline-variant/30 font-label-md uppercase text-on-surface-variant tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Product</th>
                                <th class="px-6 py-4">Price</th>
                                <th class="px-6 py-4">Stock</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/30">
                        <?php foreach ($allProducts as $p): ?>
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-6 py-4 font-bold text-on-surface"><?php echo e($p['name']); ?></td>
                                <td class="px-6 py-4 font-semibold text-primary"><?php echo rupiah($p['price']); ?></td>
                                <td class="px-6 py-4 font-mono"><?php echo (int)$p['stock']; ?></td>
                                <td class="px-6 py-4">
                                    <?php if ($p['is_active']): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-label-sm font-bold bg-[#d1f4e0] text-[#146c43] uppercase tracking-wider">Active</span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-label-sm font-bold bg-error-container text-on-error-container uppercase tracking-wider">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-right flex items-center justify-end gap-2">
                                    <a href="?page=admin_products&edit=<?php echo (int)$p['id']; ?>" class="inline-flex items-center justify-center px-3 py-1.5 text-label-sm font-semibold bg-surface-container-high hover:bg-surface-container-highest text-on-surface rounded transition-colors border border-outline-variant">
                                        Edit
                                    </a>
                                    <a href="?page=product&id=<?php echo (int)$p['id']; ?>" target="_blank" class="inline-flex items-center justify-center px-3 py-1.5 text-label-sm font-semibold bg-surface-container-high hover:bg-surface-container-highest text-on-surface rounded transition-colors border border-outline-variant">
                                        View
                                    </a>
                                    <form method="POST" class="inline">
                                        <input type="hidden" name="do" value="admin_toggle_product">
                                        <input type="hidden" name="id" value="<?php echo (int)$p['id']; ?>">
                                        <input type="hidden" name="state" value="<?php echo $p['is_active'] ? 0 : 1; ?>">
                                        <button type="submit" class="inline-flex items-center justify-center px-3 py-1.5 text-label-sm font-semibold rounded transition-colors <?php echo $p['is_active'] ? 'bg-error-container text-error hover:bg-error-container/80' : 'bg-primary text-on-primary hover:bg-primary/90'; ?>">
                                            <?php echo $p['is_active'] ? 'Deactivate' : 'Activate'; ?>
                                        </button>
                                    </form>
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