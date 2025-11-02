<?php

/**
 * Login Diagnostic and Fix Script
 * Upload this file to public_html and visit it in your browser
 */

// Bootstrap Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Fix Tool</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        .warning { color: orange; font-weight: bold; }
        .box { background: #f5f5f5; padding: 15px; margin: 10px 0; border-radius: 5px; }
        button { background: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; margin: 5px; }
        button:hover { background: #45a049; }
        .danger { background: #f44336; }
        .danger:hover { background: #da190b; }
    </style>
</head>
<body>
    <h1>🔧 Laravel Login Fix Tool</h1>
    
    <?php
    $action = $_GET['action'] ?? 'check';
    
    if ($action === 'fix') {
        echo "<h2>Running Fixes...</h2>";
        
        // 1. Check if user exists
        echo "<div class='box'>";
        echo "<h3>1. Checking User...</h3>";
        $user = User::where('email', 'shahriar@gmail.com')->first();
        
        if (!$user) {
            echo "<p class='warning'>User not found. Creating...</p>";
            $user = User::create([
                'name' => 'Shahriar Khan',
                'email' => 'shahriar@gmail.com',
                'password' => Hash::make('shahriar@password'),
                'email_verified_at' => now(),
            ]);
            echo "<p class='success'>✓ User created successfully!</p>";
        } else {
            echo "<p class='success'>✓ User exists (ID: {$user->id})</p>";
        }
        echo "</div>";
        
        // 2. Reset password
        echo "<div class='box'>";
        echo "<h3>2. Resetting Password...</h3>";
        $user->password = Hash::make('shahriar@password');
        $user->email_verified_at = now();
        $user->save();
        echo "<p class='success'>✓ Password reset to: shahriar@password</p>";
        echo "</div>";
        
        // 3. Verify password
        echo "<div class='box'>";
        echo "<h3>3. Verifying Password...</h3>";
        $freshUser = User::where('email', 'shahriar@gmail.com')->first();
        if (Hash::check('shahriar@password', $freshUser->password)) {
            echo "<p class='success'>✓ Password verification successful!</p>";
        } else {
            echo "<p class='error'>✗ Password verification failed!</p>";
        }
        echo "</div>";
        
        // 4. Clear caches
        echo "<div class='box'>";
        echo "<h3>4. Clearing Caches...</h3>";
        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            echo "<p class='success'>✓ All caches cleared</p>";
        } catch (Exception $e) {
            echo "<p class='warning'>Cache clear: " . $e->getMessage() . "</p>";
        }
        echo "</div>";
        
        // 5. Check sessions
        echo "<div class='box'>";
        echo "<h3>5. Checking Sessions...</h3>";
        try {
            $sessionsCount = DB::table('sessions')->count();
            echo "<p class='success'>✓ Sessions table OK (count: {$sessionsCount})</p>";
        } catch (Exception $e) {
            echo "<p class='error'>✗ Sessions table error: " . $e->getMessage() . "</p>";
            echo "<p>Run: php artisan migrate</p>";
        }
        echo "</div>";
        
        echo "<div class='box' style='background: #d4edda; border: 1px solid #c3e6cb;'>";
        echo "<h2 class='success'>✓ Fix Complete!</h2>";
        echo "<p><strong>Email:</strong> shahriar@gmail.com</p>";
        echo "<p><strong>Password:</strong> shahriar@password</p>";
        echo "<p><a href='/admin/login' style='color: blue; text-decoration: underline;'>Go to Login Page</a></p>";
        echo "<p><a href='/admin/auto-login' style='color: blue; text-decoration: underline;'>Use Auto-Login</a></p>";
        echo "</div>";
        
    } else {
        // Display current status
        echo "<h2>Current Status</h2>";
        
        echo "<div class='box'>";
        echo "<h3>User Check</h3>";
        $user = User::where('email', 'shahriar@gmail.com')->first();
        
        if ($user) {
            echo "<p class='success'>✓ User found</p>";
            echo "<ul>";
            echo "<li><strong>ID:</strong> {$user->id}</li>";
            echo "<li><strong>Name:</strong> {$user->name}</li>";
            echo "<li><strong>Email:</strong> {$user->email}</li>";
            echo "<li><strong>Email Verified:</strong> " . ($user->email_verified_at ? 'Yes ✓' : 'No ✗') . "</li>";
            echo "<li><strong>Password Hash:</strong> " . substr($user->password, 0, 30) . "...</li>";
            echo "</ul>";
            
            // Test password
            if (Hash::check('shahriar@password', $user->password)) {
                echo "<p class='success'>✓ Password matches 'shahriar@password'</p>";
            } else {
                echo "<p class='error'>✗ Password does NOT match 'shahriar@password'</p>";
            }
        } else {
            echo "<p class='error'>✗ User not found!</p>";
        }
        echo "</div>";
        
        echo "<div class='box'>";
        echo "<h3>Database Check</h3>";
        try {
            $usersCount = User::count();
            echo "<p class='success'>✓ Users table OK (total users: {$usersCount})</p>";
        } catch (Exception $e) {
            echo "<p class='error'>✗ Users table error: " . $e->getMessage() . "</p>";
        }
        
        try {
            $sessionsCount = DB::table('sessions')->count();
            echo "<p class='success'>✓ Sessions table OK (count: {$sessionsCount})</p>";
        } catch (Exception $e) {
            echo "<p class='error'>✗ Sessions table error: " . $e->getMessage() . "</p>";
        }
        echo "</div>";
        
        echo "<div class='box'>";
        echo "<h3>Environment Check</h3>";
        echo "<ul>";
        echo "<li><strong>APP_ENV:</strong> " . env('APP_ENV') . "</li>";
        echo "<li><strong>APP_DEBUG:</strong> " . (env('APP_DEBUG') ? 'true' : 'false') . "</li>";
        echo "<li><strong>SESSION_DRIVER:</strong> " . env('SESSION_DRIVER') . "</li>";
        echo "<li><strong>DB_CONNECTION:</strong> " . env('DB_CONNECTION') . "</li>";
        echo "</ul>";
        echo "</div>";
        
        echo "<div style='margin-top: 20px;'>";
        echo "<a href='?action=fix'><button>🔧 Run Auto-Fix</button></a>";
        echo "<a href='/admin/auto-login'><button>🚀 Try Auto-Login</button></a>";
        echo "<a href='/admin/login'><button>🔑 Go to Login Page</button></a>";
        echo "</div>";
    }
    ?>
    
    <div style='margin-top: 30px; padding: 15px; background: #fff3cd; border: 1px solid #ffc107; border-radius: 5px;'>
        <h3>⚠️ Security Warning</h3>
        <p><strong>DELETE THIS FILE after fixing the login issue!</strong></p>
        <p>This file exposes sensitive information and should not be left on your server.</p>
        <?php if ($action === 'fix'): ?>
        <a href='?action=delete'><button class='danger'>🗑️ Delete This File Now</button></a>
        <?php endif; ?>
    </div>
    
    <?php
    if ($action === 'delete') {
        if (unlink(__FILE__)) {
            echo "<p class='success'>✓ File deleted successfully!</p>";
        } else {
            echo "<p class='error'>✗ Could not delete file. Please delete manually: login-fix.php</p>";
        }
    }
    ?>
    
</body>
</html>
