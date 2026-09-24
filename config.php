<?php
// ============================================================
// DRAGON NORTH DIVISION — FULL SITE (single-file index.php)
// Dark Outdoor / Adventure Edition — v2 (richer specs + About)
// Includes: storefront, product detail page, auth, cart,
// checkout, order tracking, admin panel, ratings.
// ============================================================

// ============================================================
// DATABASE LAYER (MySQL via PDO)
// ============================================================

try {
    $host = '127.0.0.1';
    $db   = 'dragonnorth';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Database connection failed: ' . htmlspecialchars($e->getMessage()));
}

// ------------------------------------------------------------
// SCHEMA
// ------------------------------------------------------------
// Schema and indexes are managed manually in MySQL.

// SEED DATA
// ------------------------------------------------------------
$count = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
if ($count == 0) {
    $stmt = $pdo->prepare("INSERT INTO users (name, email, phone, password_hash, role) VALUES (?,?,?,?,?)");
    $stmt->execute(['Admin Dragon North', 'admin@dragonnorth.com', '62822196449', password_hash('admin123', PASSWORD_DEFAULT), 'admin pro']);
}

$count = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
if ($count == 0) {
    $seedProducts = [
        [
            'name' => 'Dragon Pro 45L',
            'description' => 'Swedish Suede & Italian Leather Grade A',
            'price' => 790000,
            'image' => 'https://images.unsplash.com/photo-1622560257067-108402fcedc0?w=700&q=80&auto=format&fit=crop',
            'material' => 'suede', 'grade' => 'a', 'badge' => 'Best Seller', 'stock' => 20,
            'zipper_brand' => 'YKK #10 Vislon', 'buckle_brand' => 'Duraflex',
            'lining_material' => '210D Ripstop Nylon', 'strap_material' => '25mm Nylon Webbing',
            'dimensions' => '55 x 35 x 22 cm', 'weight' => '1.4 kg',
            'warranty' => '12-month manufacturer warranty covering zipper, buckle, and stitching defects.',
            'material_origin' => '1000D Cordura Canvas (Korea)',
            'leather_origin' => 'Sweden (Suede) & Italy (Genuine Leather trim)',
            'zipper_origin' => 'Japan', 'buckle_origin' => 'USA',
            'thread_material' => 'Bonded Nylon Thread (Japan)',
            'zipper_detail' => 'YKK #10 Vislon teeth in a solid brass finish with anti-corrosion coating; auto-lock pull slider with a rubberized, non-slip grip designed for use with gloves on.',
            'warranty_period' => '12 Months',
            'water_resistance' => 'IPX4 — splash & light rain resistant. Outer shell is DWR (Durable Water Repellent) coated 1000D Cordura canvas.',
            'capacity_liters' => '45 Liters',
            'compartments_detail' => '2 main compartments, 1 hidden security back pocket, 6 exterior pockets, 4 interior organizer pockets with a key clip.',
            'laptop_sleeve' => 'Padded, fleece-lined sleeve fits laptops up to 16".',
            'back_panel' => 'Ventilated 3D-mesh back panel over EVA foam, with a contoured lumbar support ridge.',
            'closure_type' => 'Roll-top main closure with a YKK Vislon zip track, secured by a quick-release magnetic buckle.',
            'country_of_assembly' => 'Hand-assembled in Bandung, West Java, Indonesia.',
            'quality_control' => 'Passes a 120-point QC checklist; bar-tacked stress points; triple-needle box-X stitching on every load-bearing strap.',
            'care_instructions' => 'Wipe down with a damp microfiber cloth after use; air-dry away from direct sunlight; condition the leather trim every 3 months with a neutral leather balm.',
            'certification' => 'Dyes are REACH-compliant; webbing and lining fabric are OEKO-TEX tested for skin safety.',
            'packaging' => 'Ships with a protective dust bag, printed care card, and a numbered authenticity card.',
        ],
        [
            'name' => 'Dragon Trek 30L',
            'description' => 'Swedish Suede & Australian Leather Grade B',
            'price' => 650000,
            'image' => 'https://images.unsplash.com/photo-1660359472599-a17143b27f2c?w=700&q=80&auto=format&fit=crop',
            'material' => 'suede', 'grade' => 'b', 'badge' => 'New', 'stock' => 20,
            'zipper_brand' => 'YKK #8 Coil', 'buckle_brand' => 'Nifco',
            'lining_material' => '190D Polyester', 'strap_material' => '20mm Nylon Webbing',
            'dimensions' => '48 x 30 x 18 cm', 'weight' => '1.1 kg',
            'warranty' => '9-month manufacturer warranty covering zipper, buckle, and stitching defects.',
            'material_origin' => '600D Polyester Canvas (China)',
            'leather_origin' => 'Sweden (Suede) & Australia (Leather trim)',
            'zipper_origin' => 'Japan', 'buckle_origin' => 'Japan',
            'thread_material' => 'Bonded Nylon Thread (China)',
            'zipper_detail' => 'YKK #8 coil zipper with a reinforced polyester tape; smooth-glide slider with an easy-grip pull tab.',
            'warranty_period' => '9 Months',
            'water_resistance' => 'IPX3 — resists light drizzle. Polyester canvas shell with a PU protective coating.',
            'capacity_liters' => '30 Liters',
            'compartments_detail' => '1 main compartment, 1 front organizer pocket, 4 exterior pockets, 2 interior mesh pockets.',
            'laptop_sleeve' => 'Padded sleeve fits laptops up to 14".',
            'back_panel' => 'Breathable mesh back panel over foam padding.',
            'closure_type' => 'Top-loading zip closure with an internal drawstring liner for extra protection.',
            'country_of_assembly' => 'Hand-assembled in Bandung, West Java, Indonesia.',
            'quality_control' => 'Passes a 90-point QC checklist; reinforced stitching at every stress point.',
            'care_instructions' => 'Wipe with a damp cloth; do not machine wash; store in a cool, dry place away from sunlight.',
            'certification' => 'Lining fabric is OEKO-TEX tested for skin safety.',
            'packaging' => 'Ships with a protective dust bag and printed care card.',
        ],
        [
            'name' => 'Dragon Sling Pro',
            'description' => 'Genuine Italian Leather Grade A',
            'price' => 450000,
            'image' => 'https://images.unsplash.com/photo-1603219527847-24c87f552a77?w=700&q=80&auto=format&fit=crop',
            'material' => 'italia', 'grade' => 'a', 'badge' => 'Best Seller', 'stock' => 20,
            'zipper_brand' => 'YKK #5 Coil', 'buckle_brand' => 'ITW Nexus',
            'lining_material' => '200D Nylon', 'strap_material' => '20mm Nylon Webbing',
            'dimensions' => '28 x 18 x 10 cm', 'weight' => '0.5 kg',
            'warranty' => '6-month manufacturer warranty covering zipper and stitching defects.',
            'material_origin' => '840D Ballistic Nylon (Korea)',
            'leather_origin' => 'Italy (Full-grain Leather)',
            'zipper_origin' => 'Japan', 'buckle_origin' => 'USA',
            'thread_material' => 'Bonded Nylon Thread (Japan)',
            'zipper_detail' => 'YKK #5 coil zipper in a matte-black finish with self-repairing coil teeth for long-term reliability.',
            'warranty_period' => '6 Months',
            'water_resistance' => 'IPX3 — light rain resistant. Body panel is 840D ballistic nylon.',
            'capacity_liters' => '8 Liters',
            'compartments_detail' => '1 main compartment, 1 front zip pocket, 2 interior card slots.',
            'laptop_sleeve' => 'Not applicable — sized for tablets up to 8" and daily carry essentials.',
            'back_panel' => 'Padded, adjustable single strap with an anti-slip silicone grip pad.',
            'closure_type' => 'Single main zip closure with a secondary security zip pocket.',
            'country_of_assembly' => 'Hand-assembled in Bandung, West Java, Indonesia.',
            'quality_control' => 'Passes a 70-point QC checklist; leather edges are hand-burnished and sealed by our leather crew.',
            'care_instructions' => 'Buff the leather panel with a soft, dry cloth; avoid prolonged direct sun exposure and moisture.',
            'certification' => 'Full-grain leather sourced from a certified Italian tannery partner.',
            'packaging' => 'Ships with a protective dust bag and a numbered authenticity card.',
        ],
        [
            'name' => 'Dragon Casual 20L',
            'description' => 'Premium Swedish Suede Grade A',
            'price' => 550000,
            'image' => 'https://images.unsplash.com/photo-1622560480605-d83c853bc5c3?w=700&q=80&auto=format&fit=crop',
            'material' => 'suede', 'grade' => 'a', 'badge' => 'New', 'stock' => 20,
            'zipper_brand' => 'SBS #5', 'buckle_brand' => 'Duraflex',
            'lining_material' => '180D Polyester', 'strap_material' => '22mm Nylon Webbing',
            'dimensions' => '42 x 28 x 15 cm', 'weight' => '0.8 kg',
            'warranty' => '9-month manufacturer warranty covering zipper, buckle, and stitching defects.',
            'material_origin' => '600D Polyester Canvas (China)',
            'leather_origin' => 'Sweden (Suede)',
            'zipper_origin' => 'Italy', 'buckle_origin' => 'USA',
            'thread_material' => 'Bonded Nylon Thread (China)',
            'zipper_detail' => 'SBS #5 zipper with a brushed-nickel finish and a dual-slider design for access from either side.',
            'warranty_period' => '9 Months',
            'water_resistance' => 'IPX3 — light rain resistant. Polyester canvas shell with a PU backing.',
            'capacity_liters' => '20 Liters',
            'compartments_detail' => '1 main compartment, 1 dedicated laptop compartment, 3 exterior pockets, 2 interior pockets.',
            'laptop_sleeve' => 'Padded sleeve fits laptops up to 15".',
            'back_panel' => 'Foam-padded back panel with vertical ventilation channels.',
            'closure_type' => 'Top zip closure with easy-glide dual sliders.',
            'country_of_assembly' => 'Hand-assembled in Bandung, West Java, Indonesia.',
            'quality_control' => 'Passes an 85-point QC checklist; bar-tacked strap anchor points.',
            'care_instructions' => 'Spot clean with a damp cloth; air-dry fully before storing; brush suede panels gently with a suede brush.',
            'certification' => 'Lining and hardware are OEKO-TEX tested for skin safety.',
            'packaging' => 'Ships with a protective dust bag and printed care card.',
        ],
        [
            'name' => 'Dragon City Pack',
            'description' => 'Australian Leather Grade C & Suede',
            'price' => 499000,
            'image' => 'https://images.unsplash.com/photo-1622560480654-d96214fdc887?w=700&q=80&auto=format&fit=crop',
            'material' => 'australia', 'grade' => 'c', 'badge' => 'Sale', 'stock' => 20,
            'zipper_brand' => 'YKK #8 Vislon', 'buckle_brand' => 'Nifco',
            'lining_material' => '210D Ripstop Nylon', 'strap_material' => '25mm Nylon Webbing',
            'dimensions' => '45 x 30 x 16 cm', 'weight' => '1.0 kg',
            'warranty' => '6-month manufacturer warranty covering zipper and stitching defects.',
            'material_origin' => '600D Polyester Canvas (Local)',
            'leather_origin' => 'Australia (Leather trim) & Sweden (Suede)',
            'zipper_origin' => 'Japan', 'buckle_origin' => 'Japan',
            'thread_material' => 'Bonded Nylon Thread (Local)',
            'zipper_detail' => 'YKK #8 Vislon zipper with a standard nickel finish and a textured pull tab for easy grip.',
            'warranty_period' => '6 Months',
            'water_resistance' => 'IPX2 — resists light moisture. Ripstop nylon shell.',
            'capacity_liters' => '25 Liters',
            'compartments_detail' => '1 main compartment, 3 exterior pockets, 1 interior pocket.',
            'laptop_sleeve' => 'Padded sleeve fits laptops up to 14".',
            'back_panel' => 'Foam back panel with a basic breathable liner.',
            'closure_type' => 'Top zip closure.',
            'country_of_assembly' => 'Hand-assembled in Bandung, West Java, Indonesia.',
            'quality_control' => 'Passes a 60-point QC checklist; standard-grade stitch reinforcement at seams.',
            'care_instructions' => 'Wipe with a dry or lightly damp cloth; avoid soaking the leather trim.',
            'certification' => 'Locally sourced canvas meets standard dye-safety compliance.',
            'packaging' => 'Ships with a printed care card.',
        ],
        [
            'name' => 'Dragon Urban 25L',
            'description' => 'Italian Leather Grade B (Premium)',
            'price' => 620000,
            'image' => 'https://images.unsplash.com/photo-1605733513597-a8f8341084e6?w=700&q=80&auto=format&fit=crop',
            'material' => 'italia', 'grade' => 'b', 'badge' => 'New', 'stock' => 20,
            'zipper_brand' => 'SBS #8', 'buckle_brand' => 'ITW Nexus',
            'lining_material' => '200D Polyester', 'strap_material' => '22mm Nylon Webbing',
            'dimensions' => '44 x 29 x 17 cm', 'weight' => '0.95 kg',
            'warranty' => '9-month manufacturer warranty covering zipper, buckle, and stitching defects.',
            'material_origin' => '1000D Cordura Canvas (Korea)',
            'leather_origin' => 'Italy (Leather trim)',
            'zipper_origin' => 'Italy', 'buckle_origin' => 'USA',
            'thread_material' => 'Bonded Nylon Thread (Japan)',
            'zipper_detail' => 'SBS #8 zipper with a gunmetal finish and an auto-lock slider that stays put on uneven terrain.',
            'warranty_period' => '9 Months',
            'water_resistance' => 'IPX3 — light rain resistant. 1000D Cordura shell with a DWR coating.',
            'capacity_liters' => '25 Liters',
            'compartments_detail' => '1 main compartment, 1 dedicated laptop compartment, 4 exterior pockets, 3 interior pockets.',
            'laptop_sleeve' => 'Padded sleeve fits laptops up to 15.6".',
            'back_panel' => 'Ventilated mesh back panel with an ergonomic S-curve for spine clearance.',
            'closure_type' => 'Top zip closure with side compression straps for load control.',
            'country_of_assembly' => 'Hand-assembled in Bandung, West Java, Indonesia.',
            'quality_control' => 'Passes a 95-point QC checklist; reinforced bar-tack stitching at every anchor point.',
            'care_instructions' => 'Wipe with a damp cloth; condition the leather trim every 4 months with a neutral leather balm.',
            'certification' => 'Webbing is OEKO-TEX tested; dyes are REACH-compliant.',
            'packaging' => 'Ships with a protective dust bag and printed care card.',
        ],
    ];
    $cols = array_keys($seedProducts[0]);
    $colList = implode(', ', $cols);
    $phList = ':' . implode(', :', $cols);
    $stmt = $pdo->prepare("INSERT INTO products ($colList) VALUES ($phList)");
    foreach ($seedProducts as $p) {
        $stmt->execute($p);
    }
}
