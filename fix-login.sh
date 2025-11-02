#!/bin/bash

#########################################
# Laravel Login Diagnostic & Fix Script
#########################################

RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m'

PHP_BIN="/opt/cpanel/ea-php83/root/usr/bin/php"

echo "=========================================="
echo "  Laravel Login Diagnostic & Fix"
echo "=========================================="
echo ""

# Check if user exists
echo "1. Checking if admin user exists..."
USER_CHECK=$($PHP_BIN artisan tinker --execute="echo App\Models\User::where('email', 'shahriar@gmail.com')->count();" 2>&1 | tail -1)

if [ "$USER_CHECK" = "0" ]; then
    echo -e "${RED}✗${NC} User does not exist!"
    echo ""
    echo "Creating admin user..."
    $PHP_BIN artisan db:seed --class=AdminUserSeeder
    echo -e "${GREEN}✓${NC} User created!"
else
    echo -e "${GREEN}✓${NC} User exists"
fi

echo ""
echo "2. Checking user details..."
$PHP_BIN artisan tinker --execute="
\$user = App\Models\User::where('email', 'shahriar@gmail.com')->first();
if (\$user) {
    echo 'ID: ' . \$user->id . PHP_EOL;
    echo 'Name: ' . \$user->name . PHP_EOL;
    echo 'Email: ' . \$user->email . PHP_EOL;
    echo 'Email Verified: ' . (\$user->email_verified_at ? 'Yes' : 'No') . PHP_EOL;
    echo 'Password Hash: ' . substr(\$user->password, 0, 20) . '...' . PHP_EOL;
}
"

echo ""
echo "3. Resetting password to ensure it's correct..."
$PHP_BIN artisan tinker --execute="
\$user = App\Models\User::where('email', 'shahriar@gmail.com')->first();
if (\$user) {
    \$user->password = Hash::make('shahriar@password');
    \$user->email_verified_at = now();
    \$user->save();
    echo 'Password reset successfully!';
} else {
    echo 'User not found!';
}
"

echo ""
echo ""
echo "4. Clearing all caches..."
$PHP_BIN artisan cache:clear
$PHP_BIN artisan config:clear
$PHP_BIN artisan route:clear
$PHP_BIN artisan view:clear

echo ""
echo "5. Checking sessions table..."
SESSION_CHECK=$($PHP_BIN artisan tinker --execute="
try {
    DB::table('sessions')->count();
    echo 'Sessions table exists';
} catch (Exception \$e) {
    echo 'Sessions table missing or error';
}
" 2>&1 | tail -1)

echo "$SESSION_CHECK"

if [[ "$SESSION_CHECK" == *"missing"* ]] || [[ "$SESSION_CHECK" == *"error"* ]]; then
    echo ""
    echo "Running migrations..."
    $PHP_BIN artisan migrate --force
fi

echo ""
echo "6. Setting correct permissions..."
chmod -R 775 storage bootstrap/cache
chmod -R 777 storage/framework/sessions

echo ""
echo "=========================================="
echo -e "${GREEN}  Fix Complete!${NC}"
echo "=========================================="
echo ""
echo "Credentials:"
echo "  Email: shahriar@gmail.com"
echo "  Password: shahriar@password"
echo ""
echo "Try logging in at:"
echo "  https://notesofshahriar.com/admin/login"
echo ""
echo "Or use auto-login:"
echo "  https://notesofshahriar.com/admin/auto-login"
echo ""
