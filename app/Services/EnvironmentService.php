<?php

namespace App\Services;

class EnvironmentService
{
    /**
     * Update multiple environment variables in the .env file.
     *
     * @param array $data
     * @return bool
     */
    public function updateEnv(array $data)
    {
        $envPath = base_path('.env');

        if (!file_exists($envPath)) {
            return false;
        }

        $envFile = file_get_contents($envPath);
        $originalEnvFile = $envFile;

        foreach ($data as $key => $value) {
            // Quote the value if it has spaces
            if (preg_match('/\s/', $value)) {
                $value = '"' . $value . '"';
            }

            // Check if key exists
            $pattern = "/^" . preg_quote($key, '/') . "=(.*)$/m";

            if (preg_match($pattern, $envFile)) {
                // Replace existing key
                $envFile = preg_replace($pattern, $key . '=' . $value, $envFile);
            } else {
                // Append new key
                $envFile .= "\n" . $key . '=' . $value;
            }
        }

        // Only write if changes were made
        if ($envFile !== $originalEnvFile) {
            file_put_contents($envPath, $envFile);

            // Re-load environment variables in the current process
            \Illuminate\Support\Env::getRepository()->set('APP_INSTALLED', true);
            return true;
        }

        return false;
    }
}
