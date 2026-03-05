<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\EnvironmentService;
use Exception;

class InstallController extends Controller
{
    public function index()
    {
        $requirements = [
            'PHP >= 8.2' => version_compare(PHP_VERSION, '8.2.0', '>='),
            'BCMath PHP Extension' => extension_loaded('bcmath'),
            'Ctype PHP Extension' => extension_loaded('ctype'),
            'JSON PHP Extension' => extension_loaded('json'),
            'Mbstring PHP Extension' => extension_loaded('mbstring'),
            'OpenSSL PHP Extension' => extension_loaded('openssl'),
            'PDO PHP Extension' => extension_loaded('pdo'),
            'Tokenizer PHP Extension' => extension_loaded('tokenizer'),
            'XML PHP Extension' => extension_loaded('xml'),
            '.env Writable' => is_writable(base_path('.env')),
            'Storage Writable' => is_writable(storage_path()),
        ];

        $allPassed = !in_array(false, $requirements, true);

        return view('install.welcome', compact('requirements', 'allPassed'));
    }

    public function database()
    {
        return view('install.database');
    }

    public function setupDatabase(Request $request, EnvironmentService $env)
    {
        $request->validate([
            'db_host' => 'required',
            'db_port' => 'required|numeric',
            'db_database' => 'required',
            'db_username' => 'required',
        ]);

        // Attempt Connection Before Saving
        try {
            $connection = @mysqli_connect(
                $request->db_host,
                $request->db_username,
                $request->db_password,
                $request->db_database,
                $request->db_port
            );

            if (!$connection) {
                return back()->withInput()->with('error', 'Could not connect to the database. Please check your credentials. Error: ' . mysqli_connect_error());
            }

            // Connection successful
            mysqli_close($connection);

            // Save to .env
            $env->updateEnv([
                'DB_HOST' => $request->db_host,
                'DB_PORT' => $request->db_port,
                'DB_DATABASE' => $request->db_database,
                'DB_USERNAME' => $request->db_username,
                'DB_PASSWORD' => $request->db_password,
            ]);

            return redirect()->route('install.migrations');

        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Database error: ' . $e->getMessage());
        }
    }

    public function migrations()
    {
        try {
            // Force clearing of any cached config first
            Artisan::call('config:clear');

            // Run fresh migrations
            Artisan::call('migrate:fresh', ['--force' => true]);

            // Add default required settings if they don't exist
            \App\Models\Setting::set('platform.app_name', 'ScrollWebLink');
            \App\Models\Setting::set('platform.primary_color', '#9333ea');

            return redirect()->route('install.admin');
        } catch (Exception $e) {
            return redirect()->route('install.database')->with('error', 'Migration failed. Please check database permissions. Error: ' . $e->getMessage());
        }
    }

    public function admin()
    {
        return view('install.admin');
    }

    public function setupAdmin(Request $request, EnvironmentService $env)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Create the first admin user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'admin',
                'email_verified_at' => now(), // Auto verify the installation admin
            ]);

            // Mark application as installed
            $env->updateEnv([
                'APP_INSTALLED' => 'true',
                'APP_URL' => url('/')
            ]);

            // Auto login
            auth()->login($user);

            return redirect()->route('install.finish');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Failed to create admin user: ' . $e->getMessage());
        }
    }

    public function finish()
    {
        return view('install.finish');
    }
}
