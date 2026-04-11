# VAutoSpare - Car Marketplace Website

A full-featured car marketplace web application inspired by CarDekho, built with CodeIgniter 3, Bootstrap 5, and MySQL.

## Features

### User Panel
- **Home Page**: Car search, featured cars, latest cars, popular brands, accessories section
- **Car Listing**: Advanced filters (brand, model, fuel, city, price, year), sorting
- **Car Details**: Image gallery, specifications, seller info, WhatsApp inquiry
- **Accessories**: Browse and filter car accessories, inquiry via WhatsApp
- **User Account**: Login/Register, saved cars, inquiry history
- **WhatsApp**: Sticky floating button on all pages, pre-filled inquiry messages

### Admin Panel
- **Dashboard**: Overview stats, recent inquiries
- **Car Management**: Add/Edit/Delete cars, multi-image upload, approval system
- **Accessories Management**: Add/Edit/Delete accessories
- **Inquiries**: View all car/accessory inquiries with filters
- **Users**: View and block/unblock users
- **Settings**: WhatsApp number, logo, SEO meta tags, homepage banners

## Tech Stack

- **Backend**: PHP - CodeIgniter 3
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, Bootstrap 5, JavaScript, jQuery

## Installation

### 1. Requirements

- PHP 7.4+ (with mysqli, gd, mbstring extensions)
- MySQL 5.7+ or MariaDB
- Apache with mod_rewrite enabled (or nginx equivalent)

### 2. Database Setup

1. Create database and import schema:
```bash
mysql -u root -p < database/vivek_carshop.sql
```
Or use phpMyAdmin:
- Create database `vivek_carshop`
- Import `database/vivek_carshop.sql`

### 3. Configuration

Edit `application/config/database.php`:
```php
'hostname' => 'localhost',
'username' => 'your_db_user',
'password' => 'your_db_password',
'database' => 'vivek_carshop',
```

Edit `application/config/config.php`:
```php
$config['base_url'] = 'http://localhost/VAutoSpare/';
// For production: 'https://yourdomain.com/'
```

### 4. File Permissions

Ensure these directories are writable:
- `application/cache/`
- `application/logs/`
- `uploads/` (and subdirectories: cars, accessories, brands, banners)

### 5. Apache .htaccess

If using Apache, ensure `mod_rewrite` is enabled. The `.htaccess` file is included.
For XAMPP, the RewriteBase in `.htaccess` is set to `/VAutoSpare/`. Adjust if your path differs.

### 6. Access the Application

- **User Site**: http://localhost/VAutoSpare/
- **Admin Panel**: http://localhost/VAutoSpare/admin

## Default Credentials

**Admin Login**
- Username: `admin`
- Password: `admin123`

⚠️ **Change the admin password immediately after first login!**

## WhatsApp Configuration

1. Log in to Admin Panel
2. Go to **Settings**
3. Enter your WhatsApp number (with country code, no + sign)
   - Example: `919876543210` for India
4. Customize the default inquiry message template
5. Save

The floating WhatsApp button and inquiry links will use this number.

## Folder Structure

```
VAutoSpare/
├── application/
│   ├── config/
│   ├── controllers/
│   │   └── admin/
│   ├── core/
│   ├── helpers/
│   ├── models/
│   └── views/
│       ├── admin/
│       ├── layout/
│       └── ...
├── assets/
├── database/
│   └── vivek_carshop.sql
├── uploads/
│   ├── cars/
│   ├── accessories/
│   ├── brands/
│   └── banners/
├── system/
├── .htaccess
├── index.php
└── README.md
```

## Security Notes

- Enable HTTPS in production
- Change default admin credentials
- Set `ENVIRONMENT` to `production` in `index.php`
- Keep CodeIgniter and PHP updated

## License

MIT License
# Vivek_Car_Shop
