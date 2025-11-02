# cPanel mbstring Extension Fix

## The Problem

You're getting this error:
```
Call to undefined function Illuminate\Support\mb_split()
```

This means the **mbstring** PHP extension is not enabled in your cPanel PHP configuration.

## Quick Fix (Do This Now!)

### Step 1: Enable mbstring in cPanel

**Option A: Using Select PHP Version (Easiest)**

1. Log in to your cPanel
2. Find **Software** section
3. Click **Select PHP Version**
4. Click **Extensions** or **Options** tab
5. Scroll down and check the box for **mbstring**
6. Click **Save** or **Apply**
7. Wait a few seconds for changes to apply

**Option B: Using MultiPHP INI Editor**

1. Log in to your cPanel
2. Go to **Software** → **MultiPHP INI Editor**
3. Select your domain from dropdown
4. Look for a line with `mbstring` or add: `extension=mbstring`
5. Save changes

### Step 2: Verify It's Enabled

SSH into your cPanel and run:

```bash
/opt/cpanel/ea-php83/root/usr/bin/php -m | grep mbstring
```

Should output: `mbstring`

If it does, you're good to go!

### Step 3: Try Again

```bash
# Clear cache first
/opt/cpanel/ea-php83/root/usr/bin/php artisan cache:clear
/opt/cpanel/ea-php83/root/usr/bin/php artisan config:clear
/opt/cpanel/ea-php83/root/usr/bin/php artisan view:clear

# Then visit your site in browser
```

## Using the Extension Checker Script

I've created a script to check all required Laravel extensions:

```bash
# Upload check-php-extensions.sh to your server, then:
cd ~/public_html
chmod +x check-php-extensions.sh
./check-php-extensions.sh
```

This will show you:
- ✓ Which extensions are installed
- ✗ Which extensions are missing
- Instructions on how to enable them

## All Required Laravel Extensions

Make sure these are enabled in cPanel:

| Extension | Purpose | Usually Enabled? |
|-----------|---------|------------------|
| PDO | Database connection | ✓ Yes |
| pdo_mysql | MySQL driver | ✓ Yes |
| **mbstring** | Multibyte strings | ⚠️ Often missing |
| xml | XML parsing | ✓ Usually yes |
| ctype | Character type checking | ✓ Yes |
| json | JSON support | ✓ Yes |
| bcmath | Arbitrary precision math | ⚠️ Sometimes missing |
| openssl | Encryption | ✓ Yes |
| tokenizer | PHP tokenizer | ✓ Yes |
| fileinfo | File information | ✓ Usually yes |
| curl | HTTP requests | ✓ Yes |

## If You Can't Enable mbstring

If you don't have access to enable PHP extensions, contact your hosting provider and ask them to enable:
- `mbstring`
- `bcmath` (if also missing)
- Any other missing extensions from the list above

Most hosts will enable these immediately as they're standard Laravel requirements.

## After Enabling Extensions

1. **Clear all cache:**
   ```bash
   /opt/cpanel/ea-php83/root/usr/bin/php artisan optimize:clear
   ```

2. **Rebuild cache:**
   ```bash
   /opt/cpanel/ea-php83/root/usr/bin/php artisan optimize
   ```

3. **Test in browser:**
   Visit your domain and it should work!

## Common Questions

**Q: Why isn't mbstring enabled by default?**
A: Some cPanel configurations have minimal PHP extensions enabled by default for security/performance. You need to enable what you need.

**Q: Will this affect other sites on my cPanel?**
A: No, if using MultiPHP, extensions are per-domain/version. If using single PHP, it affects all sites (but mbstring is safe for all PHP apps).

**Q: Do I need to restart anything?**
A: No, PHP extension changes take effect immediately.

**Q: What if I can't find "Select PHP Version" in cPanel?**
A: Look for "MultiPHP Manager" or contact your host. Some shared hosting may not allow extension changes.

## Verification Command

After enabling, verify everything works:

```bash
/opt/cpanel/ea-php83/root/usr/bin/php artisan about
```

Should show no errors and display your application info.

## Still Having Issues?

1. Check PHP error logs:
   ```bash
   tail -f ~/public_html/storage/logs/laravel.log
   tail -f ~/logs/error_log
   ```

2. Make sure you're using the correct PHP version:
   ```bash
   /opt/cpanel/ea-php83/root/usr/bin/php -v
   ```

3. List all loaded extensions:
   ```bash
   /opt/cpanel/ea-php83/root/usr/bin/php -m
   ```

That's it! Enable mbstring and your Laravel app should work. 🚀
