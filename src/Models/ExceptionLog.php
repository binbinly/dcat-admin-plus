<?php

namespace AdminPlus\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Dcat\Admin\Traits\HasDateTimeFormatter;


/**
 * Weiaibaicai\DcatExceptionReporter\Models\SystemException
 *
 * @property int $id
 * @property string $type
 * @property string $code
 * @property string $message
 * @property string $file
 * @property int $line
 * @property string $trace
 * @property string $method
 * @property string $path
 * @property string $query
 * @property string $body
 * @property string $cookies
 * @property string $headers
 * @property string $ip
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ExceptionLog extends Model
{
    use HasDateTimeFormatter;

    public $table = 'admin_exception_log';

    public const METHOD_COLOR = [
        'GET' => 'green',
        'POST' => 'yellow',
        'PUT' => 'blue',
        'DELETE' => 'red',
        'PATCH' => 'black',
        'OPTIONS' => 'grey',
    ];

}
