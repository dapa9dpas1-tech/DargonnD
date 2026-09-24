CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    phone TEXT,
    address TEXT,
    password_hash TEXT NOT NULL,
    role TEXT NOT NULL DEFAULT 'customer',
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
)
CREATE TABLE sqlite_sequence(name,seq)
CREATE TABLE products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    description TEXT,
    price INTEGER NOT NULL,
    image TEXT,
    material TEXT,
    grade TEXT,
    badge TEXT,
    stock INTEGER NOT NULL DEFAULT 20,
    is_active INTEGER NOT NULL DEFAULT 1,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
, zipper_brand TEXT, buckle_brand TEXT, lining_material TEXT, strap_material TEXT, dimensions TEXT, weight TEXT, warranty TEXT, material_origin TEXT, leather_origin TEXT, zipper_origin TEXT, buckle_origin TEXT, thread_material TEXT, zipper_detail TEXT, warranty_period TEXT, water_resistance TEXT, capacity_liters TEXT, compartments_detail TEXT, laptop_sleeve TEXT, back_panel TEXT, closure_type TEXT, country_of_assembly TEXT, quality_control TEXT, care_instructions TEXT, certification TEXT, packaging TEXT)
CREATE TABLE orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    order_code TEXT NOT NULL UNIQUE,
    user_id INTEGER NOT NULL,
    total INTEGER NOT NULL,
    payment_method TEXT NOT NULL,
    status TEXT NOT NULL DEFAULT 'menunggu_pembayaran',
    recipient_name TEXT,
    recipient_phone TEXT,
    recipient_address TEXT,
    courier TEXT DEFAULT 'JNT',
    note TEXT,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)
CREATE TABLE order_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    order_id INTEGER NOT NULL,
    product_id INTEGER,
    product_name TEXT NOT NULL,
    price INTEGER NOT NULL,
    qty INTEGER NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id)
)
CREATE TABLE order_status_log (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    order_id INTEGER NOT NULL,
    status TEXT NOT NULL,
    note TEXT,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id)
)
CREATE TABLE ratings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    order_id INTEGER NOT NULL UNIQUE,
    user_id INTEGER NOT NULL,
    rating INTEGER NOT NULL,
    review TEXT,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(id)
)
CREATE INDEX idx_products_active ON products(is_active)
CREATE INDEX idx_orders_user ON orders(user_id)
CREATE INDEX idx_order_items_order ON order_items(order_id)
CREATE INDEX idx_status_log_order ON order_status_log(order_id)