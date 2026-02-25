# 🎥 Relamudia (Rental Alat Multimedia)

[![Laravel Version](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![Midtrans](https://img.shields.io/badge/Payment-Midtrans-orange.svg)](https://midtrans.com/)
[![Performance](https://img.shields.io/badge/Octane-Ready-yellow.svg)](https://laravel.com/docs/11.x/octane)

**Relamudia** is a robust and modern Multimedia Rental Management System built with Laravel 12. It provides a seamless experience for both administrators to manage their inventory and customers to rent high-quality multimedia equipment.

---

## ✨ Key Features

### 👤 User Features
- **Modern Dashboard:** High-level view of available categories and featured items.
- **Advanced Item Discovery:** Filter by category and search through the multimedia inventory.
- **Shopping Cart System:** Add multiple items to your cart, manage quantities, and see instant subtotal calculations.
- **Secure Checkout:** Integrated with **Midtrans Snap** for a safe and various payment methods (VA, E-Wallet, QRIS, etc.).
- **Transaction History:** Track your rental status from *Pending* to *Completed*.
- **Profile Management:** Easily update personal details and security settings.

### 🛡️ Admin Features
- **Management Analytics:** Detailed dashboard with revenue charts, top items, and rental statistics.
- **Inventory Management:** Full CRUD capabilities for multimedia items and categories.
- **User Management:** Control and manage customer accounts.
- **Transaction Processing:** Monitor payments and update rental statuses (Ongoing, Completed, etc.).
- **PDF Reporting:** Generate and export professional reports for:
    - Sales & Revenue
    - Customer Activity
    - Item Popularity
- **Role-Based Access Control:** Secure middleware ensuring administrative sections are protected.

---

## 🚀 Tech Stack

- **Framework:** [Laravel 12](https://laravel.com)
- **Frontend:** [Blade](https://laravel.com/docs/blade), [Alpine.js](https://alpinejs.dev/), [Tailwind CSS](https://tailwindcss.com)
- **Interactive UI:** [Swiper.js](https://swiperjs.com/), [Flatpickr](https://flatpickr.js.org/), [Boxicons](https://boxicons.com/)
- **Database:** MySQL / SQLite
- **Payments:** [Midtrans PHP SDK](https://github.com/Midtrans/midtrans-php)
- **PDF Generation:** [Laravel-DomPDF](https://github.com/barryvdh/laravel-dompdf)
- **High Performance:** [Laravel Octane](https://laravel.com/docs/octane)

---

## 🛠️ Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL or SQLite

### Steps

1. **Clone the repository:**
   ```bash
   git clone https://github.com/CallMeYudhistira/RelaMudia.git
   cd RelaMudia
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set up Database:**
   Update your `.env` with your database credentials.
   ```bash
   php artisan migrate --seed
   ```

5. **Configure Midtrans:**
   Add your Midtrans keys to the `.env` file:
   ```env
   MIDTRANS_MERCHANT=your_merchant_id
   MIDTRANS_CLIENT_KEY=your_client_key
   MIDTRANS_SERVER_KEY=your_server_key
   MIDTRANS_IS_PRODUCTION=false
   ```

6. **Build Assets:**
   ```bash
   npm run build
   ```

7. **Run the Application:**
   ```bash
   php artisan serve
   ```

### 🐳 Running with Docker

This project is Docker-ready! You can quickly spin up the environment using Docker Compose:

1. **Build and start the containers:**
   ```bash
   docker-compose up -d --build
   ```

2. **Access the application:**
   Open your browser and navigate to `http://localhost:8000` (or the port defined in your `docker-compose.yml`).

3. **Install dependencies inside the container (if necessary):**
   ```bash
   docker-compose exec app composer install
   docker-compose exec app npm install
   docker-compose exec app npm run build
   docker-compose exec app php artisan migrate --seed
   ```

---

## 📈 Database Schema Highlights

- **Users:** Authentication and roles (Admin/User).
- **MultimediaItems:** Inventory details including price per day and images.
- **Categories:** Logical grouping for equipment.
- **Rentals & RentalDetails:** Core logic for tracking dates, totals, and rented items.
- **Payments:** Integration records for Midtrans transactions.
- **Carts:** Temporary storage for customer selections.

---

<p align="center">Made with ❤️</p>
