<?php

namespace AdminPlus;

use AdminPlus\Models\OperationLog;
use Dcat\Admin\Extend\Setting as Form;
use Dcat\Admin\Support\Helper;

class Setting extends Form
{

    public function title()
    {
        return $this->trans('plus.setting');
    }

    protected function formatInput(array $input)
    {
        $input['except'] = Helper::array($input['except']);
        $input['allowed_methods'] = Helper::array($input['allowed_methods']);

        return $input;
    }

    public function form()
    {
        $this->tab('log-view', function (Form $form) {
            $form->text('log_file_prefix')
                ->required()
                ->default("laravel*")
                ->help("仅支持 laravel 自带日志文件解析,未自定义日志文件名,请不要修改!!!");
        });
        $this->tab('operation-log', function (Form $form) {
            $form->tags('except');
            $form->multipleSelect('allowed_methods')
                ->options(array_combine(OperationLog::$methods, OperationLog::$methods));
            $form->tags('secret_fields');
        });
    }
}
