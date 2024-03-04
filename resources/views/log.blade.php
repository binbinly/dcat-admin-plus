<div class="row">
    <div class="col-md-10">
        <div class="box box-primary">
            <div class="box-header with-border">
                <button type="button" data-action="refresh" class="btn btn-primary btn-sm log-refresh">
                    <i class="fa fa-refresh"></i> {{ trans('admin.refresh') }}
                </button>
                <div class="pull-right">
                    <div class="btn-group">
                        @if ($prevUrl)
                            <a href="{{ $prevUrl }}" class="btn btn-default btn-sm"><i
                                    class="fa fa-chevron-left"></i></a>
                        @endif
                        @if ($nextUrl)
                            <a href="{{ $nextUrl }}" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>{{ \AdminPlus\AdminPlusServiceProvider::trans('plus.level') }}</th>
                            <th>{{ \AdminPlus\AdminPlusServiceProvider::trans('plus.env') }}</th>
                            <th>{{ \AdminPlus\AdminPlusServiceProvider::trans('plus.date') }}</th>
                            <th>{{ \AdminPlus\AdminPlusServiceProvider::trans('plus.message') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $index => $log)
                            <tr>
                                <td class="text-white">
                                    <span
                                        class="label bg-{{\AdminPlus\Services\SystemLogService::$levelColors[$log['level']]}}">{{ $log['level'] }}</span>
                                </td>
                                <td style="width: 50px"><strong>{{ $log['env'] }}</strong></td>
                                <td style="width:120px;">{{ $log['time'] }}</td>
                                <td><code style="word-break: break-all;">{{ $log['info'] }}</code></td>
                                <td>
                                    @if(!empty($log['trace']))
                                        <i class="fa fa-info"></i>
                                        <button class="btn btn-primary btn-xs" data-toggle="collapse"
                                                data-target=".trace-{{$index}}"> Exception
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @if (!empty($log['trace']))
                                <tr class="collapse trace-{{$index}}">
                                    <td colspan="5">
                                        <div
                                            style="white-space: pre-wrap;background: #333;color: #fff; padding: 10px;">{{ $log['trace'] }}</div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">{{ \AdminPlus\AdminPlusServiceProvider::trans('plus.file_list') }}</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked" style="flex-direction: column;">
                    @foreach($logFiles as $logFile)
                        <li class="{{ $logFile === $fileName?'active':'' }}" style="margin-top: 3px">
                            <a href="{{ admin_route('log-viewer-file',['file' => $logFile]) }}">
                                <i class="fa fa-{{ ($logFile === $fileName) ? 'folder-open' : 'folder' }}"></i> {{ $logFile }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">{{ AdminPlus\AdminPlusServiceProvider::trans('plus.file_info') }}</h3>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked" style="flex-direction: column;">
                    <li class="mt-1">
                        <a>{{AdminPlus\AdminPlusServiceProvider::trans('plus.size') .' : '.$size}}</a>
                    </li>
                    <li class="mt-1">
                        <a>{{trans('admin.updated_at') ." : ". date('Y-m-d H:i:s', filectime($filePath)) }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
