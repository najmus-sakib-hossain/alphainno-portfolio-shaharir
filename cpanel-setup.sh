#!/bin/bash

#########################################
# Laravel cPanel Deployment Setup Script
#########################################

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo "=========================================="
echo "  Laravel cPanel Deployment Setup"
echo "=========================================="
echo ""

# Find PHP with PDO support
echo "Finding PHP with PDO support..."
PHP_PATHS=(
    "/opt/cpanel/ea-php83/root/usr/bin/php"
    "/opt/cpanel/ea-php82/root/usr/bin/php"
    "/opt/cpanel/ea-php81/root/usr/bin/php"
    "/opt/cpanel/ea-php80/root/usr/bin/php"
)

PHP_BIN=""
for PHP_PATH in "${PHP_PATHS[@]}"; do
    if [ -f "$PHP_PATH" ]; then
        PDO_CHECK=$($PHP_PATH -m 2>/dev/null | grep -i "^PDO$")
        if [ ! -z "$PDO_CHECK" ]; then
            PHP_BIN="$PHP_PATH"
            echo -e "${GREEN}✓${NC} Found PHP with PDO: $PHP_BIN"
            break
        fi
    fi
done

if [ -z "$PHP_BIN" ]; then
    echo -e "${RED}✗${NC} Error: No PHP binary with PDO support found!"
    exit 1
fi

# Check if .env exists
if [ ! -f ".env" ]; then
    echo -e "${YELLOW}!${NC} .env file not found. Creating from template..."
    if [ -f ".env.cpanel" ]; then
        cp .env.cpanel .env
        echo -e "${GREEN}✓${NC} Created .env from .env.cpanel"
    elif [ -f ".env.example" ]; then
        cp .env.example .env
        echo -e "${GREEN}✓${NC} Created .env from .env.example"
    else
        echo -e "${RED}✗${NC} Error: No .env template found!"
        exit 1
    fi
    
    echo ""
    echo -e "${YELLOW}IMPORTANT:${NC} Please edit .env and configure your database credentials:"
    echo "  - DB_DATABASE"
    echo "  - DB_USERNAME"
    echo "  - DB_PASSWORD"
    echo ""
    echo "Then run this script again."
    exit 0
fi

echo -e "${GREEN}✓${NC} .env file exists"

# Check if APP_KEY is set
APP_KEY=$(grep "^APP_KEY=" .env | cut -d '=' -f2)
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo "Generating application key..."
    $PHP_BIN artisan key:generate
    echo -e "${GREEN}✓${NC} Application key generated"
else
    echo -e "${GREEN}✓${NC} Application key already set"
fi

# Check database connection
echo ""
echo "Testing database connection..."
DB_TEST=$($PHP_BIN artisan db:show 2>&1)
if [ $? -eq 0 ]; then
    echo -e "${GREEN}✓${NC} Database connection successful"
else
    echo -e "${RED}✗${NC} Database connection failed!"
    echo ""
    echo "Please check your .env file and ensure:"
    echo "  1. Database exists in cPanel"
    echo "  2. DB_DATABASE, DB_USERNAME, DB_PASSWORD are correct"
    echo "  3. Database user has proper privileges"
    exit 1
fi

# Install dependencies
echo ""
echo "Installing Composer dependencies..."
if command -v composer &> /dev/null; then
    composer install --optimize-autoloader --no-dev
    echo -e "${GREEN}✓${NC} Dependencies installed"
else
    echo -e "${YELLOW}!${NC} Composer not found. Skipping dependency installation."
    echo "   Please run: composer install --optimize-autoloader --no-dev"
fi

# Set permissions
echo ""
echo "Setting file permissions..."
chmod -R 755 storage bootstrap/cache 2>/dev/null
chmod -R 775 storage 2>/dev/null
chmod -R 775 bootstrap/cache 2>/dev/null
echo -e "${GREEN}✓${NC} Permissions set"

# Run migrations
echo ""
read -p "Do you want to run migrations now? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo "Running migrations..."
    $PHP_BIN artisan migrate --force
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✓${NC} Migrations completed successfully"
    else
        echo -e "${RED}✗${NC} Migrations failed!"
        exit 1
    fi
fi

# Optimize for production
echo ""
read -p "Do you want to optimize for production? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo "Optimizing application..."
    $PHP_BIN artisan config:cache
    $PHP_BIN artisan route:cache
    $PHP_BIN artisan view:cache
    echo -e "${GREEN}✓${NC} Application optimized"
fi

# Create storage link
echo ""
if [ ! -L "public/storage" ]; then
    echo "Creating storage link..."
    $PHP_BIN artisan storage:link
    echo -e "${GREEN}✓${NC} Storage link created"
fi

echo ""
echo "=========================================="
echo -e "${GREEN}  Setup Complete!${NC}"
echo "=========================================="
echo ""
echo "Useful commands for this server:"
echo "  Artisan: $PHP_BIN artisan"
echo ""
echo "Common tasks:"
echo "  • Run migrations: $PHP_BIN artisan migrate"
echo "  • Clear cache: $PHP_BIN artisan cache:clear"
echo "  • View routes: $PHP_BIN artisan route:list"
echo ""
echo "Add this alias to ~/.bashrc for easier use:"
echo "  alias art='$PHP_BIN artisan'"
echo ""
