@extends('layouts.admin')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		评论管理
	</div>
	<div class="panel-body">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				{!! implode('<br>', $errors->all()) !!}
			</div>
		@endif

		@foreach ($comments as $comment)
			<hr>
				<div class="comment">
					<h4>{{ $comment->id }}.{{ $comment->nickname }}</h4>
					<h6>{{ $comment->created_at }}　E-mail：{{ $comment->email }}</h6>
					<div class="content">
						<p>
							主页：{{ $comment->website }}
						</p>
						<p>
							内容：{!! nl2br(e($comment->content)) !!}
						</p>
						<p>
							文章：<a href="{{ url('/article/'.$comment->Article->id) }}">
							{{ $comment->Article->title }}
							</a>
						</p>
					</div>
				</div>
				<form action="{{ url('admin/comment/'.$comment->id) }}" method="POST" style="display: inline;">
					{{ method_field('DELETE') }}
					{{ csrf_field() }}
					<button type="submit" class="btn btn-danger">删除</button>
				</form>
		@endforeach
	</div>
</div>
@endsection
