<div class="row">
    <div class="col-xs-12 col-sm-5 col-md-6 col-lg-7">
        <h4 class="lindale-color" style="margin-top: 0;">
            <span class="glyphicon glyphicon-briefcase lindale-icon-color"></span>
            <strong>{{ $project->title }}</strong> <small>@include('layouts.common.number.project')</small>
        </h4>
    </div>
    <div class="col-xs-12 col-sm-7 col-md-6 col-lg-5" align="right">
        <div class="btn-group">
            <a href="{{ route('progress.gantt-full', compact('project')) }}" type="button" class="btn btn-default btn-sm lindale-color">
                <i class="fa fa-tasks lindale-icon-color" aria-hidden="true"></i> <strong>{{ trans('progress.gantt') }}</strong>
            </a>
        </div>
        <div class="btn-group">
            <a href="{{ url('project/'.$project->id.'/task') }}" type="button" class="btn btn-default btn-sm lindale-color">
                <span class="glyphicon glyphicon-tasks lindale-icon-color"></span> <strong class="hidden-xs">{{ trans('header.tasks') }}</strong>
            </a>
            <a type="button" class="btn btn-default btn-sm">
                {{ Counter::ProjectTaskFinishedCount($project) }}/{{ Counter::ProjectTaskCount($project) }}
            </a>
        </div>
        <div class="btn-group">
            <a href="{{ url('project/'.$project->id.'/todo') }}" type="button" class="btn btn-default btn-sm lindale-color">
                <span class="glyphicon glyphicon-check lindale-icon-color"></span> <strong class="hidden-xs">TODO</strong>
            </a>
            <a type="button" class="btn btn-default btn-sm">
                {{ Counter::ProjectTodoFinishedCount($project) }}/{{ Counter::ProjectTodoCount($project) }}
            </a>
        </div>
    </div>
</div>
<br>
@include('layouts.project.project-nav')
<br>
@include('layouts.common.message')
