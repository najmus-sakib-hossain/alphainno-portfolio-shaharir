# Laravel Deployment Guide for cPanel

## Prerequisites

✅ PHP 8.3 with PDO extension (available at `/opt/cpanel/ea-php83/root/usr/bin/php`)  
✅ MySQL database created in cPanel  
✅ Composer installed  
✅ All project files uploaded to `public_html`

---

## Step-by-Step Deployment

### 1. **Create MySQL Database in cPanel**

1. Log into cPanel
2. Go to **MySQL Databases**
3. Create a new database (e.g., `username_laravel`)
4. Create a database user
5. Add the user to the database with **ALL PRIVILEGES**
6. Note down:
   - Database name
   - Database username
   - Database password

### 2. **Configure Environment File**

Copy the cPanel template and update with your credentials:

```bash
cd ~/public_html
cp .env.cpanel .env
nano .env
```

Update these values in `.env`:

```env
APP_NAME="Your App Name"
APP_ENV=production
APP_KEY=  # Will generate in next step
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_actual_database_name
DB_USERNAME=your_actual_database_user
DB_PASSWORD=your_actual_database_password
```

Save and exit (Ctrl+X, then Y, then Enter)

### 3. **Generate Application Key**

```bash
/opt/cpanel/ea-php83/root/usr/bin/php artisan key:generate
```

### 4. **Set Proper Permissions**

```bash
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 5. **Run Migrations**

```bash
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate
```

If prompted "Do you really wish to run this command?" type `yes`

### 6. **Optimize for Production**

```bash
/opt/cpanel/ea-php83/root/usr/bin/php artisan config:cache
/opt/cpanel/ea-php83/root/usr/bin/php artisan route:cache
/opt/cpanel/ea-php83/root/usr/bin/php artisan view:cache
```

### 7. **Create PHP Alias (Optional but Recommended)**

To avoid typing the full PHP path every time:

```bash
echo 'alias php83="/opt/cpanel/ea-php83/root/usr/bin/php"' >> ~/.bashrc
echo 'alias artisan="/opt/cpanel/ea-php83/root/usr/bin/php artisan"' >> ~/.bashrc
source ~/.bashrc
```

Now you can simply run:
```bash
artisan migrate
artisan cache:clear
```

---

## Common Artisan Commands

With the alias set up:

```bash
# Run migrations
artisan migrate

# Seed database
artisan db:seed

# Clear caches
artisan cache:clear
artisan config:clear
artisan route:clear
artisan view:clear

# Optimize for production
artisan optimize
```

Without alias (use full PHP path):

```bash
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate
/opt/cpanel/ea-php83/root/usr/bin/php artisan cache:clear
```

---

## Troubleshooting

### Issue: "Class 'PDO' not found"

**Solution:** Make sure you're using PHP 8.3:
```bash
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate
```

### Issue: "Access denied for user"

**Solution:** Check your `.env` database credentials match what you created in cPanel MySQL Databases.

### Issue: "Permission denied" errors

**Solution:** Fix permissions:
```bash
chmod -R 755 storage bootstrap/cache
chown -R $USER:$USER storage bootstrap/cache
```

### Issue: Changes not reflecting

**Solution:** Clear all caches:
```bash
/opt/cpanel/ea-php83/root/usr/bin/php artisan optimize:clear
```

---

## File Structure in cPanel

```
~/public_html/              # Your Laravel project
├── app/
├── bootstrap/
├── config/
├── database/
├── public/                 # Document root should point here
│   ├── index.php
│   └── ...
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env                    # Your environment config
└── artisan
```

**Important:** In cPanel, set your document root to `public_html/public` directory, not `public_html`.

---

## Security Checklist

- [ ] `APP_DEBUG=false` in production
- [ ] `APP_ENV=production`
- [ ] Strong `APP_KEY` generated
- [ ] `.env` file is NOT publicly accessible
- [ ] Storage and cache directories have proper permissions
- [ ] Database credentials are secure
- [ ] Document root points to `/public` directory

---

## Quick Reference

**PHP 8.3 Path:** `/opt/cpanel/ea-php83/root/usr/bin/php`

**Common Commands:**
```bash
# Generate key
/opt/cpanel/ea-php83/root/usr/bin/php artisan key:generate

# Run migrations
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate

# Clear cache
/opt/cpanel/ea-php83/root/usr/bin/php artisan cache:clear

# Optimize
/opt/cpanel/ea-php83/root/usr/bin/php artisan optimize
```
