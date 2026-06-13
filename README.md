# merve<span style="color:#f27a1a">shop</span> - Advanced E-Commerce Ecosystem

An advanced, enterprise-grade e-commerce application developed as an academic showcase for modern web architectures. The system features secure transaction pipelines, asynchronous state management, dynamic role-based access control (RBAC), automatic financial metrics calculation, and professional administrative ledgers.

---

## 🎓 Academic Credentials
* **Developer:** Merve Özgül
* **Student ID:** 20232022024
* **Institution:** İstanbul Nişantaşı Üniversitesi
* **Course:** Advanced Web Programming
* **Project Type:** Final Assignment

---

## 🔐 Turnkey Administrative Access (Testing Credentials)
To bypass the manual registration pipeline during grading, utilize the pre-seeded administrative master account:
* **Admin Portal URL:** `http://127.0.0.1:8000/admin/dashboard`
* **Identity Username:** `admin@merveshop.com`
* **Secret Password:** `12345678`

---

## 🚀 Key Architectural Features & Advanced Details

### 🛒 1. Safe Checkout & Stock Sentinel Loops
* Implements robust atomic database operations via **`DB::transaction`** scopes to eliminate database race conditions during multi-item checkout processing.
* Automatically deducts product inventory quantities immediately upon payment capture.
* Safeguards relational integrity between core financial receipts (`orders`) and sub-itemized logs (`order_items`).

### 🔑 2. Many-to-Many Security Infrastructure (RBAC)
* Features an advanced User-Role architecture using standard pivot tables (`role_user`).
* Admins can dynamically delegate, authorize, or strip access privileges (e.g., *Admin*, *User*) from a specialized administrative dashboard utilizing Eloquent's **`attach()`** and **`detach()`** mechanisms.

### 📉 3. Dynamic Discount Matrix & Inventory Controls
* **Granular Discount Tweaks:** Admins can alter discount percentages and promotional price matrices per product directly from the backend dashboard. The system instantly recalculates values on the storefront view.
* **Live Analytics HUD:** The Orders & Sales workspace utilizes optimized aggregate collections (`->items()->sum()` & `->items()->avg()`) to bypass traditional memory leaks, parsing historical order payloads to display live **Gross Revenue** and **Average Basket** KPIs instantly.

### 💬 4. Moderated Feedback Loop & Star Ratings
* Customers can leave structured feedback, summaries, and 1-5 star ratings directly on product detail nodes.
* Contains a robust defense mechanism where incoming comments default to a `Pending` state, requiring manual verification from the admin dashboard before entering the public storefront space.

### ✉️ 5. Corporate Contact & Security Audit Trails
* A dedicated communication interface equipped with client IP logging capabilities for strict security auditing.
* Allows administrative staff to append private corporate notes to customer inquiries, update ticket processing statuses (`New`, `Read`, `Replied`), and archive logs seamlessly.

---

## 🛠️ Technological Blueprints
* **Backend Framework:** Laravel 12.x (PHP 8.2+)
* **Database Management:** MySQL 8.0+
* **Frontend Scaffolding:** Bootstrap 5, FontAwesome 6
* **UX/UI Interactivity:** SweetAlert2 (Dynamic toast notifications and pipeline confirmations)

---

## ⚙️ Installation & Deployment Ledger

Follow these sequential steps to establish a local mirror of the workspace:

### 1. Clone the Repository
```bash
git clone [https://github.com/merveozguul/LaravelProject.git](https://github.com/merveozguul/LaravelProject.git)
cd LaravelProject
```

### 2. Dependency Resolution

Pull down all foundational vendor libraries specified in the composer lockfile:

```bash
composer install
```

### 3. XAMPP Server Initialization & Environment Setup

Before configuring the application database, ensure your local server architecture is up and running:

1. Open the **XAMPP Control Panel** on your machine.
2. Initialize and start both the **Apache** and **MySQL** services.
3. Access `http://localhost/phpmyadmin` and create a tresh blank database named `ecommerce_db`.

Next, replicate the baseline environment blueprint and configure your local connection parameters:

```bash
cp .env.example .env
```

*Open the freshly generated `.env` file and adjust your database connection coordinates to match XAMPP defaults:*

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_db
DB_USERNAME=root
DB_PASSWORD=

```

### 4. Cryptographic Key Inception

```bash
php artisan key:generate

```

### 5. Database Schema Inception & Core Seeding

Execute database migrations to construct the physical tables inside your XAMPP MySQL server and spin up essential roles along with the master admin user:

```bash
php artisan migrate --seed

```

### 6. Flush System Cache & Initialize Engine

```bash
php artisan optimize:clear
php artisan serve

```

*The local storefront environment will now be operational at `http://127.0.0.1:8000`.*
