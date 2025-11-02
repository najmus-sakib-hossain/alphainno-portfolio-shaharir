# Alphainno Portfolio Project

This repository contains the source code and documentation for the Alphainno Portfolio Project. The project aims to showcase a collection of innovative solutions and applications developed by the Alphainno team.

## Database Configuration

This project uses **MySQL** as the default database. Make sure to configure your database settings in the `.env` file.

### Local Development

1. Create a MySQL database
2. Copy `.env.example` to `.env`
3. Update database credentials in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```
4. Run migrations:
   ```bash
   php artisan migrate
   ```

### Production Deployment (cPanel)

For detailed cPanel deployment instructions, see [DEPLOYMENT.md](DEPLOYMENT.md)

**Quick Setup:**
1. Create MySQL database in cPanel
2. Upload project files to `public_html`
3. Copy `.env.cpanel` to `.env` and update credentials
4. Run the setup script:
   ```bash
   chmod +x cpanel-setup.sh
   ./cpanel-setup.sh
   ```
5. Create admin user:
   ```bash
   chmod +x create-admin-user.sh
   ./create-admin-user.sh
   ```
   Or visit: `https://yourdomain.com/admin/auto-login`

**Admin Credentials:**
- Email: `shahriar@gmail.com`
- Password: `shahriar@password.com`

**Manual Migration:**
```bash
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate
/opt/cpanel/ea-php83/root/usr/bin/php artisan db:seed --class=AdminUserSeeder
```

## Requirements

- PHP 8.1 or higher
- MySQL 5.7 or higher
- Composer
- PDO PHP Extension
- PDO MySQL PHP Extension

## Installation

1. Clone the repository
2. Install dependencies: `composer install`
3. Configure environment: `cp .env.example .env`
4. Generate app key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Start development server: `php artisan serve`

## Documentation

- [cPanel Deployment Guide](CPANEL_DEPLOYMENT.md) - Complete cPanel deployment instructions
- [cPanel Web Server Setup](CPANEL_WEBSERVER.md) - How to run Laravel in cPanel (no `artisan serve` needed!)
- [cPanel Commands Reference](CPANEL_COMMANDS.md) - Quick reference for common commands
- [cPanel PDO Fix](CPANEL_FIX.md) - Troubleshooting guide for PDO issues

## Files

- `.env.example` - Example environment configuration
- `.env.cpanel` - Production environment template for cPanel
- `cpanel-setup.sh` - Automated setup script for cPanel
- `cpanel-migrate.sh` - Helper script to run migrations with correct PHP version

