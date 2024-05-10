<?php
/**
 * Description of PortmoneServiceProvider.php
 * @copyright Copyright (c) DOTSPLATFORM, LLC
 * @author    Oleksandr Polosmak <o.polosmak@dotsplatform.com>
 */

namespace Dots\Portmone\App;

use Illuminate\Support\ServiceProvider;

class PortmoneServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../config/portmone.php' => config_path('portmone.php'),
        ]);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/portmone.php', 'portmone', );
    }
}
