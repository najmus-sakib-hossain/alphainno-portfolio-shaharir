#!/bin/bash

#########################################
# Create Admin User for Laravel
#########################################

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Find PHP with PDO support
PHP_BIN="/opt/cpanel/ea-php83/root/usr/bin/php"

if [ ! -f "$PHP_BIN" ]; then
    for VERSION in 82 81 80; do
        TEST_PHP="/opt/cpanel/ea-php$VERSION/root/usr/bin/php"
        if [ -f "$TEST_PHP" ]; then
            PHP_BIN="$TEST_PHP"
            break
        fi
    done
fi

echo "=========================================="
echo "  Creating Admin User"
echo "=========================================="
echo ""
echo "Using PHP: $PHP_BIN"
echo ""

# Run the seeder
echo "Creating admin user..."
$PHP_BIN artisan db:seed --class=AdminUserSeeder

if [ $? -eq 0 ]; then
    echo ""
    echo -e "${GREEN}SUCCESS!${NC} Admin user created/verified."
    echo ""
    echo "Admin Credentials:"
    echo "  Email: shahriar@gmail.com"
    echo "  Password: shahriar@password"
    echo ""
    echo "You can now:"
    echo "  1. Visit: https://yourdomain.com/admin/auto-login"
    echo "  2. Or login at: https://yourdomain.com/admin/login"
    echo ""
else
    echo ""
    echo -e "${YELLOW}Note:${NC} If seeder failed, you can use the auto-login route:"
    echo "  Visit: https://yourdomain.com/admin/auto-login"
    echo ""
    echo "This will automatically create the user and log you in."
fi
