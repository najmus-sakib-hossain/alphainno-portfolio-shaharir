# Admin User Setup Guide

## Default Admin Credentials

- **Email:** `shahriar@gmail.com`
- **Password:** `shahriar@password`

## Setup Methods

### Method 1: Auto-Login Route (Easiest)

Simply visit this URL in your browser:
```
https://yourdomain.com/admin/auto-login
```

This will:
1. Create the admin user if it doesn't exist
2. Automatically log you in
3. Redirect to the admin dashboard

**Note:** This route will create the user with the credentials above if no user with that email exists.

### Method 2: Run Database Seeder (Recommended for Production)

SSH into your cPanel and run:

```bash
cd ~/public_html

# Run the seeder
/opt/cpanel/ea-php83/root/usr/bin/php artisan db:seed --class=AdminUserSeeder
```

Or use the helper script:

```bash
chmod +x create-admin-user.sh
./create-admin-user.sh
```

### Method 3: Manual Login

After creating the user (using Method 1 or 2):

1. Visit: `https://yourdomain.com/admin/login`
2. Enter:
   - Email: `shahriar@gmail.com`
   - Password: `shahriar@password`
3. Click Login

## For Local Development

Run the seeder:

```bash
php artisan db:seed --class=AdminUserSeeder
```

Then visit:
- Auto-login: `http://localhost:8000/admin/auto-login`
- Manual login: `http://localhost:8000/admin/login`

## Changing Admin Credentials

### Option 1: Update via Database

```bash
/opt/cpanel/ea-php83/root/usr/bin/php artisan tinker
```

Then in tinker:
```php
$user = App\Models\User::where('email', 'shahriar@gmail.com')->first();
$user->password = Hash::make('your-new-password');
$user->save();
exit
```

### Option 2: Update the Seeder

Edit `database/seeders/AdminUserSeeder.php` and change:

```php
'email' => 'your-new-email@example.com',
'password' => Hash::make('your-new-password'),
```

Then run:
```bash
/opt/cpanel/ea-php83/root/usr/bin/php artisan db:seed --class=AdminUserSeeder --force
```

### Option 3: Update via Profile

1. Log in to admin panel
2. Go to Profile settings
3. Update email/password
4. Save changes

## Troubleshooting

### "Call to undefined function mb_split()"

Enable mbstring extension in cPanel:
1. Go to **Software** → **Select PHP Version**
2. Click **Extensions**
3. Enable **mbstring**
4. Save

See [MBSTRING_FIX.md](MBSTRING_FIX.md) for details.

### "User not found" or "Invalid credentials"

Run the seeder again:
```bash
/opt/cpanel/ea-php83/root/usr/bin/php artisan db:seed --class=AdminUserSeeder
```

Or use the auto-login route:
```
https://yourdomain.com/admin/auto-login
```

### Auto-login not working

1. Clear cache:
   ```bash
   /opt/cpanel/ea-php83/root/usr/bin/php artisan cache:clear
   /opt/cpanel/ea-php83/root/usr/bin/php artisan config:clear
   ```

2. Check if sessions table exists:
   ```bash
   /opt/cpanel/ea-php83/root/usr/bin/php artisan migrate
   ```

3. Verify user was created:
   ```bash
   /opt/cpanel/ea-php83/root/usr/bin/php artisan tinker
   ```
   Then:
   ```php
   App\Models\User::where('email', 'shahriar@gmail.com')->first();
   exit
   ```

### "Too many redirects" after login

Clear browser cookies for the domain and try again.

## Security Recommendations

### For Production:

1. **Change the default password immediately after first login**
2. **Remove or protect the auto-login route** after setup:
   
   Comment out in `routes/web.php`:
   ```php
   // Route::get('/auto-login', function () {
   //     // ... auto-login code
   // });
   ```

3. **Enable two-factor authentication** (if available)

4. **Use strong, unique passwords**

5. **Regularly backup your database**

## Admin Routes

- Dashboard: `/admin`
- Login: `/admin/login`
- Auto-login: `/admin/auto-login` (remove in production!)
- Profile: `/admin/profile`
- Blogs: `/admin/blogs`
- Events: `/admin/events`
- And more...

## Post-Setup Checklist

- [ ] Admin user created successfully
- [ ] Able to log in with provided credentials
- [ ] Changed default password
- [ ] Removed/protected auto-login route
- [ ] Database migrations completed
- [ ] All required PHP extensions enabled
- [ ] Site accessible via domain
- [ ] SSL certificate installed (HTTPS)

## Support

If you encounter issues:
1. Check [CPANEL_DEPLOYMENT.md](CPANEL_DEPLOYMENT.md)
2. Review [MBSTRING_FIX.md](MBSTRING_FIX.md)
3. Check Laravel logs: `tail -f storage/logs/laravel.log`
4. Check cPanel logs: `tail -f ~/logs/error_log`
