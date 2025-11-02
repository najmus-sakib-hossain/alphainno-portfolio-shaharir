# .htaccess Being Removed - Quick Fix

## Why This Happens
cPanel/LiteSpeed servers sometimes remove `.htaccess` files if they contain:
- Invalid syntax
- Unsafe directives
- Options that conflict with server configuration

## Immediate Actions

### 1. Check File Permissions
```bash
chmod 644 /home/notesofs/public_html/.htaccess
chmod 644 /home/notesofs/public_html/public/.htaccess
```

### 2. Verify Ownership
```bash
chown notesofs:notesofs /home/notesofs/public_html/.htaccess
chown notesofs:notesofs /home/notesofs/public_html/public/.htaccess
```

### 3. Test Configuration
After uploading, immediately check if file still exists:
```bash
ls -la /home/notesofs/public_html/.htaccess
```

## If Problem Persists

### Option A: Contact Hosting Support
Ask them:
1. Why is `.htaccess` being removed?
2. Are there any restricted directives?
3. What is the recommended `.htaccess` for Laravel?

### Option B: Use Even Simpler .htaccess
Replace root `.htaccess` with minimal version:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### Option C: Alternative Setup (No Root .htaccess)
If root `.htaccess` keeps getting removed:

1. Move all contents of `public/` to root
2. Delete the `public/` folder
3. Update `index.php` paths
4. Use only the public `.htaccess` in root

**Update index.php:**
```php
// Change these lines:
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
```

## Security Note
The 403/404 errors for files like `wp-admin`, `shell.php`, etc. are normal.
These are bots scanning for WordPress/vulnerable installations. Ignore them.

## Check Server Logs
Look for the actual reason in cPanel Error Log:
- Login to cPanel
- Click "Errors" under "Metrics"
- Look for entries about `.htaccess`

Common messages:
- "Invalid command" - Specific directive not allowed
- "Options not allowed" - Options directive restricted
- "Security violation" - Mod_security blocking it
