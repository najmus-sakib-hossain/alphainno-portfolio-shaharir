#!/bin/bash

# cPanel Laravel Setup & Migration Helper Script
# This script helps set up and run Laravel migrations in cPanel environment

echo "================================================"
echo "Laravel cPanel Setup & Migration Helper"
echo "================================================"
echo ""

# Common PHP paths in cPanel (prioritizing newer versions)
PHP_PATHS=(
    "/opt/cpanel/ea-php83/root/usr/bin/php"
    "/opt/cpanel/ea-php82/root/usr/bin/php"
    "/opt/cpanel/ea-php81/root/usr/bin/php"
    "/opt/cpanel/ea-php80/root/usr/bin/php"
    "/opt/cpanel/ea-php74/root/usr/bin/php"
    "/usr/local/bin/php"
    "/usr/bin/php"
)

WORKING_PHP=""

echo "Checking PHP versions and PDO support..."
echo ""

for PHP_PATH in "${PHP_PATHS[@]}"; do
    if [ -f "$PHP_PATH" ]; then
        echo "Testing: $PHP_PATH"
        PDO_CHECK=$($PHP_PATH -m 2>/dev/null | grep -i "^PDO$")
        PDO_MYSQL=$($PHP_PATH -m 2>/dev/null | grep -i "^pdo_mysql$")
        VERSION=$($PHP_PATH -v 2>/dev/null | head -n 1)
        
        if [ ! -z "$PDO_CHECK" ] && [ ! -z "$PDO_MYSQL" ]; then
            echo "  ✓ PDO is available"
            echo "  ✓ PDO MySQL is available"
            echo "  Version: $VERSION"
            WORKING_PHP="$PHP_PATH"
            break
        else
            echo "  ✗ PDO or PDO MySQL not available"
        fi
        echo ""
    fi
done

if [ -z "$WORKING_PHP" ]; then
    echo "ERROR: No PHP binary with PDO + PDO MySQL support found!"
    echo ""
    echo "Please contact your hosting provider to enable PDO and PDO MySQL extensions."
    exit 1
fi

echo "================================================"
echo "Using PHP: $WORKING_PHP"
echo "================================================"
echo ""

# Check if .env file exists
if [ ! -f ".env" ]; then
    echo "⚠ WARNING: .env file not found!"
    echo ""
    echo "Creating .env from template..."
    
    if [ -f ".env.cpanel" ]; then
        cp .env.cpanel .env
        echo "✓ Created .env from .env.cpanel template"
        echo ""
        echo "❗ IMPORTANT: Edit .env file and update:"
        echo "   - DB_DATABASE=your_database_name"
        echo "   - DB_USERNAME=your_database_user"
        echo "   - DB_PASSWORD=your_database_password"
        echo "   - APP_URL=https://yourdomain.com"
        echo ""
        echo "Then run this script again."
        exit 1
    elif [ -f ".env.example" ]; then
        cp .env.example .env
        echo "✓ Created .env from .env.example template"
        echo ""
        echo "❗ IMPORTANT: Edit .env file and update database credentials"
        echo "Then run this script again."
        exit 1
    else
        echo "✗ No .env template found!"
        exit 1
    fi
fi

# Check if APP_KEY is set
APP_KEY=$(grep "APP_KEY=" .env | cut -d '=' -f2)
if [ -z "$APP_KEY" ]; then
    echo "Generating application key..."
    $WORKING_PHP artisan key:generate
    echo "✓ Application key generated"
    echo ""
fi

# Set proper permissions
echo "Setting proper permissions..."
chmod -R 755 storage bootstrap/cache 2>/dev/null
chmod -R 775 storage 2>/dev/null
chmod -R 775 bootstrap/cache 2>/dev/null
echo "✓ Permissions set"
echo ""

# Run migrations
echo "Running database migrations..."
echo ""
$WORKING_PHP artisan migrate --force

MIGRATE_STATUS=$?

if [ $MIGRATE_STATUS -eq 0 ]; then
    echo ""
    echo "================================================"
    echo "✓ Migration completed successfully!"
    echo "================================================"
    echo ""
    echo "You can now use this PHP path for artisan commands:"
    echo "  $WORKING_PHP artisan [command]"
    echo ""
    echo "Or create an alias by adding this to ~/.bashrc:"
    echo "  alias artisan='$WORKING_PHP artisan'"
    echo ""
else
    echo ""
    echo "================================================"
    echo "✗ Migration failed!"
    echo "================================================"
    echo ""
    echo "Please check:"
    echo "  1. Database credentials in .env file"
    echo "  2. Database exists in cPanel MySQL Databases"
    echo "  3. User has proper privileges on the database"
    echo ""
fi

exit $MIGRATE_STATUS
