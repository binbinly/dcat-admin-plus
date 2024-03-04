<?php

namespace AdminPlus\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use AdminPlus\Models\ExceptionLog;

class ClearExceptionLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exception-log:clear {--date= : 日期,格式为 Y-m-d}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清除异常表的异常记录。例子：删除一周前的异常执行“php artisan exception-reporter:clear”命令；删除指定日期前的异常“php artisan exception-reporter:clear 2022-01-14”命令';

    public function handle()
    {
        $date = $this->option('date');

        if (!empty($date)) {
            $date = Carbon::parse($date);
        } else {
            $date = Carbon::today()->subWeek();
        }

        if (is_null($date)) {
            $date = Carbon::now();
        }

        ExceptionLog::query()->where('created_at', '<=', $date->toDateTimeString())->delete();

        $this->info('清除完成 ^_^^_^');
    }
}
