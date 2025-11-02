# cPanel Deployment Guide

This guide will help you deploy this Laravel application to cPanel hosting.

## Prerequisites

- cPanel hosting account with SSH access
- MySQL database access
- PHP 8.0 or higher

## Step 1: Create MySQL Database in cPanel

1. Log in to your cPanel account
2. Go to **MySQL® Databases**
3. Create a new database:
   - Database name: `your_database_name`
   - Click **Create Database**
4. Create a database user:
   - Username: `your_database_user`
   - Password: (generate a strong password)
   - Click **Create User**
5. Add user to database:
   - Select the user and database
   - Grant **ALL PRIVILEGES**
   - Click **Make Changes**

**Important:** Note down these credentials:
- Database name
- Database username
- Database password

## Step 2: Upload Files to cPanel

### Option A: Using Git (Recommended)

```bash
# SSH into your cPanel account
ssh yourusername@yourdomain.com

# Navigate to public_html
cd public_html

# Clone your repository
git clone https://github.com/yourusername/yourrepo.git .

# Or if files already exist, pull latest changes
git pull origin main
```

### Option B: Using File Manager or FTP

1. Upload all project files to `public_html` directory
2. Make sure `.htaccess` and all Laravel files are uploaded

## Step 3: Configure Environment

```bash
# SSH into your server
cd ~/public_html

# Copy the cPanel environment template
cp .env.cpanel .env

# Edit the .env file with your database credentials
nano .env
# or
vi .env
```

Update these values in `.env`:
```env
DB_DATABASE=your_actual_database_name
DB_USERNAME=your_actual_database_user
DB_PASSWORD=your_actual_database_password
APP_URL=https://yourdomain.com
```

Generate application key:
```bash
/opt/cpanel/ea-php83/root/usr/bin/php artisan key:generate
```

## Step 4: Install Dependencies

```bash
cd ~/public_html

# Install Composer dependencies (production only)
composer install --optimize-autoloader --no-dev
```

## Step 5: Run Migrations

```bash
# Use PHP 8.3 (or the version with PDO support)
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate --force
```

## Step 6: Set Permissions

```bash
# Set proper permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# If you get permission errors, you may need:
chown -R $USER:$USER storage bootstrap/cache
```

## Step 7: Configure Public Directory

### Method 1: Using .htaccess (if public_html is your document root)

Create or update `.htaccess` in `public_html`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### Method 2: Move files (Recommended)

```bash
# Move all files from public to public_html root
mv public/* ./
mv public/.htaccess ./

# Move Laravel files to a subdirectory
mkdir laravel-app
mv app bootstrap config database resources routes storage vendor artisan composer.* laravel-app/

# Update index.php paths
```

## Step 8: Optimize for Production

```bash
# Cache configuration
/opt/cpanel/ea-php83/root/usr/bin/php artisan config:cache

# Cache routes
/opt/cpanel/ea-php83/root/usr/bin/php artisan route:cache

# Cache views
/opt/cpanel/ea-php83/root/usr/bin/php artisan view:cache
```

## Step 9: Create Helpful Aliases (Optional)

Add to `~/.bashrc`:

```bash
# Laravel artisan alias
alias art='/opt/cpanel/ea-php83/root/usr/bin/php artisan'

# Then you can use:
# art migrate
# art cache:clear
# art config:cache
```

Apply changes:
```bash
source ~/.bashrc
```

## Common Commands Reference

```bash
# Run migrations
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate

# Rollback migrations
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate:rollback

# Clear all cache
/opt/cpanel/ea-php83/root/usr/bin/php artisan cache:clear
/opt/cpanel/ea-php83/root/usr/bin/php artisan config:clear
/opt/cpanel/ea-php83/root/usr/bin/php artisan route:clear
/opt/cpanel/ea-php83/root/usr/bin/php artisan view:clear

# Create storage link
/opt/cpanel/ea-php83/root/usr/bin/php artisan storage:link

# Check application status
/opt/cpanel/ea-php83/root/usr/bin/php artisan about
```

## Troubleshooting

### Error: "Class 'PDO' not found"

**Solution:** Use the full PHP path with PDO support:
```bash
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate
```

### Error: "Permission denied"

**Solution:** Fix permissions:
```bash
chmod -R 755 storage bootstrap/cache
```

### Error: "Database connection refused"

**Solution:** Check your `.env` file:
- Verify `DB_HOST=localhost` (not 127.0.0.1)
- Confirm database credentials are correct
- Ensure database user has privileges

### Error: "500 Internal Server Error"

**Solutions:**
1. Check error logs: `tail -f ~/logs/error_log`
2. Enable debug mode temporarily: `APP_DEBUG=true` in `.env`
3. Clear cache: `/opt/cpanel/ea-php83/root/usr/bin/php artisan cache:clear`
4. Check file permissions

### Migrations fail with "Access denied"

**Solution:** Verify database credentials in `.env` match exactly what's in cPanel.

## Security Checklist

- [ ] `APP_DEBUG=false` in production
- [ ] `APP_ENV=production`
- [ ] Strong `APP_KEY` generated
- [ ] `.env` file is not publicly accessible
- [ ] Database credentials are secure
- [ ] File permissions are set correctly (755 for directories, 644 for files)
- [ ] `storage` and `bootstrap/cache` are writable

## Maintenance Mode

```bash
# Enable maintenance mode
/opt/cpanel/ea-php83/root/usr/bin/php artisan down

# Disable maintenance mode
/opt/cpanel/ea-php83/root/usr/bin/php artisan up
```

## Updating the Application

```bash
# Pull latest changes
cd ~/public_html
git pull origin main

# Install/update dependencies
composer install --optimize-autoloader --no-dev

# Run migrations
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate --force

# Clear and cache
/opt/cpanel/ea-php83/root/usr/bin/php artisan optimize
```

## Support

If you encounter issues:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check cPanel error logs: `~/logs/error_log`
3. Review this guide's troubleshooting section
