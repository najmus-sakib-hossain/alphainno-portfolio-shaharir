# cPanel Web Server Configuration

## Important: Don't Use `artisan serve` in cPanel!

The `php artisan serve` command is **only for local development**. In cPanel, Apache/LiteSpeed is already running and will serve your application.

## Setup for cPanel

### Option 1: Public Directory Setup (Recommended)

If your files are in `public_html`, you need to point the web root to the `public` folder.

#### Method A: Using .htaccess Redirect

Create/update `.htaccess` in `public_html` root:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

#### Method B: Move Public Contents to Root

```bash
# Backup first
cp -r public public_backup

# Move public contents to root
cp -r public/* ./
cp public/.htaccess ./

# Optional: Delete empty public folder
# rm -rf public
```

### Option 2: Subdomain/Addon Domain

If using a subdomain or addon domain:
1. Go to cPanel → Domains → Manage
2. Edit the domain
3. Set "Document Root" to: `public_html/public`

## Required .htaccess in Public Directory

Make sure `public/.htaccess` (or root `.htaccess` if moved) contains:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

## Verify Setup

### 1. Check if .htaccess exists
```bash
ls -la public/.htaccess
# or if moved:
ls -la .htaccess
```

### 2. Check file permissions
```bash
chmod 644 public/.htaccess
# or if moved:
chmod 644 .htaccess
```

### 3. Test via browser
Visit your domain: `https://yourdomain.com`

## Common Issues

### "404 Not Found"
**Solution:** Check `.htaccess` exists and mod_rewrite is enabled

### "500 Internal Server Error"  
**Solution:** 
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Check cPanel error logs
tail -f ~/logs/error_log

# Fix permissions
chmod -R 755 storage bootstrap/cache
```

### "Blank Page"
**Solution:**
```bash
# Clear cache
/opt/cpanel/ea-php83/root/usr/bin/php artisan cache:clear
/opt/cpanel/ea-php83/root/usr/bin/php artisan config:clear
/opt/cpanel/ea-php83/root/usr/bin/php artisan view:clear
```

## Production Checklist

After deployment, run these commands:

```bash
# 1. Run migrations
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate --force

# 2. Clear all cache
/opt/cpanel/ea-php83/root/usr/bin/php artisan optimize:clear

# 3. Optimize for production
/opt/cpanel/ea-php83/root/usr/bin/php artisan optimize

# 4. Create storage link
/opt/cpanel/ea-php83/root/usr/bin/php artisan storage:link

# 5. Set permissions
chmod -R 755 storage bootstrap/cache
```

## Accessing Your Application

- **Local Development**: `php artisan serve` → http://localhost:8000
- **cPanel Production**: Direct domain access → https://yourdomain.com

**Note:** Never use `artisan serve` in production!

## PHP Configuration (if needed)

If you need to check PHP configuration:

```bash
# Check PHP version
/opt/cpanel/ea-php83/root/usr/bin/php -v

# Check PHP modules
/opt/cpanel/ea-php83/root/usr/bin/php -m

# Check specific setting
/opt/cpanel/ea-php83/root/usr/bin/php -i | grep proc_open
# Will show: disable_functions => proc_open (this is normal in cPanel)
```

## Next Steps

1. ✅ Run migrations (if not done already)
2. ✅ Set up .htaccess for web server
3. ✅ Visit your domain in browser
4. ✅ Check error logs if issues occur

## Summary

| Environment | How to Run |
|-------------|------------|
| **Local (XAMPP)** | `php artisan serve` |
| **cPanel Production** | Visit domain directly (Apache/LiteSpeed handles it) |

**You're all set!** Just access your domain through the browser. 🚀
