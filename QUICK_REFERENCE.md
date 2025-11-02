# Quick Reference - cPanel Commands

## PHP Path
```bash
/opt/cpanel/ea-php83/root/usr/bin/php
```

## Common Commands

### One-Time Setup
```bash
# Create .env file
cp .env.cpanel .env
nano .env  # Edit database credentials

# Generate application key
/opt/cpanel/ea-php83/root/usr/bin/php artisan key:generate

# Set permissions
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Run migrations
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate
```

### Daily Commands
```bash
# Run migrations
/opt/cpanel/ea-php83/root/usr/bin/php artisan migrate

# Clear cache
/opt/cpanel/ea-php83/root/usr/bin/php artisan cache:clear

# Clear all caches
/opt/cpanel/ea-php83/root/usr/bin/php artisan optimize:clear

# Optimize for production
/opt/cpanel/ea-php83/root/usr/bin/php artisan optimize
```

## Create Alias (Recommended)

Add to `~/.bashrc`:
```bash
echo 'alias php83="/opt/cpanel/ea-php83/root/usr/bin/php"' >> ~/.bashrc
echo 'alias artisan="/opt/cpanel/ea-php83/root/usr/bin/php artisan"' >> ~/.bashrc
source ~/.bashrc
```

Then use simply:
```bash
artisan migrate
artisan cache:clear
artisan optimize
```

## Database Configuration

Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_cpanel_database_name
DB_USERNAME=your_cpanel_database_user
DB_PASSWORD=your_cpanel_database_password
```

## Automated Setup

Use the helper script:
```bash
chmod +x cpanel-migrate.sh
./cpanel-migrate.sh
```
