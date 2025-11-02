# Quick Reference - cPanel Commands

## PHP Binary Path
```bash
# Use this PHP path for all artisan commands in cPanel
/opt/cpanel/ea-php83/root/usr/bin/php
```

## Common Artisan Commands

### Migrations
```bash
# Run migrations
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate

# Rollback last migration
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate:rollback

# Reset all migrations
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate:reset

# Refresh migrations (rollback all + migrate)
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate:refresh

# Check migration status
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate:status
```

### Cache Management
```bash
# Clear all caches
/opt/cpanel/ea-php83/root/usr/bin/php artisan cache:clear
/opt/cpanel/ea-php83/root/usr/bin/php artisan config:clear
/opt/cpanel/ea-php83/root/usr/bin/php artisan route:clear
/opt/cpanel/ea-php83/root/usr/bin/php artisan view:clear

# Cache for production
/opt/cpanel/ea-php83/root/usr/bin/php artisan config:cache
/opt/cpanel/ea-php83/root/usr/bin/php artisan route:cache
/opt/cpanel/ea-php83/root/usr/bin/php artisan view:cache

# Optimize (cache config + routes)
/opt/cpanel/ea-php83/root/usr/bin/php artisan optimize

# Clear optimization
/opt/cpanel/ea-php83/root/usr/bin/php artisan optimize:clear
```

### Application Management
```bash
# Generate app key
/opt/cpanel/ea-php83/root/usr/bin/php artisan key:generate

# Create storage link
/opt/cpanel/ea-php83/root/usr/bin/php artisan storage:link

# Enter maintenance mode
/opt/cpanel/ea-php83/root/usr/bin/php artisan down

# Exit maintenance mode
/opt/cpanel/ea-php83/root/usr/bin/php artisan up

# Show application info
/opt/cpanel/ea-php83/root/usr/bin/php artisan about

# List all routes
/opt/cpanel/ea-php83/root/usr/bin/php artisan route:list
```

### Database
```bash
# Show database info
/opt/cpanel/ea-php83/root/usr/bin/php artisan db:show

# Test database connection
/opt/cpanel/ea-php83/root/usr/bin/php artisan db:table users
```

## File Permissions

```bash
# Set standard permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Fix ownership (if needed)
chown -R $USER:$USER storage bootstrap/cache
```

## Composer Commands

```bash
# Install production dependencies
composer install --optimize-autoloader --no-dev

# Install all dependencies (dev included)
composer install

# Update dependencies
composer update

# Dump autoload
composer dump-autoload
```

## Git Commands

```bash
# Pull latest changes
git pull origin main

# Check status
git status

# View recent commits
git log --oneline -5

# Discard local changes
git reset --hard origin/main
```

## Useful Aliases

Add these to `~/.bashrc`:

```bash
# Laravel artisan shortcut
alias art='/opt/cpanel/ea-php83/root/usr/bin/php artisan'

# Navigate to project
alias cdweb='cd ~/public_html'

# View Laravel logs
alias laravellogs='tail -f ~/public_html/storage/logs/laravel.log'

# View cPanel error logs
alias errorlogs='tail -f ~/logs/error_log'
```

Apply aliases:
```bash
source ~/.bashrc
```

Then use them:
```bash
art migrate
art cache:clear
cdweb
laravellogs
```

## Deployment Checklist

```bash
# 1. Pull latest code
git pull origin main

# 2. Install dependencies
composer install --optimize-autoloader --no-dev

# 3. Run migrations
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate --force

# 4. Clear old cache
/opt/cpanel/ea-php83/root/usr/bin/php artisan optimize:clear

# 5. Cache for production
/opt/cpanel/ea-php83/root/usr/bin/php artisan optimize

# 6. Verify .env settings
cat .env | grep -E "APP_ENV|APP_DEBUG|DB_"
```

## Environment Variables Quick Check

```bash
# View specific env variables
cat .env | grep APP_
cat .env | grep DB_

# Check if app key is set
cat .env | grep APP_KEY

# Verify production settings
cat .env | grep -E "APP_ENV|APP_DEBUG"
# Should show: APP_ENV=production and APP_DEBUG=false
```

## Log Viewing

```bash
# View Laravel logs (last 50 lines)
tail -n 50 storage/logs/laravel.log

# Follow Laravel logs (real-time)
tail -f storage/logs/laravel.log

# View cPanel error logs
tail -n 50 ~/logs/error_log

# Follow cPanel error logs (real-time)
tail -f ~/logs/error_log

# Search for errors in logs
grep -i "error" storage/logs/laravel.log | tail -20
```

## Troubleshooting

```bash
# Check PHP version and modules
/opt/cpanel/ea-php83/root/usr/bin/php -v
/opt/cpanel/ea-php83/root/usr/bin/php -m | grep -i pdo

# Check disk space
df -h

# Check file permissions
ls -la storage/
ls -la bootstrap/cache/

# Test database connection
/opt/cpanel/ea-php83/root/usr/bin/php artisan tinker
# Then: DB::connection()->getPdo();
# Press Ctrl+C to exit

# Clear everything and start fresh
/opt/cpanel/ea-php83/root/usr/bin/php artisan optimize:clear
chmod -R 775 storage bootstrap/cache
/opt/cpanel/ea-php83/root/usr/bin/php artisan optimize
```

## One-Line Deployment

```bash
git pull && composer install --no-dev && /opt/cpanel/ea-php83/root/usr/bin/php artisan migrate --force && /opt/cpanel/ea-php83/root/usr/bin/php artisan optimize
```
