<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    // Aliases for filter classes
    public array $aliases = [
        'csrf'          => \CodeIgniter\Filters\CSRF::class,
        'toolbar'       => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot'     => \CodeIgniter\Filters\Honeypot::class,
        'auth'          => \App\Filters\AuthFilter::class,  // Pastikan ini ada
    ];

    // Always-enabled filters
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
        ],
    ];

    // Filters for specific methods
    public array $methods = [];

    // Filter configuration
    public array $filters = [];

    // Filter aliases that should run on any before or after URI patterns
    public array $filterGroups = [];
}
