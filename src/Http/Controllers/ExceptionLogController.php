<?php

namespace AdminPlus\Http\Controllers;

use AdminPlus\AdminPlusServiceProvider;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use AdminPlus\Models\ExceptionLog;
use AdminPlus\Tracer\Parser;

class ExceptionLogController extends AdminController
{

    protected function title()
    {
        return $this->title ?: AdminPlusServiceProvider::trans('plus.exception_log');
    }

    protected function grid()
    {
        return Grid::make(ExceptionLog::class, function (Grid $grid) {

            $grid->model()->orderBy('id', 'desc');
            $grid->id('ID')->sortable();
            $grid->type()->display(function ($type) {
                $path = explode('\\', $type);

                return array_pop($path);
            });

            $grid->code();
            $grid->message()->style('width:400px')->display(function ($message) {
                return empty($message) ? '' : "<code>$message</code>";
            });
            $grid->column('request')->display(function () {
                $color = ExceptionLog::METHOD_COLOR[$this->method];

                return sprintf('<span class="label bg-%s">%s</span><code>%s</code>', $color, $this->method,
                    $this->path);
            });
            $grid->file();
            $grid->created_at();

            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->like('type');
                $filter->like('message');
            });

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableEdit();
            });

            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->disableDeleteButton();
            $grid->disableBatchDelete();
        });
    }

    protected function detail($id)
    {
        return Show::make($id, new ExceptionLog(), function (Show $show) use ($id) {
            $exception = ExceptionLog::findOrFail($id);
            $trace = "#0 {$exception->file}({$exception->line})\n";
            $frames = (new Parser($trace . $exception->trace))->parse();
            $cookies = json_decode($exception->cookies, true);
            $headers = json_decode($exception->headers, true);

            array_pop($frames);

            $name = AdminPlusServiceProvider::instance()->getName();
            $view = view($name.'::report', compact('exception', 'frames', 'cookies', 'headers'));

            $show->html($view);
            $show->disableEditButton();
            $show->disableDeleteButton();
        });
    }

}
