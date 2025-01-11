# Sweets Inventory & POS System

A comprehensive Point of Sale (POS) and Inventory Management System built with Laravel and Livewire, specifically designed for sweet shops and confectionery businesses.

## Features

- Real-time POS system with intuitive interface
- Dynamic inventory tracking and management
- Sales and profit analytics with interactive charts
- Product categorization and management
- User role management (Admin, Cashier, Manager)
- Daily, weekly, and monthly sales reports
- Low stock alerts and notifications
- Purchase order management
- Invoice generation and printing
- Customer management system

## Technical Requirements

- PHP >= 8.1
- Laravel 10.x
- Node.js >= 16.x
- MySQL/MariaDB
- Composer
- Git
- 
## Installation
1. **Clone the repository** or **download the ZIP file**:
   ```bash
   git clone https://github.com/yourusername/sweets-inventory-pos.git
   cd inventory-tracker
2. **Copy .env example**
   ```bash
   copy .env.example .env
   cp .env.example .env
3. **Install Composer**
   ```bash
   composer install
4. **Install npm**
   ```bash
   npm install
   npm run build/npm run dev
5. **Generate application key**
   ```bash
   php artisan key:generate
6. **Run migrations to set up the database:**
   ```bash
    php artisan migrate
7. **Run storage:link**
   ```bash
   php artisan storage:link
8. **Start the development server**
   ```bash
   php artisan serve
9. **Click the generated link and then run the site**

## Default Admin Credentials (You dont need to seed as this account is automatically created once the application is open for the first time)

**Default admin credentials:**
- Email: test@example.com
- Password: admin12345



