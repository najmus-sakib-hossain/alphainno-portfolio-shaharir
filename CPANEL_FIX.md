# cPanel PDO Error Fix

## Problem
Getting "Class 'PDO' not found" error when running `php artisan migrate` in cPanel terminal.

## Solution

### Option 1: Use the Helper Script (Easiest)

1. Upload `cpanel-migrate.sh` to your public_html directory
2. Make it executable and run it:

```bash
cd ~/public_html
chmod +x cpanel-migrate.sh
./cpanel-migrate.sh
```

The script will automatically find the correct PHP version with PDO support and run migrations.

### Option 2: Manual PHP Path

1. Find the correct PHP binary with PDO support:

```bash
# Check PHP 8.2
/opt/cpanel/ea-php82/root/usr/bin/php -m | grep PDO

# Check PHP 8.1
/opt/cpanel/ea-php81/root/usr/bin/php -m | grep PDO

# Check PHP 8.0
/opt/cpanel/ea-php80/root/usr/bin/php -m | grep PDO
```

2. Once you find one that shows "PDO", use it to run artisan:

```bash
/opt/cpanel/ea-php82/root/usr/bin/php artisan migrate
```

### Option 3: Create an Alias

Add this to your `~/.bashrc` file:

```bash
# Replace with the PHP path that works for you
alias phppdo='/opt/cpanel/ea-php82/root/usr/bin/php'
```

Then reload:
```bash
source ~/.bashrc
phppdo artisan migrate
```

### Option 4: Contact Hosting Provider

If none of the above work, contact your hosting provider and ask them to:
1. Enable PDO extension for PHP CLI
2. Enable pdo_sqlite extension (since you're using SQLite)

## Common cPanel PHP Paths

- PHP 8.2: `/opt/cpanel/ea-php82/root/usr/bin/php`
- PHP 8.1: `/opt/cpanel/ea-php81/root/usr/bin/php`
- PHP 8.0: `/opt/cpanel/ea-php80/root/usr/bin/php`
- PHP 7.4: `/opt/cpanel/ea-php74/root/usr/bin/php`

## Verify PDO is Available

```bash
php -m | grep PDO
```

Should output:
```
PDO
pdo_sqlite
```

## Alternative: Switch to MySQL

If SQLite continues to cause issues, you can switch to MySQL (most cPanel accounts have this):

1. Create a MySQL database in cPanel
2. Update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

3. Run migrations:
```bash
/opt/cpanel/ea-php82/root/usr/bin/php artisan migrate
```
