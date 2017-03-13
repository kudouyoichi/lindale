@extends('layouts.master')

@section('title')
    {{ trans('header.config') }} - {{ $project->title }} - {{ config('app.title') }}
@endsection

@section('content')

    @include('layouts.Project.common.project-header')

    <div class="row">
        {{-- 框架 --}}
        @include('layouts.config.header')

        {{-- 框架 --}}
        <div class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
            {{-- 基本設定 --}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{ trans('config.basic') }}</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <form action="{{ url('project/'.$project->id) }}" method="post" role="form" enctype="multipart/form-data">
                                {{ method_field('PATCH') }}
                                {{ csrf_field() }}

                                <div class="row">
                                    {{-- 框架 --}}
                                    <div class="col-xs-12 col-sm-11 col-md-10 col-lg-8">

                                        {{-- 图片 --}}
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                                @include('layouts.common.project-img')
                                            </div>
                                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                                    <label class="control-label">{{ trans('project.add-image') }}</label>
                                                    <input type="file" name="image">
                                                    <p class="help-block">（ jpeg、png、bmp、gif、svg ）</p>
                                                    @include('layouts.common.error-one', ['field' => 'image'])
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 项目名 --}}
                                       <div class="row">
                                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                               <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                                   <label class="control-label">
                                                       {{ trans('project.title') }}
                                                   </label>
                                                   <div>
                                                       <input type="text" class="form-control" name="title" value="{{ $project->title }}">
                                                       @include('layouts.common.error-one', ['field' => 'title'])
                                                   </div>
                                               </div>
                                           </div>
                                       </div>

                                        {{-- 项目描述 --}}
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                                    <label class="control-label">
                                                        {{ trans('project.content') }}
                                                    </label>
                                                    <div>
                                                        <textarea class="form-control" rows="8" name="content" value="" data-provide="markdown" placeholder=" Markdown">{{ $project->content }}</textarea>
                                                        @include('layouts.common.error-one', ['field' => 'content'])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 开始时间 --}}
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group{{ $errors->has('start_at') ? ' has-error' : '' }}">
                                                    <label class="control-label">
                                                        {{ trans('project.start_at') }}
                                                    </label>
                                                    <div>
                                                        <div class='input-group date' id='datetimepicker1'>
                                                            <input type='text' class="form-control" name="start_at" value="{{ $project->start_at }}"/>
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
                                        </div>

                                        {{-- 结束时间 --}}
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group{{ $errors->has('end_at') ? ' has-error' : '' }}">
                                                    <label class="control-label">{{ trans('project.end_at') }}</label>
                                                    <div>
                                                        <div class='input-group date' id='datetimepicker2'>
                                                            <input type='text' class="form-control" name="end_at" value="{{ $project->end_at }}"/>
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


                                        {{-- 类型 --}}
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                                                    <label class="control-label">{{ trans('project.type') }}</label>
                                                    <div>
                                                        <select class="selectpicker form-control" name="type_id">
                                                            @foreach( $types as $type)
                                                                <option value="{{ $type->id }}" @if($project->type_id == $type->id) selected @endif>{{ $type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @include('layouts.common.error-one', ['field' => 'type_id'])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 项目副总监 --}}
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group{{ $errors->has('sl_id') ? ' has-error' : '' }}">
                                                    <label class="control-label">{{ trans('project.sl') }}</label>
                                                    <div>
                                                        <select class="selectpicker form-control" data-live-search="true" name="sl_id">
                                                            <option value="">{{ trans('project.none') }}</option>
                                                            @foreach( $users as $user)
                                                                <option value="{{ $user->id }}" @if($project->sl_id == $user->id) selected @endif>{{ $user->name }}（{{ $user->email }}）</option>
                                                            @endforeach
                                                        </select>
                                                        @include('layouts.common.error-one', ['field' => 'sl_id'])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 项目状态 --}}
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
                                                    <label class="control-label">{{ trans('project.status') }}</label>
                                                    <div>
                                                        <select class="selectpicker form-control" data-live-search="true" name="status_id">
                                                            @foreach( $statuses as $status)
                                                                <option value="{{ $status->id }}" @if($project->status_id == $user->id) selected @endif>{{ $status->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @include('layouts.common.error-one', ['field' => 'status_id'])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 项目密码 --}}
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <label for="password" class="control-label">
                                                        {{ trans('project.password') }}
                                                    </label>
                                                    <div>
                                                        <input id="password" type="password" class="form-control" name="password">
                                                        @include('layouts.common.error-one', ['field' => 'password'])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- 确认密码 --}}
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                    <label for="password-confirm" class="control-label">
                                                        {{ trans('project.password_confirmation') }}
                                                    </label>
                                                    <div>
                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                                        @include('layouts.common.error-one', ['field' => 'password_confirmation'])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                       <div class="row">
                                           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                               @include('layouts.Project.edit-modal')
                                               <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#projectEdit">
                                                   {{ trans('project.edit-project') }}
                                               </button>
                                           </div>
                                       </div>

                                    </div>
                                    {{-- 框架 --}}
                                    <div class="col-xs-0 col-sm-1 col-md-2 col-lg-4">

                                    </div>
                                </div>

                            </form>
                    	</div>
                    </div>
                </div>
            </div>

            {{-- 删除项目 --}}
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h4>{{ trans('project.delete') }}</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                            	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            		<p>{{ trans('config.delete-project-info') }}</p>
                            	</div>
                            </div>
                            <div class="row">
                                {{-- 框架 --}}
                                <div class="col-xs-12 col-sm-11 col-md-10 col-lg-8">
                                    @include('layouts.Project.delete')
                                </div>
                                {{-- 框架 --}}
                                <div class="col-xs-0 col-sm-1 col-md-2 col-lg-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection