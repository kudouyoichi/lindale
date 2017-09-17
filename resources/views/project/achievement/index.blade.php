@extends('layouts.master')

@section('title')
    {{ trans('header.achievement') }} - {{ $project->title }} - {{ config('app.title') }}
@endsection

@section('content')

    @include('layouts.project.common.project-header')

    @include('layouts.achievement.title')

    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" align="center">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-warning">
                        <div class="panel-body">
                            <h2>{{ $project->tasks()->count() }}<br><small>STARS</small></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" align="center">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-danger">
                        <div class="panel-body">
                            <h2>{{ $project->todos()->count() }}<br><small>DAYS</small></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" align="center">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <h2>{{ $project->wikis()->count() }}<br><small>WIKIS</small></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" align="center">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-body">
                            <h2>{{ $project->Users()->count() }}<br><small>MEMBERS</small></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" align="center">
                            <h2>TASKS</h2>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" align="center">
                            <h2>{{ $project->tasks()->where('is_finish', config('task.finished'))->count() }}</h2>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" align="center">
                            <h2>/</h2>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" align="center">
                            <h2>{{ $project->tasks()->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" align="center">
                            <h2>TODOS</h2>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" align="center">
                            <h2>{{ $project->tasks()->where('is_finish', config('task.finished'))->count() }}</h2>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" align="center">
                            <h2>/</h2>
                        </div>
                        <div class="col-xs-4 col-sm-3 col-md-3 col-lg-3" align="center">
                            <h2>{{ $project->todos()->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-default status-panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3" align="center">
                            <h2>貢献度</h2>
                        </div>
                        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9" align="center">
                            <h2>{{ number_format(34234234) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
