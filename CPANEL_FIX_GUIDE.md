# cPanel Deployment Fix Guide

## Issue Summary
Your `.htaccess` file was being repeatedly removed by the cPanel server, causing 503 errors.

## What Was Fixed

### 1. Root `.htaccess` File
- Cleaned up and simplified the rewrite rules
- Removed commented-out code that might confuse the server
- Added proper mod_negotiation options
- All requests now properly redirect to the `public` folder

### 2. Error Pages Created
Created custom error pages in `public/` folder:
- `503.shtml` - Service unavailable
- `404.shtml` - Page not found  
- `403.shtml` - Access forbidden

## Deployment Steps for cPanel

### Step 1: Upload Files
Upload your entire project to cPanel, ensuring:
- Root `.htaccess` goes to `/home/notesofs/public_html/`
- All Laravel files go to `/home/notesofs/public_html/`

### Step 2: Set Correct File Permissions
In cPanel File Manager or via SSH:

```bash
# Set folder permissions
find /home/notesofs/public_html -type d -exec chmod 755 {} \;

# Set file permissions
find /home/notesofs/public_html -type f -exec chmod 644 {} \;

# Set storage and cache permissions
chmod -R 775 /home/notesofs/public_html/storage
chmod -R 775 /home/notesofs/public_html/bootstrap/cache
```

### Step 3: Verify .htaccess Files
Make sure these two `.htaccess` files exist:

**Root .htaccess** (`/home/notesofs/public_html/.htaccess`):
- Redirects all requests to `public/` folder

**Public .htaccess** (`/home/notesofs/public_html/public/.htaccess`):
- Handles Laravel routing

### Step 4: Environment Configuration
1. Copy `.env.example` to `.env`
2. Update database credentials
3. Set `APP_ENV=production`
4. Set `APP_DEBUG=false`
5. Generate app key: `php artisan key:generate`

### Step 5: Run Laravel Commands
```bash
cd /home/notesofs/public_html

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force
```

## Common Issues & Solutions

### Issue 1: .htaccess Still Being Removed
**Solution:**
1. Check file permissions: `.htaccess` should be `644`
2. Contact your host - they might have security rules blocking certain directives
3. Try using cPanel's "Indexes" tool to disable directory indexing instead

### Issue 2: 500 Internal Server Error
**Solution:**
1. Check error logs in cPanel
2. Verify storage folders are writable
3. Ensure `.env` file exists and is configured correctly

### Issue 3: CSS/JS Not Loading
**Solution:**
1. Run `npm run build` locally
2. Upload `public/build` folder to server
3. Check `public/storage` symlink exists

### Issue 4: Database Connection Error
**Solution:**
1. Verify database credentials in `.env`
2. Use `localhost` or `127.0.0.1` for DB_HOST
3. Create database in cPanel MySQL Databases tool

## Security Recommendations

### 1. Protect Sensitive Files
Add to `public/.htaccess` (already included):
```apache
# Deny access to .env
<Files .env>
    Order allow,deny
    Deny from all
</Files>
```

### 2. Disable Directory Listing
Already handled in the `.htaccess` with `-Indexes`

### 3. Force HTTPS (if you have SSL)
Add to root `.htaccess` BEFORE other rules:
```apache
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

## Monitoring

### Check Error Logs
In cPanel:
1. Go to "Errors" or "Error Log"
2. Look for PHP errors, not bot attacks (404s for wp-admin, etc.)

### Check Application Logs
```bash
tail -f /home/notesofs/public_html/storage/logs/laravel.log
```

## Alternative: Move to Subdirectory

If issues persist, you can move the public folder to root:

```bash
# Move public folder contents to root
mv public/* ./
mv public/.htaccess ./

# Update index.php paths
# Change: require __DIR__.'/../vendor/autoload.php';
# To: require __DIR__.'/vendor/autoload.php';

# Change: $app = require_once __DIR__.'/../bootstrap/app.php';  
# To: $app = require_once __DIR__.'/bootstrap/app.php';
```

## Need Help?

If you're still experiencing issues:
1. Check the specific error in cPanel Error Log
2. Verify PHP version (Laravel 11 requires PHP 8.2+)
3. Contact your hosting provider about `.htaccess` restrictions
4. Consider using Forge or Vapor for easier Laravel deployment
