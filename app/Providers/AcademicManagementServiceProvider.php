<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AcademicManagementServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $routeFile = base_path('routes/academic-management.php');
        if (file_exists($routeFile)) {
            $this->loadRoutesFrom($routeFile);
        }
    }
}
