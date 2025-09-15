<?php
// Debug script for admin panel access issues
// Place this in your public directory and access via: yourdomain.com/debug_admin.php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "<h1>Admin Panel Debug Information</h1>";

// Check if user is authenticated
if (auth()->check()) {
    $user = auth()->user();
    echo "<h2>✅ User is authenticated</h2>";
    echo "<p><strong>User ID:</strong> " . $user->id . "</p>";
    echo "<p><strong>Name:</strong> " . $user->name . "</p>";
    echo "<p><strong>Email:</strong> " . $user->email . "</p>";
    echo "<p><strong>Email Verified:</strong> " . ($user->email_verified_at ? 'Yes' : 'No') . "</p>";
} else {
    echo "<h2>❌ User is NOT authenticated</h2>";
    echo "<p>This might be the cause of the 403 error.</p>";
}

// Check file permissions
echo "<h2>File Permissions Check</h2>";
$paths = [
    'storage' => __DIR__ . '/../storage',
    'bootstrap/cache' => __DIR__ . '/../bootstrap/cache',
    'public' => __DIR__,
];

foreach ($paths as $name => $path) {
    if (is_dir($path)) {
        $perms = substr(sprintf('%o', fileperms($path)), -4);
        echo "<p><strong>$name:</strong> $perms " . (is_readable($path) ? '✅' : '❌') . "</p>";
    } else {
        echo "<p><strong>$name:</strong> ❌ Directory not found</p>";
    }
}

// Check environment
echo "<h2>Environment Check</h2>";
echo "<p><strong>APP_ENV:</strong> " . env('APP_ENV', 'not set') . "</p>";
echo "<p><strong>APP_DEBUG:</strong> " . (env('APP_DEBUG') ? 'true' : 'false') . "</p>";
echo "<p><strong>APP_URL:</strong> " . env('APP_URL', 'not set') . "</p>";

// Check session configuration
echo "<h2>Session Configuration</h2>";
echo "<p><strong>Session Driver:</strong> " . config('session.driver') . "</p>";
echo "<p><strong>Session Lifetime:</strong> " . config('session.lifetime') . " minutes</p>";

// Check if Filament routes are registered
echo "<h2>Filament Routes Check</h2>";
$routes = app('router')->getRoutes();
$filamentRoutes = collect($routes)->filter(function ($route) {
    return str_contains($route->uri(), 'admin');
});

if ($filamentRoutes->count() > 0) {
    echo "<p>✅ Filament routes are registered (" . $filamentRoutes->count() . " routes)</p>";
} else {
    echo "<p>❌ No Filament routes found</p>";
}

// Test database connection
echo "<h2>Database Connection</h2>";
try {
    DB::connection()->getPdo();
    echo "<p>✅ Database connection successful</p>";
    
    // Check if users table exists and has data
    $userCount = DB::table('users')->count();
    echo "<p><strong>Users in database:</strong> $userCount</p>";
    
    // Check if navigation table exists
    $navCount = DB::table('navigations')->count();
    echo "<p><strong>Navigation items:</strong> $navCount</p>";
    
    // Check if site_settings table exists
    $settingsCount = DB::table('site_settings')->count();
    echo "<p><strong>Site settings:</strong> $settingsCount</p>";
    
} catch (Exception $e) {
    echo "<p>❌ Database connection failed: " . $e->getMessage() . "</p>";
}

echo "<h2>Next Steps</h2>";
echo "<ol>";
echo "<li>If user is not authenticated, try logging in again</li>";
echo "<li>If file permissions are wrong, run: <code>chmod -R 755 storage bootstrap/cache public</code></li>";
echo "<li>If database connection fails, check your .env file</li>";
echo "<li>If Filament routes are missing, run: <code>php artisan route:cache</code></li>";
echo "</ol>";
?>
