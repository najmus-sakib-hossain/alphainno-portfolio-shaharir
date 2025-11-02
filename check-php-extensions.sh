#!/bin/bash

#########################################
# Laravel PHP Extension Checker for cPanel
#########################################

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

echo "=========================================="
echo "  Laravel PHP Extension Checker"
echo "=========================================="
echo ""

# Find PHP with PDO support
PHP_BIN="/opt/cpanel/ea-php83/root/usr/bin/php"

if [ ! -f "$PHP_BIN" ]; then
    # Fallback to other versions
    for VERSION in 82 81 80; do
        TEST_PHP="/opt/cpanel/ea-php$VERSION/root/usr/bin/php"
        if [ -f "$TEST_PHP" ]; then
            PHP_BIN="$TEST_PHP"
            break
        fi
    done
fi

echo "Using PHP: $PHP_BIN"
echo ""

# Check PHP version
echo "PHP Version:"
$PHP_BIN -v | head -n 1
echo ""

# Required Laravel extensions
REQUIRED_EXTENSIONS=(
    "PDO"
    "pdo_mysql"
    "mbstring"
    "xml"
    "ctype"
    "json"
    "bcmath"
    "openssl"
    "tokenizer"
    "fileinfo"
    "curl"
)

echo "Checking Required Laravel Extensions:"
echo "=========================================="

MISSING_EXTENSIONS=()
INSTALLED_EXTENSIONS=()

for EXT in "${REQUIRED_EXTENSIONS[@]}"; do
    # Check if extension is loaded
    CHECK=$($PHP_BIN -m 2>/dev/null | grep -i "^$EXT$")
    
    if [ ! -z "$CHECK" ]; then
        echo -e "${GREEN}✓${NC} $EXT"
        INSTALLED_EXTENSIONS+=("$EXT")
    else
        echo -e "${RED}✗${NC} $EXT (MISSING)"
        MISSING_EXTENSIONS+=("$EXT")
    fi
done

echo ""
echo "=========================================="
echo ""

if [ ${#MISSING_EXTENSIONS[@]} -eq 0 ]; then
    echo -e "${GREEN}SUCCESS!${NC} All required extensions are installed."
    echo ""
    echo "You can now run:"
    echo "  $PHP_BIN artisan migrate"
else
    echo -e "${RED}MISSING EXTENSIONS:${NC}"
    for EXT in "${MISSING_EXTENSIONS[@]}"; do
        echo "  - $EXT"
    done
    echo ""
    echo -e "${YELLOW}ACTION REQUIRED:${NC}"
    echo ""
    echo "Please enable these extensions in cPanel:"
    echo "1. Go to cPanel → Software → Select PHP Version"
    echo "2. Click on 'Extensions' or 'Options'"
    echo "3. Enable the missing extensions listed above"
    echo "4. Save changes"
    echo ""
    echo "Or use: cPanel → Software → MultiPHP INI Editor"
    echo ""
fi

# Show all loaded extensions for reference
echo "=========================================="
echo "All Currently Loaded Extensions:"
echo "=========================================="
$PHP_BIN -m

exit 0
