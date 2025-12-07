# Gold QR - Gold Bar Management System

A Laravel-based application for managing and certifying gold bars with QR code generation and verification.

## 🚀 Installation Instructions

Follow these steps to set up the project on your local machine.

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL (or another supported database)

### Steps

1.  **Clone the Repository**
    ```bash
    git clone <repository-url>
    cd gold-qr
    ```

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Install JavaScript Dependencies**
    ```bash
    npm install
    ```

4.  **Environment Setup**
    Copy the example environment file and configure it.
    ```bash
    cp .env.example .env
    ```
    Open `.env` and update your database credentials:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations & Seeders**
    This will create the database tables and insert default data (admin user, materials).
    ```bash
    php artisan migrate
    ```
    *Default Admin Login:*
    *   Email: `admin@example.com`
    *   Password: `password`

7.  **Build Assets**
    ```bash
    npm run build
    ```

8.  **Run the Application**
    ```bash
    php artisan serve
    ```
    Access the app at `http://localhost:8000`.

---

## 🎨 Customization Guide

### 1. Changing the Application Name
To change the name displayed in the browser tab and welcome messages:

*   **Browser Title**: Edit the `.env` file:
    ```env
    APP_NAME="Your Store Name"
    ```
*   **Website Header/Text**: Edit the translation files:
    *   `lang/en/welcome.php` -> Change `'store_name'`
    *   `lang/ar/welcome.php` -> Change `'store_name'`

### 2. Changing the Logo & Favicon
The application uses image files in the public directory.
*   **Logo**: Replace `public/logo.png` with your own image. Ensure it is named `logo.png`.
*   **Favicon**: Replace `public/favicon.ico` with your own icon file. Ensure it is named `favicon.ico`.

### 3. Changing Colors
The application uses a custom color theme defined in CSS.
*   **File Location**: `resources/css/app.css`
*   **How to Change**: Edit the hex codes in the `@theme` section:
    ```css
    @theme {
        /* ... */
        --color-background: #F9FAFB;  /* Main background color */
        --color-surface: #FFFFFF;     /* Card/Container background */
        --color-text-primary: #111827;
        --color-gold: #D97706;        /* Primary Brand Color */
        --color-dark-gold: #B45309;   /* Hover state for buttons */
        /* ... */
    }
    ```
    After changing colors, run `npm run build` to apply changes.
