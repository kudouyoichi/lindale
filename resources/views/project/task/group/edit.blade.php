@extends('layouts.master')

@section('title')
    {{ trans('header.tasks') }} - {{ $project->title }} - {{ config('app.title') }}
@endsection

@section('content')

    @include('layouts.project.common.project-header')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3><span class="glyphicon glyphicon-th-list"></span> {{ trans('task.edit-group') }}
                <small>
                    @include('layouts.task.common.delete',
                    [
                    'model' => $group,
                    'delete_url' => url('project/'.$project->id.'/task/group/delete/'.$group->id),
                    'link_name' => '<span class="glyphicon glyphicon glyphicon-trash"></span> '.trans('task.delete'),
                    'model_id' => 'deleteGroup'.$group->id,
                    'model_name' => $group->title,
                    ])
                </small>
            </h3>
            <hr>
            <form action="{{ url('project/'.$project->id.'/task/group/edit/'.$group->id) }}" method="post" role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                <div class="row">
                    {{-- 框架 --}}
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">

                        {{-- 任务组名 --}}
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label class="control-label">
                                    {{ trans('task.group-title') }}
                                </label>
                                <div>
                                    <input type="text" class="form-control" name="title" value="{{ old('title') ? old('title') : $group->title }}">
                                    @include('layouts.common.error-one', ['field' => 'title'])
                                </div>
                            </div>
                        </div>

                        {{-- 任务组描述 --}}
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group{{ $errors->has('information') ? ' has-error' : '' }}">
                                <label class="control-label">
                                    {{ trans('task.group-info') }}
                                </label>
                                <div>
                                    <textarea class="form-control" rows="8" name="information" value="" data-provide="markdown" placeholder=" Markdown">{{ old('information') ? old('information') : $group->information }}</textarea>
                                    @include('layouts.common.error-one', ['field' => 'information'])
                                </div>
                            </div>
                        </div>

                        {{-- 开始时间 --}}
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group{{ $errors->has('start_at') ? ' has-error' : '' }}">
                                <label class="control-label">
                                    {{ trans('task.start_at') }}
                                </label>
                                <div>
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' class="form-control" name="start_at" value="{{ old('start_at') ? old('start_at') : $group->start_at }}"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    @include('layouts.common.error-one', ['field' => 'start_at'])
                                </div>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#datetimepicker1').datetimepicker({
                                            format: 'YYYY-MM-DD'
                                        });
                                    });
                                </script>
                            </div>
                        </div>

                        {{-- 结束时间 --}}
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group{{ $errors->has('end_at') ? ' has-error' : '' }}">
                                <label class="control-label">{{ trans('task.end_at') }}</label>
                                <div>
                                    <div class='input-group date' id='datetimepicker2'>
                                        <input type='text' class="form-control" name="end_at" value="{{ old('end_at') ? old('end_at') : $group->end_at }}"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    @include('layouts.common.error-one', ['field' => 'end_at'])
                                </div>
                                <script type="text/javascript">
                                    $(function () {
                                        $('#datetimepicker2').datetimepicker({
                                            format: 'YYYY-MM-DD'
                                        });
                                    });
                                </script>
                            </div>
                        </div>


                    </div>
                    {{-- 框架 --}}
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">

                        {{-- 类型 --}}
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                                <label class="control-label">{{ trans('task.type') }}</label>
                                <div>
                                    <select class="selectpicker form-control" name="type_id">
                                        @foreach( $types as $type)
                                            <option value="{{ $type->id }}" @if(old('type_id') ? old('type_id') : $group->type_id == $type->id) selected @endif>
                                                {{ trans($type->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @include('layouts.common.error-one', ['field' => 'type_id'])
                                </div>
                            </div>
                        </div>

                        {{-- 状态 --}}
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
                                <label class="control-label">{{ trans('task.status') }}</label>
                                <div>
                                    <select class="selectpicker form-control" data-live-search="false" name="status_id">
                                        @foreach( $taskGroupStatuses as $key => $status)
                                            <option value="{{ $key }}" @if(old('status_id') ? old('status_id') : $group->status_id == $key) selected @endif>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @include('layouts.common.error-one', ['field' => 'status_id'])
                                </div>
                            </div>
                        </div>

                        {{-- 颜色 --}}
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group{{ $errors->has('color_id') ? ' has-error' : '' }}">
                                <label class="control-label">
                                    {{ trans('todo.color') }}
                                </label>
                                <div>
                                    <select class="selectpicker form-control" name="color_id">
                                        @foreach( config('color.common') as $id => $color)
                                            <option value="{{ $id }}" @if(old('color_id') ? old('color_id') : $group->color_id === $id) selected @endif>{{ trans($color) }}</option>
                                        @endforeach
                                    </select>
                                    @include('layouts.common.error-one', ['field' => 'color_id'])
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center">
                        <a href="{{ url('project/'.$project->id.'/task') }}" class="btn btn-success">{{ trans('task.cancel') }}</a>
                        <button type="submit" class="btn btn-warning">{{ trans('task.update') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection