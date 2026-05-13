<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // @role('admin') ... @endrole
        Blade::directive('role', function ($role) {
            return "<?php if (auth()->check() && auth()->user()->hasRole({$role})): ?>";
        });

        Blade::directive('endrole', function () {
            return '<?php endif; ?>';
        });

        // @hasrole('admin') ... @endhasrole
        Blade::directive('hasrole', function ($role) {
            return "<?php if (auth()->check() && auth()->user()->hasRole({$role})): ?>";
        });

        Blade::directive('endhasrole', function () {
            return '<?php endif; ?>';
        });

        // @hasanyrole('admin','super-admin') ... @endhasanyrole
        Blade::directive('hasanyrole', function ($roles) {
            return "<?php if (auth()->check() && auth()->user()->hasAnyRole({$roles})): ?>";
        });

        Blade::directive('endhasanyrole', function () {
            return '<?php endif; ?>';
        });

        // @hasallroles('admin','super-admin') ... @endhasallroles
        Blade::directive('hasallroles', function ($roles) {
            return "<?php if (auth()->check() && auth()->user()->hasAllRoles({$roles})): ?>";
        });

        Blade::directive('endhasallroles', function () {
            return '<?php endif; ?>';
        });
    }
}
