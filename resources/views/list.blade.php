@extends('app')

@section('content')
<div class="text-right">
	<a href="{{ url('auth/logout') }}">登出</a>
</div>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>序号</th>
			<th>留言者</th>
			<th>Email</th>
			<th>留言内容</th>
			<th>留言时间</th>
			<th>是否发布</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($comments as $comment)
			<tr>
				<td>#{{ $comment->id }}</td>
				<td>{{ $comment->name }}</td>
				<td><a href="mailto:{{ $comment->email }}?subject=留言回复" title="Email me">{{ $comment->email }}</a></td>
				<td>{{ $comment->comment }}</td>
				<td>{{ $comment->created_at }}</td>
				<td>
					<form action="{{ url('comment/publish', $comment->id) }}" method="POST" role="form">
						{!! method_field('put') !!}
						{!! csrf_field() !!}
						@if ($comment->is_published)
							<button type="submit" class="btn btn-warning">取消发布</button>
						@else
							<button type="submit" class="btn btn-primary">发布留言</button>
						@endif
					</form>
				</td>
			</tr>
		@endforeach
	</tbody>
@stop