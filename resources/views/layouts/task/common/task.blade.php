<div class="bs-callout {{ Colorable::getCallOutColor($task->color_id) }}">
    <div class="row">
    	<div class="col-xs-2 col-sm-2 col-md-1 col-lg-1">
            @if((int)$task->is_finish === config('task.finished'))
                @include('layouts.task.common.finish-edit',
                ['status_edit_url' => url('project/'.$task->Project->id.'/task/task/'.$task->id), 'model' => $task])
            @else
                @include('layouts.task.common.status-edit',
                ['status_edit_url' => url('project/'.$task->Project->id.'/task/task/'.$task->id), 'model' => $task, 'statuses' => $task->Project->TaskStatuses])
            @endif
    	</div>
        <div class="col-xs-10 col-sm-10 col-md-11 col-lg-11">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a href="{{ url('project/'.$task->Project->id.'/task/show/'.$task->id) }}">
                        <h4>
                            {{ trans($task->Type->name) }}：{{ $task->title }}
                        </h4>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <strong>
                        <a href="{{ url('project/'.$task->Project->id.'/task/type/'.$task->Type->id) }}" class="{{ Colorable::textColorClass($task->Type->color_id) }}">
                            @include('layouts.common.number.task')
                        </a>
                    </strong>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <span class="glyphicon glyphicon-user lindale-icon-color"></span>
                    <span class="hidden-xs hidden-sm lindale-color">{{ trans('task.user') }}：</span>
                    @if($task->User != null){{ $task->User->name }}@else{{ trans('task.none') }}@endif
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <span class="glyphicon glyphicon-pencil lindale-icon-color"></span>
                    <span class="hidden-xs hidden-sm lindale-color">{{ trans('todo.initiator') }}：</span>
                    {{ $task->Initiator ? $task->Initiator->name : trans('task.none') }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <i class="fa fa-hourglass-half lindale-icon-color" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm lindale-color">{{ trans('task.cost') }}：</span>
                    @if((int)$task->cost !== null){{ $task->cost }} {{ trans('task.hour') }}@else{{ trans('task.none') }}@endif
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <i class="fa fa-hourglass lindale-icon-color" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm lindale-color">{{ trans('task.spend') }}：</span>
                    @if($task->spend !== null){{ $task->spend }} {{ trans('task.hour') }}@else{{ trans('task.none') }}@endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <span class="glyphicon glyphicon-th-list lindale-icon-color"></span>
                    <span class="hidden-xs hidden-sm lindale-color">{{ trans('task.group') }}：</span>
                    @if($task->Group != null){{ $task->Group->title }}@else{{ trans('task.none') }}@endif
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <i class="fa fa-tachometer lindale-icon-color" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm lindale-color">{{ trans('task.priority') }}：</span>
                    {{ trans($task->Priority->name) }}
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <i class="fa fa-hourglass-start lindale-icon-color" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm lindale-color">{{ trans('task.start_at') }}：</span>
                    @if($task->start_at != '')
                        @if(Carbon\Carbon::parse($task->start_at)->lte(Carbon\Carbon::now()))
                            <span class="text-success">{{ $task->start_at->format('Y/m/d') }}</span>
                        @else
                            {{ $task->start_at->format('Y/m/d') }}
                        @endif
                    @else
                        {{ trans('task.none') }}
                    @endif
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <i class="fa fa-hourglass-end lindale-icon-color" aria-hidden="true"></i>
                    <span class="hidden-xs hidden-sm lindale-color">{{ trans('task.end_at') }}：</span>
                    @if($task->end_at != '')
                        @if(Carbon\Carbon::parse($task->end_at)->lt(Carbon\Carbon::now()))
                            <span class="text-danger">{{ $task->end_at->format('Y/m/d') }}</span>
                        @else
                            {{ $task->end_at->format('Y/m/d') }}
                        @endif
                    @else
                        {{ trans('task.none') }}
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <span class="glyphicon glyphicon-time lindale-icon-color"></span>
                    <span class="hidden-xs hidden-sm lindale-color">{{ trans('task.created') }}：</span>
                    {{ $task->created_at->format('Y/m/d H:i') }}
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <i class="fa fa-refresh fa-spin fa-lg fa-fw lindale-icon-color"></i>
                    <span class="hidden-xs hidden-sm lindale-color">{{ trans('task.updated') }}：</span>
                    {{ $task->updated_at->diffForHumans() }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active {{ Colorable::progressColorClass($task->color_id) }}"
                             style="width: {{ $task->progress }}%">
                            {{ $task->progress }}% Complete
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h4>
                        <small>
                            {{ Counter::SubTaskCount($task) }}　{{ trans('task.sub-task') }}（{{ Counter::FinishedSubTasks($task) }} - {{ trans('task.finish') }} ，
                            {{ Counter::UnfinishedSubTasks($task) }} - {{ trans('task.unfinished') }}）
                        </small>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>