@extends('layouts.home')

@section('title')
    {{ trans('header.home') }} - {{ config('app.title') }}
@endsection

@section('content')
    <project-list></project-list>
@endsection