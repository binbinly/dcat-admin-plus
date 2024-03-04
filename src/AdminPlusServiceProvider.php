<?php

namespace AdminPlus;

use AdminPlus\Console\Commands\ClearExceptionLog;
use AdminPlus\Http\Middleware\LogOperation;
use Dcat\Admin\Extend\ServiceProvider;

class AdminPlusServiceProvider extends ServiceProvider
{
	protected $js = [
        'js/index.js',
        'js/report.js',
    ];

	protected $css = [
		'css/index.css',
		'css/report.css',
	];

    protected $middleware = [
        'middle' => [
            LogOperation::class,
        ],
    ];

    protected array $commands = [
        ClearExceptionLog::class,
    ];

    // 定义菜单
    protected $menu = [
        [
            'title' => 'admin-plus',
            'uri' => '',
            'icon' => 'feather icon-settings',
        ],
        [
            'parent' => 'admin-plus',
            'title' => 'system-log',
            'uri' => 'auth/logs-view',
        ],
        [
            'parent' => 'admin-plus',
            'title' => 'exception-log',
            'uri' => 'auth/exception-logs',
        ],
        [
            'parent' => 'admin-plus',
            'title' => 'operation-log',
            'uri'   => 'auth/operation-logs',
        ],
    ];

    public function settingForm(): Setting
    {
        return new Setting($this);
    }

}
